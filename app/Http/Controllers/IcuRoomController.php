<?php

namespace App\Http\Controllers;

use App\Models\Agd;
use App\Models\IcuRoom;
use App\Models\Intubation;
use App\Models\LabResult;
use App\Models\Ttv;
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
        $patient_id = $request->query('patient');
        return view('observation.icu-room.create', compact('patient_id'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icu_room_datetime' => 'required|date',
            'icu_room_name' => 'required|string|max:255',
            'icu_room_bednum' => 'required|numeric',
            'ro' => 'required|string',
            'ro_post_incubation' => 'nullable|string',
            'blood_culture' => 'nullable|string',
            
            'hb_icu' => 'required|numeric',
            'leukosit_icu' => 'required|numeric',
            'pcv_icu' => 'required|numeric',
            'trombosit_icu' => 'required|numeric',
            'kreatinin_icu' => 'required|numeric',
            
            'ph_icu' => 'required|numeric',
            'pco2_icu' => 'required|numeric',
            'po2_icu' => 'required|numeric',
            'spo2_icu' => 'required|numeric',
        ], [
            'icu_room_datetime.required' => 'Tanggal dan waktu asal ruangan wajib diisi.',
            'icu_room_datetime.date' => 'Tanggal dan waktu asal ruangan tidak valid.',
            'icu_room_name.required' => 'Nama asal ruangan wajib diisi.',
            'icu_room_name.string' => 'Nama asal ruangan harus berupa teks.',
            'icu_room_bednum.required' => 'Kolom wajib diisi.',
            'icu_room_name.max' => 'Nama asal ruangan tidak boleh lebih dari 255 karakter.',
            'hb_icu.required' => 'Kolom wajib diisi.',
            'hb_icu.numeric' => 'HB harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'leukosit_icu.required' => 'Kolom wajib diisi.',
            'leukosit_icu.numeric' => 'Leukosit harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'pcv_icu.required' => 'Kolom wajib diisi.',
            'pcv_icu.numeric' => 'PCV harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'trombosit_icu.required' => 'Kolom wajib diisi.',
            'trombosit_icu.numeric' => 'Trombosit harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'kreatinin_icu.required' => 'Kolom wajib diisi.',
            'kreatinin_icu.numeric' => 'Kreatinin harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'ph_icu.required' => 'Kolom wajib diisi.',
            'ph_icu.numeric' => 'PH harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'pco2_icu.required' => 'Kolom wajib diisi.',
            'pco2_icu.numeric' => 'PCO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'po2_icu.required' => 'Kolom wajib diisi.',
            'po2_icu.numeric' => 'PO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'spo2_icu.required' => 'Kolom wajib diisi.',
            'spo2_icu.numeric' => 'SPO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
        ]);

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
                ]);

                // AGDS
                $agd = Agd::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $request->user_id,
                    'ph' => $request->ph_icu,
                    'pco2' => $request->pco2_icu,
                    'po2' => $request->po2_icu,
                    'spo2' => $request->spo2_icu,
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
                    'labresult_id' => $labResult->id,
                    'agd_id' => $agd->id,
                    // 'intubation_id' => $intubation->id,
                    'patient_id' => $request->patient_id,
                ]);
            });

            return redirect()->route('patients.show', ['patient' => $request->patient_id])
                ->with('success', 'Data Ruang Intensif berhasil disimpan.');
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
