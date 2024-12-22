<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Models\Extubation;
use App\Models\IcuRoom;
use App\Models\Intubation;
use App\Models\OriginRoom;
use App\Models\Patient;
use App\Models\TransferRoom;
use App\Models\Ttv;
use App\Models\Ventilator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        try{
            DB::transaction(function () use ($request, &$patient) {
                $patient = Patient::create([
                    'name' => $request->name,
                    'no_jkn' => $request->no_jkn, 
                    'no_rm' => $request->no_rm,
                    'user_id' => $request->user_id
                ]);
            });
        
        return redirect()->route('patients.show', ['patient' => $patient->id])
            ->with('success', 'Berhasil Menyimpan Data.');
        } catch (\Exception $e) {
            return redirect()->route('patients.show', ['patient' => $patient->id])->with('error', 'Gagal Menyimpan Data ! ' . $e->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $origin = OriginRoom::with('labResult', 'intubation', 'agd')->where('patient_id', $id)->first();
        $intubations = Intubation::where('patient_id', $id)->with(['ttv'])->first();
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
                    ->orderBy('venti_datetime', 'asc')
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

                $elektrolit = "Na: " . $icu->elektrolit->natrium . " K: " . $icu->elektrolit->kalium;
                $lb1 = "Hb: " . $icu->labResult->hb . " L: " . $icu->labResult->leukosit;
                $lb2 = "Alb: " . $icu->labResult->albumin . " L: " . $icu->labResult->laktat;
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
                    'action' => '<a href="' . route('icu-rooms.show', $icu->id) . '" style="background-color: #3490dc; color: white; padding: 6px 12px; border-radius: 5px; text-decoration: none; margin-right: 5px;">
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
        
        

        return view('patients.detail', compact('patient', 'origin', 'icu', 'intubations', 'extubation', 'transfer'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }

    // public function exportPdf($patientId)
    // {
    //     $patient = Patient::with('originRoom', 'icuRoom', 'intubation', 'extubation', 'transferRoom') 
    //                     ->findOrFail($patientId);

    //     $icuRoomsByDate = $patient->icuRoom->groupBy(function ($room) {
    //         return Carbon::parse($room->icu_room_datetime)->toDateString();
    //     });


    //     $pdf = Pdf::loadView('patients.export', [
    //                 'patient' => $patient,
    //                 'icuRoomsByDate' => $icuRoomsByDate
    //             ]);

    //     return $pdf->download('Detail_Patient_' . $patient->id . '.pdf');
    // }

    public function exportPdf($patientId)
    {
        $patient = Patient::with([
            'originRoom',
            'icuRoom',
            'intubation',
            'extubation',
            'venti',
            'transferRoom'
        ])->findOrFail($patientId);

        $icuRoomsByDate = $patient->icuRoom
        ->sortBy(function ($room) {
            return Carbon::parse($room->icu_room_datetime)->toDateString();
        })
        ->groupBy(function ($room) {
            return Carbon::parse($room->icu_room_datetime)->toDateString();
        });

            
        $pdf = Pdf::loadView('patients.export', [
            'patient' => $patient,
            'icuRoomsByDate' => $icuRoomsByDate
        ]);

        return $pdf->download('Detail_Patient_' . $patient->id . '.pdf');
    }

}
