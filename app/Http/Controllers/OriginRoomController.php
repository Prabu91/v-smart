<?php

namespace App\Http\Controllers;

use App\Models\OriginRoom;
use App\Models\LabResult;
use App\Models\Agd;
use App\Models\Intubation;
use App\Models\Ttv;

use Illuminate\Http\Request;
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
        return view('observation.origin-room.index', compact('patient_id'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'origin_room_datetime' => 'required|date',
            'origin_room_name' => 'required|string|max:255',
            'radiology' => 'nullable|string',
            'ro_thorax' => 'nullable|string',
            'additional_check' => 'nullable|string',
            'main_diagnose_origin' => 'nullable|string',
            'secondary_diagnose_origin' => 'nullable|string',
            
            'hb_origin' => 'required|numeric',
            'leukosit_origin' => 'required|numeric',
            'pcv_origin' => 'required|numeric',
            'trombosit_origin' => 'required|numeric',
            'kreatinin_origin' => 'required|numeric',
            
            'ph_origin' => 'required|numeric',
            'pco2_origin' => 'required|numeric',
            'po2_origin' => 'required|numeric',
            'spo2_origin' => 'required|numeric',
        
            'intubation_location' => 'nullable|string|max:255',
            'dr_intubation_name' => 'nullable|string|max:255',
            'dr_consultant_name' => 'nullable|string|max:255',
            'therapy_type_origin' => 'nullable|string|max:255',
            'mode_venti_origin' => 'nullable|string|max:255',
            'diameter_origin' => 'nullable|numeric',
            'depth_origin' => 'nullable|numeric',
            'ipl_origin' => 'nullable|numeric',
            'peep_origin' => 'nullable|numeric',
            'fio2_origin' => 'nullable|numeric',
            'rr_origin' => 'nullable|numeric',
        
            'sistolik' => 'nullable|numeric',
            'diastolik' => 'nullable|numeric',
            'suhu' => 'nullable|numeric',
            'nadi' => 'nullable|numeric',
            'rr_ttv' => 'nullable|numeric',
            'spo2' => 'nullable|numeric',
        // ]);

        ], [
            'origin_room_datetime.required' => 'Tanggal dan waktu asal ruangan wajib diisi.',
            'origin_room_datetime.date' => 'Tanggal dan waktu asal ruangan tidak valid.',
            'origin_room_name.required' => 'Nama asal ruangan wajib diisi.',
            'origin_room_name.string' => 'Nama asal ruangan harus berupa teks.',
            'origin_room_name.max' => 'Nama asal ruangan tidak boleh lebih dari 255 karakter.',

            'hb_origin.numeric' => 'HB harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'leukosit_origin.numeric' => 'Leukosit harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'pcv_origin.numeric' => 'PCV harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'trombosit_origin.numeric' => 'Trombosit harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'kreatinin_origin.numeric' => 'Kreatinin harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'hb_origin.required' => 'Kolom Wajib diisi.',
            'leukosit_origin.required' => 'Kolom Wajib diisi.',
            'pcv_origin.required' => 'Kolom Wajib diisi.',
            'trombosit_origin.required' => 'Kolom Wajib diisi.',
            'kreatinin_origin.required' => 'Kolom Wajib diisi.',

            'ph_origin.numeric' => 'PH harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'pco2_origin.numeric' => 'PCO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'po2_origin.numeric' => 'PO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'spo2_origin.numeric' => 'SPO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'ph_origin.required' => 'Kolom Wajib diisi.',
            'pco2_origin.required' => 'Kolom Wajib diisi.',
            'po2_origin.required' => 'Kolom Wajib diisi.',
            'spo2_origin.required' => 'Kolom Wajib diisi.',
            'spo2_origin.regex' => 'SPO2 harus menggunakan titik (.) sebagai pemisah desimal.',
            'intubation_location.string' => 'Lokasi intubasi harus berupa teks.',
            'intubation_location.max' => 'Lokasi intubasi tidak boleh lebih dari 255 karakter.',
            'dr_intubation_name.string' => 'Nama dokter intubasi harus berupa teks.',
            'dr_intubation_name.max' => 'Nama dokter intubasi tidak boleh lebih dari 255 karakter.',
            'dr_consultant_name.string' => 'Nama dokter konsultan harus berupa teks.',
            'dr_consultant_name.max' => 'Nama dokter konsultan tidak boleh lebih dari 255 karakter.',
            'therapy_type_origin.string' => 'Tipe terapi harus berupa teks.',
            'therapy_type_origin.max' => 'Tipe terapi tidak boleh lebih dari 255 karakter.',
            'mode_venti_origin.string' => 'Mode ventilasi harus berupa teks.',
            'mode_venti_origin.max' => 'Mode ventilasi tidak boleh lebih dari 255 karakter.',
            'diameter_origin.numeric' => 'Kedalaman ETT harus berupa angka.',
            'depth_origin.numeric' => 'Kedalaman ETT harus berupa angka.',
            'ipl_origin.numeric' => 'IPL harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'peep_origin.numeric' => 'PEEP harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'fio2_origin.numeric' => 'FIO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'rr_origin.numeric' => 'RR harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
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
                'hb' => $request->hb_origin,
                'leukosit' => $request->leukosit_origin,
                'pcv' => $request->pcv_origin,
                'trombosit' => $request->trombosit_origin,
                'kreatinin' => $request->kreatinin_origin,
            ]);

            // AGDS
            $agd = Agd::create([
                'patient_id' => $request->patient_id,
                'ph' => $request->ph_origin,
                'pco2' => $request->pco2_origin,
                'po2' => $request->po2_origin,
                'spo2' => $request->spo2_origin,
            ]);
            
                if ($request->intConf === 'yes') {
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
                        'intubation_datetime' => $request->origin_room_datetime,
                        'intubation_location' => $request->intubation_location,
                        'dr_intubation' => $request->dr_intubation_name,
                        'dr_consultant' => $request->dr_consultant_name,
                        'therapy_type' => $request->therapy_type_origin,
                        'mode_venti' => $request->mode_venti_origin,
                        'diameter' => $request->diameter_origin,
                        'depth' => $request->depth_origin,
                        'ipl' => $request->ipl_origin,
                        'peep' => $request->peep_origin,
                        'fio2' => $request->fio2_origin,
                        'rr' => $request->rr_origin,
                        'ttv_id' => $ttv->id,
                    ]);
                } else {
                    $intubation = null;
                }
            
                OriginRoom::create([
                    'origin_room_datetime' => $request->origin_room_datetime,
                    'origin_room_name' => $request->origin_room_name,
                    'radiology' => $request->radiology,
                    'ro_thorax' => $request->ro_thorax,
                    'additional_check' => $request->additional_check,
                    'main_diagnose' => $request->main_diagnose_origin,
                    'secondary_diagnose' => $request->secondary_diagnose_origin,
                    'labresult_id' => $labResult->id,
                    'agd_id' => $agd->id,
                    'intubation_id' => $intubation?->id,
                    'patient_id' => $request->patient_id,
                ]);
            });

            return redirect()->route('patients.show', ['patient' => $request->patient_id])
                ->with('success', 'Data asal ruangan dan data terkait berhasil disimpan.');
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
