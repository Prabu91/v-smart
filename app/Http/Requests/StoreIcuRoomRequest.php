<?php

namespace App\Http\Requests;

use Carbon\Carbon;
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
        // return [
        //     'venti_datetime' => ['nullable', function ($attribute, $value, $fail) {
        //         $now = now();
        //         $selectedTime = Carbon::parse($value);
        //         $earliestAllowedTime = $now->copy()->subHours(1);

        //         if ($selectedTime->lessThan($earliestAllowedTime) || $selectedTime->greaterThan($now)) {
        //             $fail('Waktu pemakaian hanya bisa diinput dalam rentang 1 jam terakhir.');
        //         }
        //     }],
        // ];

        return [
            'patient_id' => 'required|uuid|exists:patients,id',

            'icu_room_datetime' => [
                    'required',
                    'date',
                    'after_or_equal:today',
                    'before_or_equal:' . now()->addDay()->endOfDay()->toDateString(),
                ],
            'icu_room_name' => 'required', 
            'icu_room_bednum' => 'required|integer|min:1', 

            'natrium' => 'nullable|numeric|between:120,160', 
            'kalium' => 'nullable|numeric|between:3.0,5.0', 
            'calsium' => 'nullable|numeric|between:7.5,12.0', 
            'magnesium' => 'nullable|numeric|between:1.5,2.5', 
            'clorida' => 'nullable|numeric|between:90,115', 

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

            'ro' => 'nullable|in:sudah,belum',
            'blood_culture' => 'nullable|string|max:255',
            'ro_post_intubation' => 'nullable|string|max:255',

            'sistolik' => 'required|integer|min:0|max:300', 
            'diastolik' => 'required|integer|min:0|max:200', 
            'suhu' => 'required|numeric|min:30|max:45', 
            'nadi' => 'required|integer|min:30|max:200', 
            'rr_ttv' => 'required|integer|min:0|max:60', 
            'spo2' => 'required|integer|min:0|max:100', 

            'venti_datetime' => 'nullable|date', 
            'mode_venti' => 'nullable|string|max:255', 
            'ipl' => 'nullable|numeric|min:0|max:100', 
            'peep' => 'nullable|numeric|min:0|max:20', 
            'fio2' => 'nullable|numeric|min:0|max:100', 
            'rr' => 'nullable|integer|min:0|max:60',
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
