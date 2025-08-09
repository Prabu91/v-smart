<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIcuRoomRequest;
use App\Models\Agd;
use App\Models\Elektrolit;
use App\Models\IcuRoom;
use App\Models\Intubation;
use App\Models\LabResult;
use App\Models\Ttv;
use App\Models\User;
use App\Models\Ventilator;
use App\Support\LogHelper;
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
            DB::transaction(function () use ($request, &$icuId, &$user) {
                $userId = Auth::id();
                $user = User::where('id', $userId)->first();
                $ventiDatetime = Carbon::parse($request->venti_datetime)->format('Y-m-d H:i:s');
                $icuDatetime = Carbon::parse($request->icu_room_datetime)->format('Y-m-d H:i:s');


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
                        'venti_datetime' => $ventiDatetime,
                        'mode_venti' => $request->mode_venti,
                        'ipl' => $request->ipl,
                        'peep' => $request->peep,
                        'fio2' => $request->fio2,
                        'rr' => $request->rr,
                        'ps' => $request->ps,
                        'trigger' => $request->trigger,
                    ]);

                    
                    $ventilatorId = $ventilator->id;
                    LogHelper::log('Tambah Venti', "(ID : {$user->name}) Pasang Ventilator: ({$ventilatorId})");

                    if ($previousVentilator && is_null($previousVentilator->venti_usagetime)) {
                        $previousVentilator->update([
                            'venti_usagetime' => Carbon::parse($request->venti_datetime)->format('Y-m-d H:i:s')
                        ]);
                        
                        LogHelper::log('Lepas Venti', "(ID : {$user->name}) Lepas Ventilator: ({$previousVentilator->id})");
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
                            'pf_ratio' => $request->pf_ratio,
                            'hco2' => $request->hco2,
                            'tco2' => $request->tco2,
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
                            'consciousness' => $request->consciousness,
                        ]);
                        $ttvId = $ttv->id;
                    }
                }

                // ICU Room
                if ($ttvId || $labResultId || $elektrolitId || $agdId) {
                    $icuId = IcuRoom::create([
                        'user_id' => $userId,
                        'icu_room_datetime' => $icuDatetime,
                        'icu_room_name' => $request->icu_room_name,
                        'icu_room_bednum' => $request->icu_room_bednum,
                        'ro' => $request->ro,
                        'ro_post_intubation' => $request->ro_post_intubation,
                        'blood_culture' => $request->blood_culture,
                        'lab_tests_sent' => $request->lab_tests_sent,
                        'sputum_color' => $request->sputum_color,
                        'ttv_id' => $ttvId,
                        'labresult_id' => $labResultId,
                        'elektrolit_id' => $elektrolitId,
                        'agd_id' => $agdId,
                        'ventilator_id' => $ventilatorId,
                        'patient_id' => $request->patient_id,
                    ]);
                }
            });

            // LogHelper::log('Tambah Data intensif', "(ID : {$user->name}) Menambahkan Data intensif {$icuId->id}");
            return redirect()->route('patients.show', ['patient' => $request->patient_id])
                ->with('success', 'Berhasil Menyimpan Data.');
        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getFile(), $e->getLine());
            // return redirect()->route('patients.show', ['patient' => $request->patient_id])
            //     ->with('error', 'Gagal Menyimpan Data!'. $e->getMessage());
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
