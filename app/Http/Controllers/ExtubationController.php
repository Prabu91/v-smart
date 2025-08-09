<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExtubationRequest;
use App\Models\Extubation;
use App\Models\Ttv;
use App\Models\User;
use App\Support\LogHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('observation.icu-room.extubation.create',compact('patient_id'));
    }


    public function store(StoreExtubationRequest $request)
    {
        try {
            DB::transaction(function () use ($request, &$user, &$extubation) {
                $extubationDatetime = Carbon::parse($request->extubation_datetime)->format('Y-m-d H:i:s');

                $userId = Auth::id();
                $user = User::where('id', $userId)->first();

                if ($request->patient_status == "Tidak Meninggal") {
                    $ttv = Ttv::create([
                        'patient_id' => $request->patient_id,
                        'user_id' => $userId,
                        'sistolik' => $request->sistolik,
                        'diastolik' => $request->diastolik,
                        'suhu' => $request->suhu,
                        'nadi' => $request->nadi,
                        'rr' => $request->rr_ttv,
                        'spo2' => $request->spo2,
                        'consciousness' => $request->consciousness,
                    ]);

                    $ttvId = $ttv->id;
                } else {
                    $ttvId = null;
                }

                $extubation = Extubation::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $userId,
                    'ttv_id' => $ttvId,
                    'extubation_datetime' => $extubationDatetime,
                    'preparation_extubation_therapy' => $request->preparation_extubation_therapy,
                    'extubation' => $request->extubation,
                    'nebulizer' => $request->nebulizer,
                    'patient_status' => $request->patient_status,
                    'extubation_notes' => $request->extubation_notes,
                ]);
            });

            LogHelper::log('Tambah Extubation', "(ID : {$user->name}) Menambah Data Extubation {$extubation->id}");
            return redirect()->route('patients.show', ['patient' => $request->patient_id])
                ->with('success', 'Berhasil Menyimpan Data.');
        } catch (\Exception $e) {
            return redirect()->route('patients.show', ['patient' => $request->patient_id])
                ->with('error', 'Gagal Menyimpan Data! Error: ' . $e->getMessage());
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
