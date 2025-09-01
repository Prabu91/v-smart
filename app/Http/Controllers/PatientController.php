<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Extubation;
use App\Models\IcuRoom;
use App\Models\Intubation;
use App\Models\OriginRoom;
use App\Models\Patient;
use App\Models\TransferRoom;
use App\Models\Ttv;
use App\Models\Ventilator;
use App\Support\LogHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Clegginabox\PDFMerger\PDFMerger;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */ 
    public function index()
    {
        return view('patients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $patient = null;
        
        DB::transaction(function () use ($request, &$patient, &$userId) {                
            $userId = Auth::id();
            
            $patient = Patient::create([
                'name' => $request->name,
                'no_jkn' => $request->no_jkn,
                'no_rm' => $request->no_rm,
                'no_sep' => $request->no_sep,
                'tanggal_lahir' => $request->tanggal_lahir,
                'gender' => $request->gender,
                'user_id' => $userId,
            ]);
        });
    
        if ($patient) {
            LogHelper::log('Tambah Pasien', "(ID : {$userId}) Menambahkan pasien bernama {$request->name}");
            return redirect()->route('patients.show', ['patient' => $patient->id])
                ->with('success', 'Berhasil Menyimpan Data.');
        } else {
            return redirect()->route('patients.index')
                ->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $origin = OriginRoom::with('labResult', 'intubation', 'agd')->where('patient_id', $id)->first();
        $intubations = Intubation::with(['ttvPre', 'ttvPost'])
        ->where('patient_id', $id)
        ->first();
        $extubation = Extubation::where('patient_id', $id)->first();
        $transfer = TransferRoom::with('labResult', 'ttv')->where('patient_id', $id)->first();
        $icu = IcuRoom::where('patient_id', $id)->exists();
        
        if ($request->ajax()) {
            $icuRecords = IcuRoom::with(['elektrolit', 'labResult', 'agd', 'ttv'])
            ->where('patient_id', $id)
            ->orderBy('icu_room_datetime', 'asc')
            ->get();

            $totalRecords = $icuRecords->count();
            $recordsFiltered = $totalRecords;

            if ($request->query('type') === 'venti') {
                $ventilators = Ventilator::where('patient_id', $id)
                    ->orderBy('venti_datetime', 'desc')
                    ->get();

                    $ventilatorRecords = [];
                    $previousDatetime = null;

                    foreach ($ventilators as $index => $venti) {
                        $currentDatetime = Carbon::parse($venti->venti_datetime) ?? null;

                        $usageTime = 'N/A';

                        if (!empty($venti->venti_usagetime)) {
                            $ventiUsageTime = Carbon::parse($venti->venti_usagetime);
                            
                            // Hitung total menit
                            $totalMinutes = $currentDatetime->diffInMinutes($ventiUsageTime);

                            // Konversi ke jam dan menit
                            $totalHours = intdiv($totalMinutes, 60);
                            $remainingMinutes = $totalMinutes % 60;

                            // Format hasil
                            $usageTime = "{$totalHours} Jam {$remainingMinutes} Menit";
                        } elseif ($previousDatetime) {
                            // Jika venti_usagetime tidak ada, gunakan previousDatetime
                            $totalMinutes = $previousDatetime->diffInMinutes($currentDatetime);
                    
                            // Konversi ke jam dan menit
                            $totalHours = intdiv($totalMinutes, 60);
                            $remainingMinutes = $totalMinutes % 60;
                    
                            // Format hasil
                            $usageTime = "{$totalHours} Jam {$remainingMinutes} Menit";
                        }

                        $parameters = $venti->fio2 . "%, " . $venti->peep;

                        // Action Button
                        $actionButton = $venti->venti_usagetime === null
                        ? '<a href="javascript:void(0);" class="release-venti" data-id="' . $venti->id . '" style="background-color: red; color: white; padding: 6px 12px; border-radius: 5px; text-decoration: none;">
                            Lepas Venti
                        </a>'
                        : '';


                        $ventilatorRecords[] = [
                            'id' => $venti->id,
                            'venti_datetime' => Carbon::parse($venti->venti_datetime)->format('H:i d/m/Y'),
                            'mode_venti' => $venti->mode_venti,
                            'venti_duration' => $usageTime,
                            'parameters' => $parameters,
                            'action' => $actionButton,
                        ];
                        
                        $previousDatetime = $currentDatetime;
                    }
        
                return response()->json([
                    'draw' => intval($request->input('draw')),
                    'recordsTotal' => $ventilators->count(),
                    'recordsFiltered' => $ventilators->count(),
                    'data' => $ventilatorRecords
                ]);
            }

            $records = [];
            foreach ($icuRecords as $index => $icu) {
                $icuRoomNameBed = $icu->icu_room_name;
                if ($icu->icu_room_bednum) {
                    $icuRoomNameBed .= " - Bed {$icu->icu_room_bednum}";
                }

                $elektrolit = "Na: " . $icu->elektrolit->natrium . " K: " .  number_format($icu->elektrolit->kalium, 1);
                $lb1 = "Hb: " . $icu->labResult->hb . " L: " . $icu->labResult->leukosit;
                $lb2 = "Alb: " . number_format($icu->labResult->albumin, 1) . " L: " .  number_format($icu->labResult->laktat,1);
                $agd = $icu->agd->ph . " / " . $icu->agd->pco2;
                $ttv = $icu->ttv->sistolik . " / " . $icu->ttv->diastolik . ", " . $icu->ttv->nadi;
                
                $records[] = [
                    'id' => $icu->id,
                    'icu_room_datetime' => Carbon::parse($icu->icu_room_datetime)->format('H:i d/m/Y'),
                    'icu_room_name' => $icuRoomNameBed,
                    'elektrolit' => $elektrolit,
                    'lb1' => $lb1,
                    'lb2' => $lb2,
                    'agd' => $agd,
                    'ttv' => $ttv,
                    'action' => '<a href="' . route('icu-rooms.show', $icu->id) . '" style="background-color: #2f4157; color: white; padding: 8px 12px; border-radius: 5px; text-decoration: none; margin-right: 5px; 
                        transition: background-color 0.3s;"
                        onmouseover="this.style.backgroundColor=\'#577c8e\'" 
                        onmouseout="this.style.backgroundColor=\'#2f4157\'">
                            Detail
                        </a>'
                ];
            }          
        
            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $recordsFiltered,
                'data' => $records
            ]);
        }
        
        $ventilators = Ventilator::where('patient_id', $id)
                    ->orderBy('venti_datetime', 'desc')
                    ->first();
        $ventiReleaseButton = !isset($ventilators->venti_usagetime);
        
        return view('patients.detail', compact('patient', 'origin', 'icu', 'intubations', 'extubation', 'transfer', 'ventiReleaseButton'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        DB::transaction(function () use ($request, $patient, &$userId) {
            $userId = Auth::id();
            
            $patient->update([
                'name' => $request->name,
                'no_jkn' => $request->no_jkn,
                'no_rm' => $request->no_rm,
                // Perhatikan baris ini:
                // Jika request->no_sep ada, gunakan. Jika tidak, tetap gunakan nilai yang sudah ada di $patient.
                'no_sep' => $request->no_sep,
                'tanggal_lahir' => $request->tanggal_lahir,
                'gender' => $request->gender,
                'user_id' => $userId,
            ]);
        });

        if ($patient->wasChanged()) {
            LogHelper::log('Ubah Pasien', "(ID : {$userId}) Mengubah data pasien bernama {$request->name}");
            return redirect()->route('patients.show', ['patient' => $patient->id])
                ->with('success', 'Berhasil memperbarui data.');
        } else {
            return redirect()->route('patients.show', ['patient' => $patient->id])
                ->with('info', 'Tidak ada perubahan yang dilakukan pada data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }


    public function exportPdf($patientId)
    {
        $userId = Auth::id();

        $patient = Patient::with([
            'originRoom',
            'icuRoom',
            'venti' => function ($query) {
                    $query->orderBy('created_at', 'asc');
                },
            'intubation',
            'extubation',
            'transferRoom',
            'user'
        ])->findOrFail($patientId);

        $patient->name = substr($patient->name, 0, 4) . str_repeat('*', strlen($patient->name) - 4);
        $patient->no_jkn = substr($patient->no_jkn, 0, 4) . str_repeat('*', strlen($patient->no_jkn) - 4);
        $patient->no_rm = substr($patient->no_rm, 0, 4) . str_repeat('*', strlen($patient->no_rm) - 4);


        $intubations = Intubation::with(['ttvPre', 'ttvPost'])
        ->where('patient_id', $patientId)
        ->first();

        $icuRoomsByDate = $patient->icuRoom
        ->sortBy(function ($room) {
            return Carbon::parse($room->icu_room_datetime)->toDateString();
        })
        ->groupBy(function ($room) {
            return Carbon::parse($room->icu_room_datetime)->toDateString();
        });

        // Loop untuk menghitung waktu pemakaian untuk setiap ventilator
        $ventiUsageTimes = [];
        foreach ($patient->venti as $venti) {
            $ventiUsageTime = 'N/A'; // Default nilai

            $currentDatetime = Carbon::parse($venti->venti_datetime) ?? null;
            $previousDatetime = null; // Atur sesuai logika sebelumnya jika ada

            if (!empty($venti->venti_usagetime)) {
                $ventiUsageTime = Carbon::parse($venti->venti_usagetime);

                // Hitung total menit
                $totalMinutes = $currentDatetime->diffInMinutes($ventiUsageTime);

                // Konversi ke jam dan menit
                $totalHours = intdiv($totalMinutes, 60);
                $remainingMinutes = $totalMinutes % 60;

                // Format hasil
                $ventiUsageTime = "{$totalHours} Jam {$remainingMinutes} Menit";
            } elseif ($previousDatetime) {
                $totalMinutes = $previousDatetime->diffInMinutes($currentDatetime);

                // Konversi ke jam dan menit
                $totalHours = intdiv($totalMinutes, 60);
                $remainingMinutes = $totalMinutes % 60;

                $ventiUsageTime = "{$totalHours} Jam {$remainingMinutes} Menit";
            }

            // Simpan hasil perhitungan
            $ventiUsageTimes[] = $ventiUsageTime;
        }

        // Buat PDF potret
        $portraitPdf = Pdf::loadView('patients.export', [
            'patient' => $patient,
            'intubations' => $intubations,
            ])->setPaper('A4', 'portrait')->output();
            
        // Buat PDF lanskap
        $landscapePdf = Pdf::loadView('patients.export-icu', [
            'patient' => $patient,
            'icuRoomsByDate' => $icuRoomsByDate,
            'ventiUsageTimes' => $ventiUsageTimes,
            ])->setPaper('A4', 'landscape')->output();
                
        $portraitPdf2 = Pdf::loadView('patients.export-venti', [
            'patient' => $patient,
            ])->setPaper('A4', 'portrait')->output();

        // Simpan PDF sementara
        $portraitPath = storage_path('app/temp_portrait.pdf');
        $landscapePath = storage_path('app/temp_landscape.pdf');
        $portraitPath2 = storage_path('app/temp_portrait2.pdf');
        file_put_contents($portraitPath, $portraitPdf);
        file_put_contents($landscapePath, $landscapePdf);
        file_put_contents($portraitPath2, $portraitPdf2);

        // Gabungkan PDF
        $pdfMerger = new PDFMerger;
        $pdfMerger->addPDF($portraitPath, 'all');
        $pdfMerger->addPDF($landscapePath, 'all');
        $pdfMerger->addPDF($portraitPath2, 'all');

        LogHelper::log('Export Data Pasien', "(ID : {$userId}) Mengeksport pasien bernama {$patient->name} | ID: {$patientId} ");
        // Simpan file gabungan
        $outputPath = storage_path('app/Detail_Patient_' . $patient->id . '.pdf');
        $pdfMerger->merge('file', $outputPath);

        // Hapus file sementara
        unlink($portraitPath);
        unlink($landscapePath);
        unlink($portraitPath2);

        return response()->download($outputPath)->deleteFileAfterSend();

    }

}
