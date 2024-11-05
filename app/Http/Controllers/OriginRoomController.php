<?php

namespace App\Http\Controllers;

use App\Models\OriginRoom;
use App\Models\LabResult;
use App\Models\Agd;
use App\Models\Intubation;
use App\Models\Ttv;

use Illuminate\Http\Request;

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
        // dd($request);
        $request->validate([
            'origin_room_datetime' => 'required|date',
            'origin_room_name' => 'required|string|max:255',
            'radiology' => 'nullable|string',
            'ro_thorax' => 'nullable|string',
            'additional_check' => 'nullable|string',
            'main_diagnose_origin' => 'nullable|string',
            'secondary_diagnose_origin' => 'nullable|string',
            
            'hb_origin' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
            'leukosit_origin' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
            'pcv_origin' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
            'trombosit_origin' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
            'kreatinin_origin' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
            
            'ph_origin' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
            'pco2_origin' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
            'po2_origin' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
            'spo2_origin' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
        
            'intubation_location' => 'nullable|string|max:255',
            'dr_intubation_name' => 'nullable|string|max:255',
            'dr_consultant_name' => 'nullable|string|max:255',
            'therapy_type_origin' => 'nullable|string|max:255',
            'mode_venti_origin' => 'nullable|string|max:255',
            'ett_depth_origin' => 'nullable|string',
            'ipl_origin' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
            'peep_origin' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
            'fio2_origin' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
            'rr_origin' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
        
            'td' => 'nullable|string',
            'saturasi' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
            'nadi' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
            'rr_ttv' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
            'spo2' => 'nullable|numeric|regex:/^\d+(\.\d+)?$/',
        ], [
            'origin_room_datetime.required' => 'Tanggal dan waktu asal ruangan wajib diisi.',
            'origin_room_datetime.date' => 'Tanggal dan waktu asal ruangan tidak valid.',
            'origin_room_name.required' => 'Nama asal ruangan wajib diisi.',
            'origin_room_name.string' => 'Nama asal ruangan harus berupa teks.',
            'origin_room_name.max' => 'Nama asal ruangan tidak boleh lebih dari 255 karakter.',
            'hb_origin.numeric' => 'HB harus berupa angka.',
            'hb_origin.regex' => 'HB harus menggunakan titik (.) sebagai pemisah desimal.',
            'leukosit_origin.numeric' => 'Leukosit harus berupa angka.',
            'leukosit_origin.regex' => 'Leukosit harus menggunakan titik (.) sebagai pemisah desimal.',
            'pcv_origin.numeric' => 'PCV harus berupa angka.',
            'pcv_origin.regex' => 'PCV harus menggunakan titik (.) sebagai pemisah desimal.',
            'trombosit_origin.numeric' => 'Trombosit harus berupa angka.',
            'trombosit_origin.regex' => 'Trombosit harus menggunakan titik (.) sebagai pemisah desimal.',
            'kreatinin_origin.numeric' => 'Kreatinin harus berupa angka.',
            'kreatinin_origin.regex' => 'Kreatinin harus menggunakan titik (.) sebagai pemisah desimal.',
            'ph_origin.numeric' => 'PH harus berupa angka.',
            'ph_origin.regex' => 'PH harus menggunakan titik (.) sebagai pemisah desimal.',
            'pco2_origin.numeric' => 'PCO2 harus berupa angka.',
            'pco2_origin.regex' => 'PCO2 harus menggunakan titik (.) sebagai pemisah desimal.',
            'po2_origin.numeric' => 'PO2 harus berupa angka.',
            'po2_origin.regex' => 'PO2 harus menggunakan titik (.) sebagai pemisah desimal.',
            'spo2_origin.numeric' => 'SPO2 harus berupa angka.',
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
            'ett_depth_origin.string' => 'Kedalaman ETT harus berupa teks.',
            'ipl_origin.numeric' => 'IPL harus berupa angka.',
            'ipl_origin.regex' => 'IPL harus menggunakan titik (.) sebagai pemisah desimal.',
            'peep_origin.numeric' => 'PEEP harus berupa angka.',
            'peep_origin.regex' => 'PEEP harus menggunakan titik (.) sebagai pemisah desimal.',
            'fio2_origin.numeric' => 'FIO2 harus berupa angka.',
            'fio2_origin.regex' => 'FIO2 harus menggunakan titik (.) sebagai pemisah desimal.',
            'rr_origin.numeric' => 'RR harus berupa angka.',
            'rr_origin.regex' => 'RR harus menggunakan titik (.) sebagai pemisah desimal.',
            'td.string' => 'TD harus berupa teks.',
            'saturasi.numeric' => 'Saturasi harus berupa angka.',
            'saturasi.regex' => 'Saturasi harus menggunakan titik (.) sebagai pemisah desimal.',
            'nadi.numeric' => 'Nadi harus berupa angka.',
            'nadi.regex' => 'Nadi harus menggunakan titik (.) sebagai pemisah desimal.',
            'rr_ttv.numeric' => 'RR TTV harus berupa angka.',
            'rr_ttv.regex' => 'RR TTV harus menggunakan titik (.) sebagai pemisah desimal.',
            'spo2.numeric' => 'SPO2 harus berupa angka.',
            'spo2.regex' => 'SPO2 harus menggunakan titik (.) sebagai pemisah desimal.',
        ]);
        
        try {
            // Lab Results
            $labResult = LabResult::create([
                'hb' => $request->hb_origin,
                'leukosit' => $request->leukosit_origin,
                'pcv' => $request->pcv_origin,
                'trombosit' => $request->trombosit_origin,
                'kreatinin' => $request->kreatinin_origin,
            ]);

            // AGDS
            $agd = Agd::create([
                'ph' => $request->ph_origin,
                'pco2' => $request->pco2_origin,
                'po2' => $request->po2_origin,
                'spo2' => $request->spo2_origin,
            ]);

            // Intubations
            $intubation = Intubation::create([
                'intubation_location' => $request->intubation_location,
                'dr_intubation' => $request->dr_intubation_name,
                'dr_consultant' => $request->dr_consultant_name,
                'therapy_type' => $request->therapy_type_origin,
                'mode_venti' => $request->mode_venti_origin,
                'ett_depth' => $request->ett_depth_origin,
                'ipl' => $request->ipl_origin,
                'peep' => $request->peep_origin,
                'fio2' => $request->fio2_origin,
                'rr' => $request->rr_origin,
            ]);
            // dd($intubation);


            // TTV
            $ttv = Ttv::create([
                'td' => $request->td,
                'saturasi' => $request->saturasi,
                'nadi' => $request->nadi,
                'rr' => $request->rr_ttv,
                'spo2' => $request->spo2,
            ]);

            // Origin Room
            $originRoom = OriginRoom::create([
                'origin_room_datetime' => $request->origin_room_datetime,
                'origin_room_name' => $request->origin_room_name,
                'radiology' => $request->radiology,
                'ro_thorax' => $request->ro_thorax,
                'additional_check' => $request->additional_check,
                'main_diagnose' => $request->main_diagnose_origin,
                'secondary_diagnose' => $request->secondary_diagnose_origin,
                'labresult_id' => $labResult->id,
                'agd_id' => $agd->id,
                'intubation_id' => $intubation->id,
                'ttv_id' => $ttv->id,
                'patient_id' => $request->patient_id,
            ]);


            return redirect()->route('patients.show', ['patient' => $request->patient_id])
                ->with('success', 'Data asal ruangan dan data terkait berhasil disimpan.');
            } catch (\Exception $e) {
                return back()->withErrors(['error' => $e->getMessage()]);

                // return back()->withErrors(['msg' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
            }



            // return redirect()->route('patients.show', ['patient' => $patient->id])->with('success', 'Patient created successfully.');
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
