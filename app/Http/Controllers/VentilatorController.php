<?php

namespace App\Http\Controllers;

use App\Models\Intubation;
use App\Models\Ttv;
use App\Models\Ventilator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentilatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $patient_id = $request->query('patient_id');
        return view('observation.icu-room.ventilator.create', compact('patient_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'venti_datetime' => 'required',
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
            'venti_datetime.required' => 'Waktu harus diisi.',
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
                $intubation = Intubation::where('patient_id', $request->patient_id)->first();

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
                
                $ventilator = Ventilator::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $request->user_id,
                    'ttv_id' => $ttv->id,
                    'intubation_id' => $intubation->id,
                    'venti_datetime' => $request->venti_datetime,
                    'therapy_type' => $request->therapy_type,
                    'mode_venti' => $request->mode_venti,
                    'diameter' => $request->diameter,
                    'depth' => $request->depth,
                    'ipl' => $request->ipl,
                    'peep' => $request->peep,
                    'fio2' => $request->fio2,
                    'rr' => $request->rr,
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
    public function show(Ventilator $ventilator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ventilator $ventilator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ventilator $ventilator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ventilator $ventilator)
    {
        //
    }
}
