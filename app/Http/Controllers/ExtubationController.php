<?php

namespace App\Http\Controllers;

use App\Models\Extubation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExtubationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('observation.icu-room.extubation.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {        
        $patient_id = $request->query('patient_id');
        return view('observation.icu-room.extubation.index',compact('patient_id'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'extubation_datetime' => 'required|date',
            'preparation_extubation_therapy' => 'required|string|max:255',
            'extubation' => 'required|string',
            'nebu_adrenalin' => 'required|numeric',
            'dexamethasone' => 'required|numeric',
            'patient_status' => 'required|string',
        ], [
            'extubation_datetime.required' => 'Tanggal dan waktu Extubasi wajib diisi.',
            'extubation_datetime.date' => 'Tanggal dan waktu Extubasi tidak valid.',
            'preparation_extubation_theraphy.required' => 'Theraphy Extubasi wajib diisi.',
            'preparation_extubation_theraphy.string' => 'Theraphy Extubasi harus berupa teks.',
            'extubation.required' => 'Tindakan Extubasi wajib diisi.',
            'extubation.string' => 'Tindakan Extubasi harus berupa teks.',
            'nebu_adrenalin.required' => 'Nebu Adrenalin wajib diisi.',
            'nebu_adrenalin.numeric' => 'Nebu Adrenalin harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'dexamethasone.required' => 'Tindakan Extubasi wajib diisi.',
            'dexamethasone.numeric' => 'Dexamethasone harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'patient_status.required' => 'Status Pasien wajib diisi.'
        ]);
        
        try {
                Extubation::create([
                    'patient_id' => $request->patient_id,
                    'extubation_datetime' => $request->extubation_datetime,
                    'preparation_extubation_therapy' => $request->preparation_extubation_therapy,
                    'extubation' => $request->extubation,
                    'nebu_adrenalin' => $request->nebu_adrenalin,
                    'dexamethasone' => $request->dexamethasone,
                    'patient_status' => $request->patient_status,
                ]);
                return redirect()->route('patients.show', ['patient' => $request->patient_id])
                ->with('success', 'Data extubasi berhasil disimpan.');
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Extubation $extubation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Extubation $extubation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Extubation $extubation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Extubation $extubation)
    {
        //
    }
}
