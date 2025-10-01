<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIntubationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $minDate = now()->subHours(5);
        $maxDate = now();

        return [
            'patient_id' => 'required|uuid|exists:patients,id',
            'intubation_location' => 'required|string',
            'intubation_datetime' => [
                'required',
                'date',
                'after_or_equal:' . $minDate,
                'before_or_equal:' . $maxDate,
            ],
            'dr_intubation_name' => 'nullable|string|max:255',
            'dr_consultant_name' => 'nullable|string|max:255',
            'preintubation' => 'nullable|string',
            'intubation_type' => 'nullable|string',
            'ett_diameter' => 'nullable|numeric',
            'ett_depth' => 'nullable|numeric',
            'tc_diameter' => 'nullable|numeric',
            'tc_type' => 'nullable|string',
            'postintubation' => 'nullable|string',

            'pre_sistolik' => 'nullable|numeric',
            'pre_diastolik' => 'nullable|numeric',
            'pre_suhu' => 'nullable|numeric',
            'pre_nadi' => 'nullable|numeric',
            'pre_rr_ttv' => 'nullable|numeric',
            'pre_spo2' => 'nullable|numeric',
            'pre_consciousness' => 'nullable|string',

            'post_sistolik' => 'nullable|numeric',
            'post_diastolik' => 'nullable|numeric',
            'post_suhu' => 'nullable|numeric',
            'post_nadi' => 'nullable|numeric',
            'post_rr_ttv' => 'nullable|numeric',
            'post_spo2' => 'nullable|numeric',
            'post_consciousness' => 'nullable|string',

            'venti_datetime' => [
                'required',
                'date',
                'after_or_equal:intubation_datetime',
                'before_or_equal:' . $maxDate,
            ],
            'mode_venti' => 'nullable|string|max:255',
            'ipl' => 'nullable|numeric',
            'peep' => 'nullable|numeric',
            'fio2' => 'nullable|numeric',
            'rr' => 'nullable|numeric',
            'ps' => 'nullable|numeric',
            'trigger' => 'nullable|numeric',
            'venti_param' => 'nullable|string',
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
            'intubation_datetime.before_or_equal' => 'Tanggal dan waktu intubasi tidak boleh lebih dari waktu saat ini.',
            'venti_datetime.after_or_equal' => 'Waktu pemasangan ventilator tidak boleh lebih awal dari waktu intubasi.',
            'venti_datetime.before_or_equal' => 'Waktu pemasangan ventilator tidak boleh lebih dari waktu saat ini.',
        ];
    }
}
