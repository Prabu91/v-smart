<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePatientRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'no_jkn' => 'required|string|size:13|unique:patients',
            'no_rm' => 'required|string|unique:patients',
            'user_id' => 'required|uuid|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            
            'no_jkn.required' => 'Nomor JKN wajib diisi.',
            'no_jkn.string' => 'Nomor JKN harus berupa teks.',
            'no_jkn.size' => 'Nomor JKN harus 13 Digit.',
            'no_jkn.unique' => 'Nomor JKN sudah ada.',
            
            'no_rm.required' => 'Nomor Rekam Medis wajib diisi.',
            'no_rm.string' => 'Nomor Rekam Medis harus berupa teks.',
            'no_rm.unique' => 'Nomor Rekam Medis sudah ada.',
        ];
    }
}
