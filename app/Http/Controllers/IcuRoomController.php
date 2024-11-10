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
        $patient_id = $request->query('patient_id');
        return view('observation.icu-room.index', compact('patient_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icu_room_datetime' => 'required|date',
            'icu_room_name' => 'required|string|max:255',
            'ro' => 'required|string',
            'ro_post_incubation' => 'nullable|string',
            'blood_culture' => 'nullable|string',
            
            'hb_icu' => 'nullable|numeric',
            'leukosit_icu' => 'nullable|numeric',
            'pcv_icu' => 'nullable|numeric',
            'trombosit_icu' => 'nullable|numeric',
            'kreatinin_icu' => 'nullable|numeric',
            
            'ph_icu' => 'nullable|numeric',
            'pco2_icu' => 'nullable|numeric',
            'po2_icu' => 'nullable|numeric',
            'spo2_icu' => 'nullable|numeric',
        
            'intubation_location' => 'nullable|string|max:255',
            'dr_intubation_name' => 'nullable|string|max:255',
            'dr_consultant_name' => 'nullable|string|max:255',
            'therapy_type_icu' => 'nullable|string|max:255',
            'mode_venti_icu' => 'nullable|string|max:255',
            'diameter_icu' => 'nullable|numeric',
            'depth_icu' => 'nullable|numeric',
            'ipl_icu' => 'nullable|numeric',
            'peep_icu' => 'nullable|numeric',
            'fio2_icu' => 'nullable|numeric',
            'rr_icu' => 'nullable|numeric',
        
            'sistolik' => 'nullable|numeric',
            'diastolik' => 'nullable|numeric',
            'suhu' => 'nullable|numeric',
            'nadi' => 'nullable|numeric',
            'rr_ttv' => 'nullable|numeric',
            'spo2' => 'nullable|numeric',
        ], [
            'icu_room_datetime.required' => 'Tanggal dan waktu asal ruangan wajib diisi.',
            'icu_room_datetime.date' => 'Tanggal dan waktu asal ruangan tidak valid.',
            'icu_room_name.required' => 'Nama asal ruangan wajib diisi.',
            'icu_room_name.string' => 'Nama asal ruangan harus berupa teks.',
            'icu_room_name.max' => 'Nama asal ruangan tidak boleh lebih dari 255 karakter.',
            'hb_icu.numeric' => 'HB harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'leukosit_icu.numeric' => 'Leukosit harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'pcv_icu.numeric' => 'PCV harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'trombosit_icu.numeric' => 'Trombosit harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'kreatinin_icu.numeric' => 'Kreatinin harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'ph_icu.numeric' => 'PH harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'pco2_icu.numeric' => 'PCO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'po2_icu.numeric' => 'PO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'spo2_icu.numeric' => 'SPO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'spo2_icu.regex' => 'SPO2 harus menggunakan titik (.) sebagai pemisah desimal.',
            'intubation_location.string' => 'Lokasi intubasi harus berupa teks.',
            'intubation_location.max' => 'Lokasi intubasi tidak boleh lebih dari 255 karakter.',
            'dr_intubation_name.string' => 'Nama dokter intubasi harus berupa teks.',
            'dr_intubation_name.max' => 'Nama dokter intubasi tidak boleh lebih dari 255 karakter.',
            'dr_consultant_name.string' => 'Nama dokter konsultan harus berupa teks.',
            'dr_consultant_name.max' => 'Nama dokter konsultan tidak boleh lebih dari 255 karakter.',
            'therapy_type_icu.string' => 'Tipe terapi harus berupa teks.',
            'therapy_type_icu.max' => 'Tipe terapi tidak boleh lebih dari 255 karakter.',
            'mode_venti_icu.string' => 'Mode ventilasi harus berupa teks.',
            'mode_venti_icu.max' => 'Mode ventilasi tidak boleh lebih dari 255 karakter.',
            'diameter_icu.numeric' => 'Kedalaman ETT harus berupa angka.',
            'depth_icu.numeric' => 'Kedalaman ETT harus berupa angka.',
            'ipl_icu.numeric' => 'IPL harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'peep_icu.numeric' => 'PEEP harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'fio2_icu.numeric' => 'FIO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'rr_icu.numeric' => 'RR harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'td.numeric' => 'TD harus berupa angka.',
            'sistolik.numeric' => 'Kedalaman ETT harus berupa angka.',
            'diastolik.numeric' => 'Kedalaman ETT harus berupa angka.',
            'saturasi.numeric' => 'Saturasi harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'nadi.numeric' => 'Nadi harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'rr_ttv.numeric' => 'RR TTV harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'spo2.numeric' => 'SPO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Lab Results
                $labResult = LabResult::create([
                    'patient_id' => $request->patient_id,
                    'hb' => $request->hb_icu,
                    'leukosit' => $request->leukosit_icu,
                    'pcv' => $request->pcv_icu,
                    'trombosit' => $request->trombosit_icu,
                    'kreatinin' => $request->kreatinin_icu,
                ]);

                // AGDS
                $agd = Agd::create([
                    'patient_id' => $request->patient_id,
                    'ph' => $request->ph_icu,
                    'pco2' => $request->pco2_icu,
                    'po2' => $request->po2_icu,
                    'spo2' => $request->spo2_icu,
                ]);
                
                $ttv = Ttv::create([
                    'patient_id' => $request->patient_id,
                    'sistolik' => $request->sistolik,
                    'diastolik' => $request->diastolik,
                    'suhu' => $request->suhu,
                    'nadi' => $request->nadi,
                    'rr' => $request->rr_ttv,
                    'spo2' => $request->spo2,
                ]);
                
                $intubation = Intubation::create([
                    'patient_id' => $request->patient_id,
                    'intubation_datetime' => $request->icu_room_datetime,
                    'intubation_location' => $request->icu_room_name,
                    'dr_intubation' => $request->dr_intubation_name,
                    'dr_consultant' => $request->dr_consultant_name,
                    'therapy_type' => $request->therapy_type_icu,
                    'mode_venti' => $request->mode_venti_icu,
                    'diameter' => $request->diameter_icu,
                    'depth' => $request->depth_icu,
                    'ipl' => $request->ipl_icu,
                    'peep' => $request->peep_icu,
                    'fio2' => $request->fio2_icu,
                    'rr' => $request->rr_icu,
                    'ttv_id' => $ttv->id,
                ]);

                // ICU Room
                $icuRoom = IcuRoom::create([
                    'icu_room_datetime' => $request->icu_room_datetime,
                    'icu_room_name' => $request->icu_room_name,
                    'ro' => $request->ro,
                    'ro_post_intubation' => $request->ro_post_intubation,
                    'blood_culture' => $request->blood_culture,
                    'labresult_id' => $labResult->id,
                    'agd_id' => $agd->id,
                    'intubation_id' => $intubation->id,
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
