<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExtubationRequest extends FormRequest
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

            'extubation_datetime' => 'nullable|date',
            'preparation_extubation_therapy' => 'nullable|string',
            'extubation' => 'nullable|string',
            'nebulizer' => 'nullable|string',
            'patient_status' => 'required|string', // Status pasien tetap wajib
            'extubation_notes' => 'nullable|string',

            'sistolik' => 'nullable|numeric',
            'diastolik' => 'nullable|numeric',
            'suhu' => 'nullable|numeric',
            'nadi' => 'nullable|numeric',
            'rr_ttv' => 'nullable|numeric',
            'spo2' => 'nullable|numeric',
            'consciousness' => 'nullable|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'patient_id.required' => 'Kolom pasien wajib diisi.',
            'patient_id.uuid' => 'ID pasien harus berupa format UUID yang valid.',
            'patient_id.exists' => 'Pasien tidak ditemukan di dalam database.',
            'patient_status.required' => 'Kolom kondisi pasien wajib diisi.',
        ];
    }
}
