<?php

namespace App\Http\Controllers;

use App\Models\Extubation;
use App\Models\IcuRoom;
use App\Models\Intubation;
use App\Models\OriginRoom;
use App\Models\Patient;
use App\Models\TransferRoom;
use App\Models\Ttv;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('patients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_jkn' => 'required|string|size:13|unique:patients',
            'no_rm' => 'required|string',
        ], [
            'name.required' => 'Nama harus diisi.',
            'no_jkn.required' => 'Nomor JKN harus diisi.',
            'no_jkn.size' => 'Nomor JKN harus terdiri dari tepat 13 angka.',
            'no_jkn.unique' => 'Nomor JKN sudah terdaftar.',
            'no_rm.required' => 'Nomor Rekam Medis harus diisi.',
        ]);
        

        $patient = Patient::create($request->only('name', 'no_jkn', 'no_rm','user_id'));

        return redirect()->route('patients.show', ['patient' => $patient->id])->with('success', 'Patient created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        $origin = OriginRoom::with('labResult', 'intubation', 'agd')->where('patient_id', $id)->first();
        $icu = IcuRoom::with('labResult', 'intubation', 'agd')->where('patient_id', $id)->first();
        $intubations = Intubation::where('patient_id', $id)
            ->with(['ventilators.ttv'])
            ->first();
        // $intubations = Intubation::with('ttv')->where('patient_id', $id)->get();  // Mengambil semua data intubasi
        $extubation = Extubation::where('patient_id', $id)->first();
        $transfer = TransferRoom::with('labResult', 'ttv')->where('patient_id', $id)->first();
        return view('patients.detail', compact('patient', 'origin', 'icu', 'intubations', 'extubation', 'transfer'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
