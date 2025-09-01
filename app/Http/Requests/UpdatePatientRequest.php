<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePatientRequest extends FormRequest
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
        // Mendapatkan ID pasien dari route
        $patientId = $this->route('patient')->id;
        
        return [
            'name' => 'required|string|max:255',
            'no_jkn' => [
                'required',
                'string',
                'size:13',
                Rule::unique('patients')->ignore($patientId),
            ],
            'no_rm' => [
                'required',
                'string',
                Rule::unique('patients')->ignore($patientId),
            ],
            'tanggal_lahir' => 'required|date',
            'no_sep' => 'nullable|string',
            'gender' => 'required|string',
            'user_id' => 'required|uuid|exists:users,id',
        ];
    }
}
