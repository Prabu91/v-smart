<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');  
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'password.required' => 'Password harus diisi.',
        ]);
    
        // Cek apakah pengguna terdaftar
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('dashboard');
        }
    
        return back()->withErrors([
            'email' => 'Email atau password tidak terdaftar.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

