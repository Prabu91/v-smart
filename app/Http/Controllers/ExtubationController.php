<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExtubationRequest;
use App\Models\Extubation;
use App\Models\Ttv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExtubationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('observation.icu-room.extubation.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {        
        $patient_id = $request->query('patient_id');
        return view('observation.icu-room.extubation.create',compact('patient_id'));
    }

    public function store(StoreExtubationRequest $request)
    {
        try {
            if($request->patient_status == "Tidak Meninggal"){
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
                $ttvId = $ttv->id;
            } else {
                $ttvId = null;
            }


                Extubation::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $request->user_id,
                    'ttv_id' => $ttvId,
                    'extubation_datetime' => $request->extubation_datetime,
                    'preparation_extubation_therapy' => $request->preparation_extubation_therapy,
                    'extubation' => $request->extubation,
                    'nebulizer' => $request->nebulizer,
                    'patient_status' => $request->patient_status,
                ]);

                return redirect()->route('patients.show', ['patient' => $request->patient_id])
                ->with('success', 'Berhasil Menyimpan Data.');
                }catch (\Exception $e) {
                    return redirect()->route('patients.show', ['patient' => $request->patient_id])
                        ->with('error', 'Gagal Menyimpan Data! Error: ' . $e->getMessage());
                }
    }

    /**
     * Display the specified resource.
     */
    public function show(Extubation $extubation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Extubation $extubation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Extubation $extubation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Extubation $extubation)
    {
        //
    }
}
