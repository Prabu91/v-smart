<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user() && Auth::user()->role === 'super admin';
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
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8',
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
            
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username ini sudah terdaftar.',
            
            'password.required' => 'Kata sandi wajib diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',
            'password.min' => 'Kata sandi harus minimal 8 karakter.',
            
            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role yang dipilih tidak valid.',
            
            'hospital.required' => 'Rumah Sakit wajib diisi.',
            'hospital.string' => 'Rumah Sakit harus berupa teks.',

            'venti.required' => 'Jumlah Venti wajib diisi.',
            'venti.min' => 'Harus di isi 0 atau lebih.',

            'bed.required' => 'Jumlah Bed wajib diisi.',
            'bed.min' => 'Harus di isi 0 atau lebih.',
        ];
    }
}
