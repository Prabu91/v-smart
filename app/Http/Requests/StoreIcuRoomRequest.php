<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIcuRoomRequest extends FormRequest
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
            'user_id' => 'required|uuid|exists:users,id',
            'patient_id' => 'required|uuid|exists:patients,id',

            'icu_room_datetime' => 'required|date',
            'icu_room_name' => 'required|string|max:255',
            'icu_room_bednum' => 'required|numeric',
            'ro' => 'nullable|string',
            'ro_post_incubation' => 'nullable|string',
            'blood_culture' => 'nullable|string',
            
            'hb_icu' => 'nullable|numeric',
            'leukosit_icu' => 'nullable|numeric',
            'pcv_icu' => 'nullable|numeric',
            'trombosit_icu' => 'nullable|numeric',
            'kreatinin_icu' => 'nullable|numeric',
            'albumin' => 'nullable|numeric',
            'laktat' => 'nullable|numeric',
            'sbut' => 'nullable|numeric',
            'ureum' => 'nullable|numeric',
            
            'ph_icu' => 'nullable|numeric',
            'pco2_icu' => 'nullable|numeric',
            'po2_icu' => 'nullable|numeric',
            'spo2_icu' => 'nullable|numeric',
            'be_icu' => 'nullable|numeric',
            'sbpt' => 'nullable|numeric',
            
            'venti_datetime' => 'required|date',
            'mode_venti' => 'nullable|string',
            'ipl' => 'nullable|numeric',
            'peep' => 'nullable|numeric',
            'fio2' => 'nullable|numeric',
            'rr' => 'nullable|numeric',

            'sistolik' => 'nullable|numeric',
            'diastolik' => 'nullable|numeric',
            'suhu' => 'nullable|numeric',
            'nadi' => 'nullable|numeric',
            'rr_ttv' => 'nullable|numeric',
            'spo2' => 'nullable|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'icu_room_datetime.required' => 'Tanggal dan Waktu wajib diisi.',
            'icu_room_name.required' => 'Nama Ruangan wajib diisi.',
            'icu_room_bednum.required' => 'Nomor Bed wajib diisi.',
            
            
        ];
    }
}
