<?php

namespace App\Http\Controllers;

use App\Models\Agd;
use App\Models\Elektrolit;
use App\Models\IcuRoom;
use App\Models\Intubation;
use App\Models\LabResult;
use App\Models\Ttv;
use App\Models\Ventilator;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                // Lab Results
                $labResult = LabResult::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $request->user_id,
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

                // Elektrolit
                $elk = Elektrolit::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $request->user_id,
                    'natrium' => $request->natrium,
                    'kalium' => $request->kalium,
                    'calsium' => $request->calsium,
                    'magnesium' => $request->magnesium,
                    'clorida' => $request->clorida,
                ]);

                // AGDS
                $agd = Agd::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $request->user_id,
                    'ph' => $request->ph_icu,
                    'pco2' => $request->pco2_icu,
                    'po2' => $request->po2_icu,
                    'spo2' => $request->spo2_icu,
                    'base_excees' => $request->be_icu,
                    'sbpt' => $request->sbpt,
                ]);

                // Venti
                $venti = Ventilator::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $request->user_id,
                    'venti_datetime' => $request->venti_datetime,
                    'mode_venti' => $request->mode_venti,
                    'ipl' => $request->ipl,
                    'peep' => $request->peep,
                    'fio2' => $request->fio2,
                    'rr' => $request->rr,
                ]);

                // Venti
                $ttv = Ttv::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $request->user_id,
                    'sistolik' => $request->sistolik,
                    'diastolik' => $request->diastolik,
                    'suhu' => $request->suhu,
                    'nadi' => $request->nadi,
                    'rr' => $request->rr_ttv,
                    'spo2' => $request->spo2,
                ]);

                // ICU Room
                $icuRoom = IcuRoom::create([
                    'user_id' => $request->user_id,
                    'icu_room_datetime' => $request->icu_room_datetime,
                    'icu_room_name' => $request->icu_room_name,
                    'icu_room_bednum' => $request->icu_room_bednum,
                    'ro' => $request->ro,
                    'ro_post_intubation' => $request->ro_post_intubation,
                    'blood_culture' => $request->blood_culture,
                    'ttv_id' => $ttv->id,
                    'labresult_id' => $labResult->id,
                    'elektrolit_id' => $elk->id,
                    'agd_id' => $agd->id,
                    'ventilator_id' => $venti->id,
                    'patient_id' => $request->patient_id,
                ]);
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
        $icuRecords = IcuRoom::with('ttv')->findOrFail($id);

        return view('observation.icu-room.show', compact('icuRecords'));
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
