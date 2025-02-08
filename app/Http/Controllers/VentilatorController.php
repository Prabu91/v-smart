<?php

namespace App\Http\Controllers;

use App\Models\Intubation;
use App\Models\Ttv;
use App\Models\User;
use App\Models\Ventilator;
use App\Support\LogHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    }

    public function release($id, Request $request)
    {
        try {
            $user = User::where('id', Auth::id())->first();
            // Cari record Ventilator berdasarkan ID
            $ventilator = Ventilator::findOrFail($id);

            // Periksa apakah venti_usagetime sudah terisi
            if ($ventilator->venti_usagetime) {
                return response()->json(['message' => 'Venti sudah dilepas sebelumnya.'], 400);
            }

            // Simpan timestamp saat ini ke venti_usagetime
            $ventilator->venti_usagetime = Carbon::now();
            $ventilator->save();

            LogHelper::log('btn: Lepas Venti', "(ID : {$user->name}) Lepas Ventilator {$ventilator->id}");

            return response()->json(['message' => 'Venti berhasil dilepas.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat melepaskan venti.'], 500);
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
