<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOriginRoomRequest;
use App\Models\OriginRoom;
use App\Models\LabResult;
use App\Models\Agd;
use App\Models\User;
use App\Support\LogHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function store(StoreOriginRoomRequest $request)
    {
        try {
            DB::transaction(function () use ($request, &$user, &$originId) {
                $userId = Auth::id();
                $user = User::where('id', $userId)->first();

                $labResult = LabResult::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $userId,
                    'hb' => $request->hb_origin,
                    'leukosit' => $request->leukosit_origin,
                    'pcv' => $request->pcv_origin,
                    'trombosit' => $request->trombosit_origin,
                    'kreatinin' => $request->kreatinin_origin,
                ]);

                $agd = Agd::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $userId,
                    'ph' => $request->ph_origin,
                    'pco2' => $request->pco2_origin,
                    'po2' => $request->po2_origin,
                    'spo2' => $request->spo2_origin,
                    'base_excees' => $request->be_origin,
                ]);
            
                $originId = OriginRoom::create([
                    'user_id' => $userId,
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
                    'intubation_id' => null,
                    'patient_id' => $request->patient_id,
                ]);
            });

            LogHelper::log('Tambah Data Origin Room', "(ID : {$user->name}) Menambahkan Data Origin {$originId->id}");
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
