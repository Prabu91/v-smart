<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransferRoomRequest;
use App\Models\LabResult;
use App\Models\TransferRoom;
use App\Models\Ttv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransferRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('observation.transfer-room.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $patient_id = $request->query('patient_id');
        return view('observation.transfer-room.create', compact('patient_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransferRoomRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $userId = Auth::id();
                $labResult = LabResult::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $userId,
                    'hb' => $request->hb_transfer,
                    'leukosit' => $request->leukosit_transfer,
                    'pcv' => $request->pcv_transfer,
                    'trombosit' => $request->trombosit_transfer,
                    'kreatinin' => $request->kreatinin_transfer,
                ]);

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

                $transferRoom = TransferRoom::create([
                    'user_id' => $userId,
                    'transfer_room_datetime' => $request->transfer_room_datetime,
                    'transfer_room_name' => $request->transfer_room_name,
                    'lab_culture_data' => $request->lab_culture_data,
                    'main_diagnose' => $request->main_diagnose_transfer,
                    'secondary_diagnose' => $request->secondary_diagnose_transfer,
                    'labresult_id' => $labResult->id,
                    'ttv_id' => $ttv->id,
                    'patient_id' => $request->patient_id,
                ]);
            });

            return redirect()->route('patients.show', ['patient' => $request->patient_id])
            ->with('success', 'Berhasil Menyimpan Data.');
        } catch (\Exception $e) {
            return redirect()->route('patients.show', ['patient' => $request->patient_id])
                ->with('error', 'Gagal Menyimpan Data! Error: ' . $e->getMessage());
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
