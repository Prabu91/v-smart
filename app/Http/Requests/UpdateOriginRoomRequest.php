<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOriginRoomRequest extends FormRequest
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
            'origin_room_name' => 'required|string|max:255',
            'physical_check' => 'nullable|string|max:255',
            'radiology' => 'nullable|string',
            'additional_check' => 'nullable|string',
            'main_diagnose_origin' => 'nullable|string',
            'secondary_diagnose_origin' => 'nullable|string',
            'na_origin' => 'nullable|numeric',
            'kal_origin' => 'nullable|numeric',
            'gds_origin' => 'nullable|numeric',
            'ews' => 'nullable|numeric',
            
            'hb_origin' => 'nullable|numeric',
            'leukosit_origin' => 'nullable|numeric',
            'pcv_origin' => 'nullable|numeric',
            'trombosit_origin' => 'nullable|numeric',
            'kreatinin_origin' => 'nullable|numeric',
            
            'ph_origin' => 'nullable|numeric',
            'pco2_origin' => 'nullable|numeric',
            'po2_origin' => 'nullable|numeric',
            'spo2_origin' => 'nullable|numeric',
            'be_origin' => 'nullable|numeric',
            'sbpt' => 'nullable|numeric',
            'pf_ratio' => 'nullable|numeric',
            'hco3' => 'nullable|numeric',
            'tco2' => 'nullable|numeric',
        ];
    }
}
