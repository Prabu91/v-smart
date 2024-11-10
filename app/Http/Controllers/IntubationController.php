<?php

namespace App\Http\Controllers;

use App\Models\Agd;
use App\Models\IcuRoom;
use App\Models\Intubation;
use App\Models\Ttv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IntubationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('observation.icu-room.intubation');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $patient_id = $request->query('patient_id');
        return view('observation.icu-room.intubation', compact('patient_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
        $request->validate([
            'intubation_datetime' => 'required',
            'dr_intubation_name' => 'nullable|string|max:255',
            'dr_consultant_name' => 'nullable|string|max:255',
            'therapy_type' => 'nullable|string|max:255',
            'mode_venti' => 'nullable|string|max:255',
            'diameter' => 'nullable|numeric',
            'depth' => 'nullable|numeric',
            'ipl' => 'nullable|numeric',
            'peep' => 'nullable|numeric',
            'fio2' => 'nullable|numeric',
            'rr' => 'nullable|numeric',
        
            'sistolik' => 'nullable|numeric',
            'diastolik' => 'nullable|numeric',
            'suhu' => 'nullable|numeric',
            'nadi' => 'nullable|numeric',
            'rr_ttv' => 'nullable|numeric',
            'spo2' => 'nullable|numeric',
        ], [
            'intubation_datetime.required' => 'Lokasi intubasi harus diisi.',
            'change_mode_day' => 'Field harus diisi.',
            'dr_intubation_name.string' => 'Nama dokter intubasi harus berupa teks.',
            'dr_intubation_name.max' => 'Nama dokter intubasi tidak boleh lebih dari 255 karakter.',
            'dr_consultant_name.string' => 'Nama dokter konsultan harus berupa teks.',
            'dr_consultant_name.max' => 'Nama dokter konsultan tidak boleh lebih dari 255 karakter.',
            'therapy_type.string' => 'Tipe terapi harus berupa teks.',
            'therapy_type.max' => 'Tipe terapi tidak boleh lebih dari 255 karakter.',
            'mode_venti.string' => 'Mode ventilasi harus berupa teks.',
            'mode_venti.max' => 'Mode ventilasi tidak boleh lebih dari 255 karakter.',
            'diameter.numeric' => 'Kedalaman ETT harus berupa angka.',
            'depth.numeric' => 'Kedalaman ETT harus berupa angka.',
            'ipl.numeric' => 'IPL harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'peep.numeric' => 'PEEP harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'fio2.numeric' => 'FIO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'rr.numeric' => 'RR harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'sistolik.numeric' => 'Sistolik harus berupa angka.',
            'diastolik.numeric' => 'Diastolik harus berupa angka.',
            'suhu.numeric' => 'Suhu harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'nadi.numeric' => 'Nadi harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'rr_ttv.numeric' => 'RR TTV harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'spo2.numeric' => 'SPO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $icuRoom = IcuRoom::where('patient_id', $request->patient_id)->first();
                $intubation_location = $icuRoom->icu_room_name;

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
                    'intubation_datetime' => $request->intubation_datetime,
                    'intubation_location' => $intubation_location,
                    'dr_intubation' => $request->dr_intubation_name,
                    'dr_consultant' => $request->dr_consultant_name,
                    'therapy_type' => $request->therapy_type,
                    'mode_venti' => $request->mode_venti,
                    'diameter' => $request->diameter,
                    'depth' => $request->depth,
                    'ipl' => $request->ipl,
                    'peep' => $request->peep,
                    'fio2' => $request->fio2,
                    'rr' => $request->rr,
                    'ttv_id' => $ttv->id,
                ]);
            });

        return redirect()->route('patients.show', ['patient' => $request->patient_id])
            ->with('success', 'Data intubasi dan data terkait berhasil disimpan.');
        } catch (\Exception $e) {
            dd($e->getMessage());
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
