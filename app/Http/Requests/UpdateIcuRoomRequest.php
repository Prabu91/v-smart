<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIcuRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patient_id' => 'required|uuid|exists:patients,id',

            'icu_room_datetime' => 'nullable|date|after_or_equal:today',
            'icu_room_name' => 'nullable|string', 
            'icu_room_bednum' => 'nullable|integer|min:1', 

            'natrium' => 'nullable|numeric', 
            'kalium' => 'nullable|numeric', 
            'calsium' => 'nullable|numeric', 
            'magnesium' => 'nullable|numeric', 
            'clorida' => 'nullable|numeric', 

            'hb_icu' => 'nullable|numeric|between:10,18', 
            'leukosit_icu' => 'nullable|numeric|between:4000,12000', 
            'pcv_icu' => 'nullable|numeric|between:30,50', 
            'trombosit_icu' => 'nullable|numeric|between:150000,400000', 
            'kreatinin_icu' => 'nullable|numeric|between:0.5,1.5',

            'albumin' => 'nullable|numeric|between:1,10',
            'laktat' => 'nullable|numeric|between:0,10',
            'sbut' => 'nullable|numeric|between:0,10',
            'ureum' => 'nullable|numeric|between:5,100',
            
            'ph_icu' => 'nullable|numeric|between:7,8',
            'pco2_icu' => 'nullable|numeric|between:30,60',
            'po2_icu' => 'nullable|numeric|between:60,100',
            'spo2_icu' => 'nullable|numeric|between:80,100',
            'be_icu' => 'nullable|numeric|between:-10,10',
            'sbpt' => 'nullable|numeric|between:10,50',
            'pf_ratio' => 'nullable|numeric',
            'hco3' => 'nullable|numeric',
            'tco2' => 'nullable|numeric',

            'ro' => 'nullable|in:sudah,belum',
            'blood_culture' => 'nullable|string|max:255',
            'ro_post_intubation' => 'nullable|string|max:255',
            'sputum_color' => 'nullable|string|max:255',
            'lab_tests_sent' => 'nullable|string|max:255',

            'sistolik' => 'nullable|integer', 
            'diastolik' => 'nullable|integer', 
            'suhu' => 'nullable|numeric', 
            'nadi' => 'nullable|integer', 
            'rr_ttv' => 'nullable|integer', 
            'spo2' => 'nullable|integer', 
            'consciousness' => 'nullable|string', 

            'intubation_type' => 'nullable|string',
            'ett_diameter' => 'nullable|numeric',
            'ett_depth' => 'nullable|numeric',
            'tc_diameter' => 'nullable|numeric',
            'tc_type' => 'nullable|string',

            'venti_datetime' => 'nullable|date', 
            'mode_venti' => 'nullable|string|max:255', 
            'ipl' => 'nullable|numeric|min:0|max:100', 
            'peep' => 'nullable|numeric|min:0|max:20', 
            'fio2' => 'nullable|numeric|min:0|max:100', 
            'rr' => 'nullable|integer|min:0|max:60',
            'ps' => 'nullable|numeric',
            'trigger' => 'nullable|numeric',
            'venti_param' => 'nullable|string',
        ];
    }
}
