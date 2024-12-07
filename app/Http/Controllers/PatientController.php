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
            $icuRecords = IcuRoom::with(['venti' => function ($query) {
                $query->orderBy('venti_datetime', 'asc'); 
            }])
            ->where('patient_id', $id)
            ->orderBy('icu_room_datetime', 'asc')
            ->get();

            $totalRecords = $icuRecords->count();
            $recordsFiltered = $totalRecords;
        
            $records = [];
            foreach ($icuRecords as $index => $icu) {
                $currentDatetime = $icu->venti->venti_datetime ?? null;
        
                $usageTime = 'N/A';
                $previousDatetime = null;
        
                if ($index > 0 && isset($icuRecords[$index - 1]->venti->venti_datetime)) {
                    $previousDatetime = Carbon::parse($icuRecords[$index - 1]->venti->venti_datetime);
                    $currentDatetime = Carbon::parse($currentDatetime); 

                    $diffInHours = $previousDatetime->diffInHours($currentDatetime);
                    $diffInMinutes = $previousDatetime->diffInMinutes($currentDatetime) % 60;

                    $formattedHours = round($diffInHours + ($diffInMinutes / 60), 0);

                    $usageTime = "{$formattedHours} Jam {$diffInMinutes} Menit";
                }
        
                $records[] = [
                    'id' => $icu->id,
                    'icu_room_datetime' => $icu->icu_room_datetime,
                    'mode_venti' => $icu->venti->mode_venti ?? 'N/A',
                    'venti_usage' => $usageTime !== 'N/A' ? $usageTime : 'N/A',
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

    public function exportPdf($patientId)
    {
        $patient = Patient::with('originRoom', 'icuRoom', 'intubation', 'extubation', 'transferRoom') 
                        ->findOrFail($patientId);

        $pdf = Pdf::loadView('patients.export', compact('patient'));

        return $pdf->download('Detail_Patient_' . $patient->id . '.pdf');
    }
}
