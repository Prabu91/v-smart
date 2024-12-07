<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIntubationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|uuid|exists:users,id',
            'patient_id' => 'required|uuid|exists:patients,id',

            'intubation_location' => 'required|string',
            'intubation_datetime' => 'nullable|date',
            'dr_intubation_name' => 'nullable|string|max:255',
            'dr_consultant_name' => 'nullable|string|max:255',
            'preintubation' => 'nullable|string|max:255',
            'therapy_type_origin' => 'nullable|string|max:255',
            'diameter_origin' => 'nullable|numeric',
            'depth_origin' => 'nullable|numeric',
            'postintubation' => 'nullable|string|max:255',
            
            'sistolik' => 'nullable|numeric',
            'diastolik' => 'nullable|numeric',
            'suhu' => 'nullable|numeric',
            'nadi' => 'nullable|numeric',
            'rr_ttv' => 'nullable|numeric',
            'spo2' => 'nullable|numeric',
            
            'mode_venti' => 'nullable|string|max:255',
            'ipl' => 'nullable|numeric',
            'peep' => 'nullable|numeric',
            'fio2' => 'nullable|numeric',
            'rr' => 'nullable|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'origin_room_name.required' => 'Nama ruangan asal wajib diisi.',
            'origin_room_name.string' => 'Nama ruangan asal harus berupa teks.',
            'origin_room_name.max' => 'Nama ruangan asal tidak boleh lebih dari 255 karakter.',
        ];
    }
}
