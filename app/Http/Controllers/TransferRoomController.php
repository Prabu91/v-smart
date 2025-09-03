<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransferRoomRequest;
use App\Http\Requests\UpdateTransferRoomRequest;
use App\Models\LabResult;
use App\Models\TransferRoom;
use App\Models\Ttv;
use App\Models\User;
use App\Support\LogHelper;
use Carbon\Carbon;
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
            DB::transaction(function () use ($request, &$user, &$transferRoom) {
                $transferDatetime = Carbon::parse($request->transfer_room_datetime)->format('Y-m-d H:i:s');

                $userId = Auth::id();
                $user = User::where('id', $userId)->first();

                $labResult = LabResult::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $userId,
                    'hb' => $request->hb_transfer,
                    'leukosit' => $request->leukosit_transfer,
                    'pcv' => $request->pcv_transfer,
                    'trombosit' => $request->trombosit_transfer
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
                    'consciousness' => $request->consciousness,
                ]);

                $transferRoom = TransferRoom::create([
                    'user_id' => $userId,
                    'transfer_room_datetime' => $transferDatetime,
                    'transfer_room_name' => $request->transfer_room_name,
                    'lab_culture_data' => $request->lab_culture_data,
                    'main_diagnose' => $request->main_diagnose_transfer,
                    'secondary_diagnose' => $request->secondary_diagnose_transfer,
                    'notes' => $request->notes,
                    'labresult_id' => $labResult->id,
                    'ttv_id' => $ttv->id,
                    'patient_id' => $request->patient_id,
                ]);
            });

            LogHelper::log('Tambah Data TransferRoom', "(ID : {$user->name}) Menambah Data TransferRoom {$transferRoom->id}");
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
    public function edit(TransferRoom $transferRoom)
    {
        // Muat relasi ttv dan labResult untuk mengisi formulir
        $transferRoom->load(['ttv', 'labResult']);

        // Kembalikan view edit dengan data yang ada
        return view('observation.transfer-room.edit', compact('transferRoom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransferRoomRequest $request, TransferRoom $transferRoom)
    {
        try {
            DB::transaction(function () use ($request, $transferRoom) {
                $userId = Auth::id();
                $user = User::find($userId);
                $transferDatetime = Carbon::parse($request->transfer_room_datetime)->format('Y-m-d H:i:s');

                // Perbarui data LabResult
                if ($transferRoom->labResult) {
                    $transferRoom->labResult->update([
                        'hb' => $request->hb_transfer,
                        'leukosit' => $request->leukosit_transfer,
                        'pcv' => $request->pcv_transfer,
                        'trombosit' => $request->trombosit_transfer
                    ]);
                }

                // Perbarui data Ttv
                if ($transferRoom->ttv) {
                    $transferRoom->ttv->update([
                        'sistolik' => $request->sistolik,
                        'diastolik' => $request->diastolik,
                        'suhu' => $request->suhu,
                        'nadi' => $request->nadi,
                        'rr' => $request->rr_ttv,
                        'spo2' => $request->spo2,
                        'consciousness' => $request->consciousness,
                    ]);
                }
                
                // Perbarui data TransferRoom
                $transferRoom->update([
                    'user_id' => $userId,
                    'transfer_room_datetime' => $transferDatetime,
                    'transfer_room_name' => $request->transfer_room_name,
                    'lab_culture_data' => $request->lab_culture_data,
                    'main_diagnose' => $request->main_diagnose_transfer,
                    'secondary_diagnose' => $request->secondary_diagnose_transfer,
                    'notes' => $request->notes,
                ]);

                LogHelper::log('Perbarui Data TransferRoom', "(ID : {$user->name}) Memperbarui Data TransferRoom {$transferRoom->id}");
            });

            return redirect()->route('patients.show', ['patient' => $transferRoom->patient_id])
                ->with('success', 'Berhasil Memperbarui Data.');
        } catch (\Exception $e) {
            return redirect()->route('patients.show', ['patient' => $transferRoom->patient_id])
                ->with('error', 'Gagal Memperbarui Data! Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
