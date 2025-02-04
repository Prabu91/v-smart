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
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => 'required|uuid|exists:patients,id',

            'intubation_location' => 'required|string',
            'intubation_datetime' => 'required|date',
            'dr_intubation_name' => 'nullable|string|max:255',
            'dr_consultant_name' => 'nullable|string|max:255',
            'preintubation' => 'nullable|string|max:255',
            'diameter' => 'nullable|numeric',
            'depth' => 'nullable|numeric',
            'postintubation' => 'nullable|string|max:255',

            'pre_sistolik' => 'nullable|numeric',
            'pre_diastolik' => 'nullable|numeric',
            'pre_suhu' => 'nullable|numeric',
            'pre_nadi' => 'nullable|numeric',
            'pre_rr_ttv' => 'nullable|numeric',
            'pre_spo2' => 'nullable|numeric',

            'post_sistolik' => 'nullable|numeric',
            'post_diastolik' => 'nullable|numeric',
            'post_suhu' => 'nullable|numeric',
            'post_nadi' => 'nullable|numeric',
            'post_rr_ttv' => 'nullable|numeric',
            'post_spo2' => 'nullable|numeric',
            
            'venti_datetime' => 'required|date|after_or_equal:intubation_datetime',
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
            'venti_datetime.after_or_equal' => 'Waktu pemasangan ventilator tidak boleh lebih awal dari waktu intubasi.',
            'origin_room_name.required' => 'Nama ruangan asal wajib diisi.',
            'origin_room_name.string' => 'Nama ruangan asal harus berupa teks.',
            'origin_room_name.max' => 'Nama ruangan asal tidak boleh lebih dari 255 karakter.',
        ];
    }
}
