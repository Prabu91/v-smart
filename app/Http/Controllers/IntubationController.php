<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIntubationRequest;
use App\Models\Agd;
use App\Models\IcuRoom;
use App\Models\Intubation;
use App\Models\OriginRoom;
use App\Models\Ttv;
use App\Models\User;
use App\Models\Ventilator;
use App\Support\LogHelper;
use Carbon\Carbon;
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
            DB::transaction(function () use ($request, &$user, &$intubation) {
                $ventiDatetime = Carbon::parse($request->venti_datetime)->format('Y-m-d H:i:s');
                $intubationDatetime = Carbon::parse($request->intubation_datetime)->format('Y-m-d H:i:s');

                $userId = Auth::id();                
                $user = User::where('id', $userId)->first();

                $pre_ttv = Ttv::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $userId,
                    'sistolik' => $request->pre_sistolik,
                    'diastolik' => $request->pre_diastolik,
                    'suhu' => $request->pre_suhu,
                    'nadi' => $request->pre_nadi,
                    'rr' => $request->pre_rr_ttv,
                    'spo2' => $request->pre_spo2,
                    'consciousness' => $request->pre_consciousness,
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
                    'consciousness' => $request->post_consciousness,
                ]);
                
                $ventilator = Ventilator::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $userId,
                    'ttv_id' => $post_ttv->id,
                    'venti_datetime' => $ventiDatetime,
                    'mode_venti' => $request->mode_venti,
                    'ipl' => $request->ipl,
                    'peep' => $request->peep,
                    'fio2' => $request->fio2,
                    'rr' => $request->rr,
                    'ps' => $request->ps,
                    'trigger' => $request->trigger,
                ]);
                
                $intubation = Intubation::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $userId,
                    'ttv_pre_id' => $pre_ttv->id,
                    'ttv_post_id' => $post_ttv->id,
                    'ventilator_id' => $ventilator->id,
                    'intubation_datetime' => $intubationDatetime,
                    'intubation_location' => $request->intubation_location,
                    'dr_intubation' => $request->dr_intubation_name,
                    'dr_consultant' => $request->dr_consultant_name,
                    'pre_intubation' => $request->preintubation,
                    'post_intubation' => $request->postintubation,
                    'intubation_type' => $request->intubation_type,
                    'ett_diameter' => $request->ett_diameter,
                    'ett_depth' => $request->ett_depth,
                    'tc_diameter' => $request->tc_diameter,
                    'tc_type' => $request->tc_type,
                ]);

                $originRoom = OriginRoom::where('patient_id', $request->patient_id)->first();

                if ($originRoom) {
                    $originRoom->intubation_id = $intubation->id;
                    $originRoom->save();
                }
            });

        LogHelper::log('Tambah Data Intubation', "(ID : {$user->name}) Menambahkan Data Intubation {$intubation->id}");

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
