<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('observation.patient');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_jkn' => 'required|string|size:13|unique:patients',
        ], [
            'name.required' => 'Nama harus diisi.',
            'no_jkn.required' => 'Nomor JKN harus diisi.',
            'no_jkn.size' => 'Nomor JKN harus terdiri dari tepat 13 angka.',
            'no_jkn.unique' => 'Nomor JKN sudah terdaftar.',
        ]);
        

        Patient::create($request->only('name', 'no_jkn'));

        return redirect()->back()->with('success', 'Patient created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
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
