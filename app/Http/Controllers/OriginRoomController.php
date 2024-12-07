<?php

namespace App\Http\Controllers;

use App\Models\OriginRoom;
use App\Models\LabResult;
use App\Models\Agd;
use App\Models\Intubation;
use App\Models\Ttv;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OriginRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('observation.origin-room.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $patient_id = $request->query('patient_id');
        return view('observation.origin-room.create', compact('patient_id'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
            $intubationLocation = $request->intubation_location;

            if ($intubationLocation === 'other') {
                $intubationLocation = $request->intubation_location_other;
            }

            // Lab Results
            $labResult = LabResult::create([
                'patient_id' => $request->patient_id,
                'user_id' => $request->user_id,
                'hb' => $request->hb_origin,
                'leukosit' => $request->leukosit_origin,
                'pcv' => $request->pcv_origin,
                'trombosit' => $request->trombosit_origin,
                'kreatinin' => $request->kreatinin_origin,
            ]);

            // AGDS
            $agd = Agd::create([
                'patient_id' => $request->patient_id,
                'user_id' => $request->user_id,
                'ph' => $request->ph_origin,
                'pco2' => $request->pco2_origin,
                'po2' => $request->po2_origin,
                'spo2' => $request->spo2_origin,
                'base_excees' => $request->be_origin,
            ]);
            
                if ($request->intConf === 'yes') {
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
            
                    $intubation = Intubation::create([
                        'patient_id' => $request->patient_id,
                        'user_id' => $request->user_id,
                        'intubation_datetime' => $request->intubation_datetime,
                        'intubation_location' => $intubationLocation,
                        'dr_intubation' => $request->dr_intubation_name,
                        'dr_consultant' => $request->dr_consultant_name,
                        'pre_intubation' => $request->preintubation,
                        'post_intubation' => $request->postintubation,
                        'therapy_type' => $request->therapy_type_origin,
                        'diameter' => $request->diameter_origin,
                        'depth' => $request->depth_origin,
                        'ipl' => $request->ipl_origin,
                        'peep' => $request->peep_origin,
                        'fio2' => $request->fio2_origin,
                        'rr' => $request->rr_origin,
                        'ttv_id' => $ttv->id,
                    ]);
                } else {
                    $intubation = null;
                }
            
                OriginRoom::create([
                    'user_id' => $request->user_id,
                    'origin_room_name' => $request->origin_room_name,
                    'physical_check' => $request->physical_check,
                    'radiology' => $request->radiology,
                    'ews' => $request->ews,
                    'natrium' => $request->na_origin,
                    'kalium' => $request->kal_origin,
                    'gds' => $request->gds_origin,
                    'additional_check' => $request->additional_check,
                    'main_diagnose' => $request->main_diagnose_origin,
                    'secondary_diagnose' => $request->secondary_diagnose_origin,
                    'labresult_id' => $labResult->id,
                    'agd_id' => $agd->id,
                    'intubation_id' => $intubation?->id,
                    'patient_id' => $request->patient_id,
                ]);
            });

            return redirect()->route('patients.show', ['patient' => $request->patient_id])
                ->with('success', 'Berhasil Menyimpan Data.');
            } catch (\Exception $e) {
            return redirect()->route('patients.show', ['patient' => $request->patient_id])
                ->with('error', 'Gagal Menyimpan Data.' . $e->getMessage());
            }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
