<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIcuRoomRequest;
use App\Models\Agd;
use App\Models\Elektrolit;
use App\Models\IcuRoom;
use App\Models\Intubation;
use App\Models\LabResult;
use App\Models\Ttv;
use App\Models\Ventilator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class IcuRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('observation.icu-room.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    
    public function create(Request $request)
    {
        $patient_id = $request->query('patient_id');
        
        $icuData = IcuRoom::where('patient_id', $patient_id)->first(); 
    
        return view('observation.icu-room.create', compact('patient_id', 'icuData'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIcuRoomRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $userId = Auth::id();

                $ttvId = null;
                $labResultId = null;
                $elektrolitId = null;
                $agdId = null;
                $ventilatorId = null;

                if ($request->filled(['venti_datetime', 'mode_venti'])) {
                    $previousVentilator = Ventilator::where('patient_id', $request->patient_id)
                        ->orderBy('venti_datetime', 'desc')
                        ->first();

                    // Tambahkan data ventilator baru
                    $ventilator = Ventilator::create([
                        'patient_id' => $request->patient_id,
                        'user_id' => $userId,
                        'venti_datetime' => $request->venti_datetime,
                        'mode_venti' => $request->mode_venti,
                        'ipl' => $request->ipl,
                        'peep' => $request->peep,
                        'fio2' => $request->fio2,
                        'rr' => $request->rr,
                    ]);

                    $ventilatorId = $ventilator->id;

                    if ($previousVentilator->venti_usagetime === null) {
                        $previousVentilator->update([
                            'venti_usagetime' => $request->venti_datetime
                        ]);
                    }
                }

                if ($request->filled([
                    'hb_icu', 'leukosit_icu', 'natrium', 'kalium', 'ph_icu', 'sistolik', 'icu_room_datetime'
                ])) {
                    // Lab Results
                    if ($request->filled(['hb_icu', 'leukosit_icu'])) {
                        $labResult = LabResult::create([
                            'patient_id' => $request->patient_id,
                            'user_id' => $userId,
                            'hb' => $request->hb_icu,
                            'leukosit' => $request->leukosit_icu,
                            'pcv' => $request->pcv_icu,
                            'trombosit' => $request->trombosit_icu,
                            'kreatinin' => $request->kreatinin_icu,
                            'albumin' => $request->albumin,
                            'laktat' => $request->laktat,
                            'sbut' => $request->sbut,
                            'ureum' => $request->ureum,
                        ]);
                        $labResultId = $labResult->id;
                    }

                    // Elektrolit
                    if ($request->filled(['natrium', 'kalium'])) {
                        $elektrolit = Elektrolit::create([
                            'patient_id' => $request->patient_id,
                            'user_id' => $userId,
                            'natrium' => $request->natrium,
                            'kalium' => $request->kalium,
                            'calsium' => $request->calsium,
                            'magnesium' => $request->magnesium,
                            'clorida' => $request->clorida,
                        ]);
                        $elektrolitId = $elektrolit->id;
                    }

                    // AGDS
                    if ($request->filled(['ph_icu', 'pco2_icu'])) {
                        $agd = Agd::create([
                            'patient_id' => $request->patient_id,
                            'user_id' => $userId,
                            'ph' => $request->ph_icu,
                            'pco2' => $request->pco2_icu,
                            'po2' => $request->po2_icu,
                            'spo2' => $request->spo2,
                            'base_excees' => $request->be_icu,
                            'sbpt' => $request->sbpt,
                        ]);
                        $agdId = $agd->id;
                    }

                    // TTV
                    if ($request->filled(['sistolik', 'diastolik'])) {
                        $ttv = Ttv::create([
                            'patient_id' => $request->patient_id,
                            'user_id' => $userId,
                            'sistolik' => $request->sistolik,
                            'diastolik' => $request->diastolik,
                            'suhu' => $request->suhu,
                            'nadi' => $request->nadi,
                            'rr' => $request->rr_ttv,
                            'spo2' => $request->spo2,
                        ]);
                        $ttvId = $ttv->id;
                    }
                }

                // ICU Room
                if ($ttvId || $labResultId || $elektrolitId || $agdId) {
                    IcuRoom::create([
                        'user_id' => $userId,
                        'icu_room_datetime' => $request->icu_room_datetime,
                        'icu_room_name' => $request->icu_room_name,
                        'icu_room_bednum' => $request->icu_room_bednum,
                        'ro' => $request->ro,
                        'ro_post_intubation' => $request->ro_post_intubation,
                        'blood_culture' => $request->blood_culture,
                        'ttv_id' => $ttvId,
                        'labresult_id' => $labResultId,
                        'elektrolit_id' => $elektrolitId,
                        'agd_id' => $agdId,
                        'ventilator_id' => $ventilatorId,
                        'patient_id' => $request->patient_id,
                    ]);
                }
            });

            return redirect()->route('patients.show', ['patient' => $request->patient_id])
                ->with('success', 'Berhasil Menyimpan Data.');
        } catch (\Exception $e) {
            return redirect()->route('patients.show', ['patient' => $request->patient_id])
                ->with('error', 'Gagal Menyimpan Data!');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data ICU Room
        $icuRecords = IcuRoom::with('venti')->findOrFail($id);

        // Ambil pasien ID dari ICU Room
        $patientId = $icuRecords->patient_id;

        // Tanggal ICU Room yang sedang dilihat
        $icuDate = Carbon::parse($icuRecords->icu_room_datetime)->toDateString();

        // Ambil data ventilator sesuai kondisi
        $ventilators = Ventilator::where('patient_id', $patientId)
            ->whereDate('venti_datetime', $icuDate)->orderBy('venti_datetime', 'desc')
            ->get();

        return view('observation.icu-room.show', compact('icuRecords', 'ventilators'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
