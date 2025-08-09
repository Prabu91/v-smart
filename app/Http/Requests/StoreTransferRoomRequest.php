<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransferRoomRequest extends FormRequest
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
            'transfer_room_datetime' => 'required|date',
            'transfer_room_name' => 'nullable|string|max:255',
            'lab_culture_data' => 'required',
            'main_diagnose_origin' => 'nullable|string',
            'secondary_diagnose_origin' => 'nullable|string',
            'notes' => 'nullable|string',

            'hb_transfer' => 'nullable|numeric',
            'leukosit_transfer' => 'nullable|numeric',
            'pcv_transfer' => 'nullable|numeric',
            'trombosit_transfer' => 'nullable|numeric',
            
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
            'transfer_room_datetime.required' => 'Lokasi intubasi harus diisi.',
            'lab_culture_data' => 'Field harus diisi.',
            'transfer_room_name.string' => 'Nama dokter intubasi harus berupa teks.',
            'transfer_room_name.max' => 'Nama dokter intubasi tidak boleh lebih dari 255 karakter.',
            
            'hb_icu.numeric' => 'HB harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'leukosit_icu.numeric' => 'Leukosit harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'pcv_icu.numeric' => 'PCV harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'trombosit_icu.numeric' => 'Trombosit harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            
            'sistolik.numeric' => 'Sistolik harus berupa angka.',
            'diastolik.numeric' => 'Diastolik harus berupa angka.',
            'suhu.numeric' => 'Suhu harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'nadi.numeric' => 'Nadi harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'rr_ttv.numeric' => 'RR TTV harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
            'spo2.numeric' => 'SPO2 harus berupa angka dan gunakan titik (.) sebagai pemisah desimal.',
        ];
    }
}
