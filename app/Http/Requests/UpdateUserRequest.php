<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user() && Auth::user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user'); 

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId, 
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,user',
            'hospital' => 'required|string|max:255',
            'venti' => 'required|numeric|min:0',
            'bed' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',

            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role yang dipilih tidak valid.',

            'hospital.required' => 'Rumah Sakit wajib diisi.',
            'hospital.string' => 'Rumah Sakit harus berupa teks.',

            'venti.required' => 'Jumlah Venti wajib diisi.',
            'venti.numeric' => 'Jumlah Venti harus berupa angka.',
            'venti.min' => 'Jumlah Venti harus 0 atau lebih.',

            'bed.required' => 'Jumlah Bed wajib diisi.',
            'bed.numeric' => 'Jumlah Bed harus berupa angka.',
            'bed.min' => 'Jumlah Bed harus 0 atau lebih.',
        ];
    }
}
