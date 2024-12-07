<?php

namespace App\Http\Controllers;

use App\Models\Agd;
use App\Models\IcuRoom;
use App\Models\Intubation;
use App\Models\Ttv;
use App\Models\Ventilator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IntubationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('observation.icu-room.intubation.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $patient_id = $request->query('patient_id');
        $intubation = Intubation::with('ttv')->where('patient_id', $patient_id)->first();
        return view('observation.icu-room.intubation.create', compact('patient_id', 'intubation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
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
                        'ttv_id' => $ttv->id,
                        'intubation_datetime' => $request->intubation_datetime,
                        'intubation_location' => $request->intubation_location,
                        'dr_intubation' => $request->dr_intubation_name,
                        'dr_consultant' => $request->dr_consultant_name,
                        'pre_intubation' => $request->preintubation,
                        'post_intubation' => $request->postintubation,
                        'therapy_type' => $request->therapy_type,
                        'diameter' => $request->diameter,
                        'depth' => $request->depth,
                    ]);
            });

        return redirect()->route('patients.show', ['patient' => $request->patient_id])
            ->with('success', 'Berhasil Menyimpan Data.');
        } catch (\Exception $e) {
            return redirect()->route('patients.show', ['patient' => $request->patient_id])
                ->with('error', 'Gagal Menyimpan Data!'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Intubation $intubation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Intubation $intubation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Intubation $intubation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Intubation $intubation)
    {
        //
    }
}
