<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIntubationRequest;
use App\Models\Agd;
use App\Models\IcuRoom;
use App\Models\Intubation;
use App\Models\OriginRoom;
use App\Models\Ttv;
use App\Models\Ventilator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function store(StoreIntubationRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $userId = Auth::id();

                $pre_ttv = Ttv::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $userId,
                    'sistolik' => $request->pre_sistolik,
                    'diastolik' => $request->pre_diastolik,
                    'suhu' => $request->pre_suhu,
                    'nadi' => $request->pre_nadi,
                    'rr' => $request->pre_rr_ttv,
                    'spo2' => $request->pre_spo2,
                ]);
                $post_ttv = Ttv::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $userId,
                    'sistolik' => $request->post_sistolik,
                    'diastolik' => $request->post_diastolik,
                    'suhu' => $request->post_suhu,
                    'nadi' => $request->post_nadi,
                    'rr' => $request->post_rr_ttv,
                    'spo2' => $request->post_spo2,
                ]);
                
                $ventilator = Ventilator::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $userId,
                    'ttv_id' => $post_ttv->id,
                    'venti_datetime' => $request->venti_datetime,
                    'mode_venti' => $request->mode_venti,
                    'diameter' => $request->diameter,
                    'depth' => $request->depth,
                    'ipl' => $request->ipl,
                    'peep' => $request->peep,
                    'fio2' => $request->fio2,
                    'rr' => $request->rr,
                ]);
                
                $intubation = Intubation::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $userId,
                    'ttv_pre_id' => $pre_ttv->id,
                    'ttv_post_id' => $post_ttv->id,
                    'ventilator_id' => $ventilator->id,
                    'intubation_datetime' => $request->intubation_datetime,
                    'intubation_location' => $request->intubation_location,
                    'dr_intubation' => $request->dr_intubation_name,
                    'dr_consultant' => $request->dr_consultant_name,
                    'pre_intubation' => $request->preintubation,
                    'post_intubation' => $request->postintubation,
                    'diameter' => $request->diameter,
                    'depth' => $request->depth,
                ]);

                $originRoom = OriginRoom::where('patient_id', $request->patient_id)->first();

                if ($originRoom) {
                    $originRoom->intubation_id = $intubation->id;
                    $originRoom->save();
                }

                
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
