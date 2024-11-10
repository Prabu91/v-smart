<?php

namespace App\Http\Controllers;

use App\Models\LabResult;
use App\Models\TransferRoom;
use App\Models\Ttv;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        $request->validate([
            'transfer_room_datetime' => 'required',
            'transfer_room_name' => 'nullable|string|max:255',
            'lab_culture_data' => 'required',
            'main_diagnose_origin' => 'nullable|string',
            'secondary_diagnose_origin' => 'nullable|string',

            'hb_icu' => 'nullable|numeric',
            'leukosit_icu' => 'nullable|numeric',
            'pcv_icu' => 'nullable|numeric',
            'trombosit_icu' => 'nullable|numeric',
            'kreatinin_icu' => 'nullable|numeric',
            
            'sistolik' => 'nullable|numeric',
            'diastolik' => 'nullable|numeric',
            'suhu' => 'nullable|numeric',
            'nadi' => 'nullable|numeric',
            'rr_ttv' => 'nullable|numeric',
            'spo2' => 'nullable|numeric',
        ], [
            'transfer_room_datetime.required' => 'Lokasi intubasi harus diisi.',
            'lab_culture_data' => 'Field harus diisi.',
            'transfer_room_name.string' => 'Nama dokter intubasi harus berupa teks.',
            'transfer_room_name.max' => 'Nama dokter intubasi tidak boleh lebih dari 255 karakter.',
            
            'hb_icu.numeric' => 'HB harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'leukosit_icu.numeric' => 'Leukosit harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'pcv_icu.numeric' => 'PCV harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'trombosit_icu.numeric' => 'Trombosit harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'kreatinin_icu.numeric' => 'Kreatinin harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            
            'sistolik.numeric' => 'Sistolik harus berupa angka.',
            'diastolik.numeric' => 'Diastolik harus berupa angka.',
            'suhu.numeric' => 'Suhu harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'nadi.numeric' => 'Nadi harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'rr_ttv.numeric' => 'RR TTV harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'spo2.numeric' => 'SPO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $labResult = LabResult::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $request->user_id,
                    'hb' => $request->hb_transfer,
                    'leukosit' => $request->leukosit_transfer,
                    'pcv' => $request->pcv_transfer,
                    'trombosit' => $request->trombosit_transfer,
                    'kreatinin' => $request->kreatinin_transfer,
                ]);

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

                $transferRoom = TransferRoom::create([
                    'user_id' => $request->user_id,
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
            ->with('success', 'Data pindah ruangan.');
        } catch (\Exception $e) {
            dd($e->getMessage());
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
