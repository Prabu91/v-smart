<?php

namespace App\Http\Controllers;

use App\Models\LabResult;
use App\Models\Observation;
use App\Models\VentilatorData;
use Illuminate\Http\Request;

class ObservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('observation.index');
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
        $validated1 = $request->validate([
            'origin_room_date' => 'required|date',
            'origin_room_name' => 'required|string|max:255',
            'patient_name' => 'required|string|max:255',
            'no_cm' => 'required|string|max:100',
            'hb_origin' => 'required|numeric',
            'leukosit_origin' => 'required|numeric',
            'pcv_origin' => 'required|numeric',
            'trobosit_origin' => 'required|numeric',
            'ph_origin' => 'required|numeric',
            'pco2_origin' => 'required|numeric',
            'po2_origin' => 'required|numeric',
            'radiology' => 'nullable|string|max:255',
            'ro_thorax' => 'required|boolean', 
            'dr_intubation_name' => 'nullable|string|max:255',
            'dr_consultant_name' => 'nullable|string|max:255',
            'therapy_type_origin' => 'nullable|string|max:255',
            'mode_venti_origin' => 'nullable|string|max:255',
            'ett_depth_origin' => 'nullable|string|max:50',
            'ipl_origin' => 'nullable|numeric',
            'peep_origin' => 'nullable|numeric',
            'fio2_origin' => 'nullable|numeric',
            'rr_origin' => 'nullable|numeric',
            'icu_room_date' => 'required|date',
            'icu_room_name' => 'required|string|max:255',
            'hb_icu' => 'required|numeric',
            'leukosit_icu' => 'required|numeric',
            'pcv_icu' => 'required|numeric',
            'trobosit_icu' => 'required|numeric',
            'ph_icu' => 'required|numeric',
            'pco2_icu' => 'required|numeric',
            'po2_icu' => 'required|numeric',
            'radiology' => 'nullable|string|max:255',
            'ro_thorax' => 'required|boolean', 
            'ph_icu' => 'required|numeric',
            'pco2_icu' => 'required|numeric',
            'po2_icu' => 'required|numeric',
            'ro'
            'ro_post_incubation'
            'blood_culture'
            'therapy'

            'ventilators' => 'array',
            'ventilators.*.mode_venti' => 'required|string',
            'ventilators.*.ett_kedalaman' => 'required|numeric',
            'ventilators.*.ipl' => 'required|numeric',
            'ventilators.*.peep' => 'required|numeric',
            'ventilators.*.fio2' => 'required|numeric',
            'ventilators.*.rr' => 'required|numeric',
            'ttv.*.td' => 'required|numeric',
            'ttv.*.saturasi' => 'required|numeric',
            'ttv.*.nadi' => 'required|numeric',
            'ttv.*.rr' => 'required|numeric',
            'ttv.*.spo2' => 'required|numeric',
            
            
            'excubation_date'
            'preparation_extubation_therapy'
            'excubation'
            'nebu_adrenalin'
            'dexamethasone'

        ]);

        // Transaksi database dengan try-catch
    try {
        // Mulai transaksi database
        DB::beginTransaction();

        $patient = new Patient();
        $patient->name = $validated1['patient_name'];
        $patient->no_cm = $validated1['no_cm'];
        $patient->save();
        
        $intubationDoctor = new Doctor();
        $intubationDoctor->name = $validated1['dr_intubation_name'];
        $intubationDoctor->specialist = 'Intubation'; // Set spesialisasi intubasi
        $intubationDoctor->save();
        
        $consultantDoctor = new Doctor();
        $consultantDoctor->name = $validated1['dr_consultant_name'];
        $consultantDoctor->specialist = 'Consultant'; // Set spesialisasi konsultan
        $consultantDoctor->save();

        // Simpan data ke tabel 'observations' (contoh nama tabel)
        $observation = new Observation();
            $observation->origin_room_date = $validated1['origin_room_date'];
            $observation->origin_room_name = $validated1['origin_room_name'];
            $observation->patient_id = $patient->id; 
            $observation->user_id = auth()->id(); 
            $observation->intubation_dr_id = $intubationDoctor->id; 
            $observation->consultant_dr_id = $consultantDoctor->id; 
        $observation->save();
        
        $labResult = new LabResult();
            $labResult->observation_id = $observation->id; 
            $labResult->hb = $validated1['hb1'];
            $labResult->leukosit = $validated1['leukosit1'];
            $labResult->pcv = $validated1['pcv1'];
            $labResult->trobosit = $validated1['trobosit1'];
            $labResult->ph = $validated1['ph1'];
            $labResult->pco2 = $validated1['pco21'];
            $labResult->po2 = $validated1['po21'];
            $labResult->radiology = $validated1['radiology'];
            $labResult->ro_thorax = $validated1['ro_thorax'];
        $labResult->save();

        
        $VentilatorData = new VentilatorData();
            $VentilatorData->observation_id = $observation->id;
            $VentilatorData->therapy_type = $validated1['therapy_type1'];
            $VentilatorData->mode_venti = $validated1['mode_venti1'];
            $VentilatorData->ett_depth = $validated1['ett_depth1'];
            $VentilatorData->ipl = $validated1['ipl1'];
            $VentilatorData->peep = $validated1['peep1'];
            $VentilatorData->fio2 = $validated1['fio21'];
            $VentilatorData->rr = $validated1['rr1'];
        $VentilatorData->save();

        // Commit transaksi jika berhasil
        DB::commit();

        return redirect()->route('observations.index')->with('success', 'Data observasi berhasil disimpan');
    } catch (\Exception $e) {
        // Rollback jika terjadi error
        DB::rollBack();

        // Kembalikan error
        return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
    }



    }

    /**
     * Display the specified resource.
     */
    public function show(Observation $observation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Observation $observation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Observation $observation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Observation $observation)
    {
        //
    }
}
