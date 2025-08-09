<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExtubationRequest extends FormRequest
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

            'extubation_datetime' => 'required|date',
            'preparation_extubation_therapy' => 'nullable|string',
            'extubation' => 'nullable|string',
            'nebulizer' => 'nullable|string',
            'patient_status' => 'required|string',
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

    public function messages(): array
    {
        return [
            'user_id.required' => 'Kolom user wajib diisi.',
            'user_id.uuid' => 'ID user harus berupa format UUID yang valid.',
            'user_id.exists' => 'User tidak ditemukan di dalam database.',

            'patient_id.required' => 'Kolom pasien wajib diisi.',
            'patient_id.uuid' => 'ID pasien harus berupa format UUID yang valid.',
            'patient_id.exists' => 'Pasien tidak ditemukan di dalam database.',

            'extubation_datetime.required' => 'Kolom tanggal dan waktu ekstubasi wajib diisi.',
            'extubation_datetime.date' => 'Kolom tanggal dan waktu ekstubasi harus berupa format tanggal yang valid.',

            'preparation_extubation_therapy.required' => 'Kolom persiapan terapi ekstubasi wajib diisi.',
            'preparation_extubation_therapy.string' => 'Kolom persiapan terapi ekstubasi harus berupa teks yang valid.',

            'extubation.required' => 'Kolom ekstubasi wajib diisi.',
            'extubation.string' => 'Kolom ekstubasi harus berupa teks yang valid.',

            'nebulizer.required' => 'Kolom nebulizer wajib diisi.',
            'nebulizer.string' => 'Kolom nebulizer harus berupa teks yang valid.',

            'patient_status.required' => 'Kolom kondisi pasien wajib diisi.',
            'patient_status.string' => 'Kolom kondisi pasien harus berupa teks yang valid.',
        ];
    }

}
