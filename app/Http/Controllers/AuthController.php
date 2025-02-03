<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard'); 
        }

        return view('auth.login');
    }

    /**
     * Handle the login process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function login(Request $request)
    {
        $email = strtolower($request->input('email'));
        $ip = $request->ip();
        $throttleKey = "login:$email|$ip";
    
        if (RateLimiter::tooManyAttempts($throttleKey, 1)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Terlalu banyak percobaan login. Coba lagi dalam $seconds detik."
            ])->onlyInput('email');
        }
    
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required'
        ], [
            'email.required' => 'Email harus diisi.',   
            'email.email' => 'Email tidak valid.',
            'password.required' => 'Password harus diisi.',
            'g-recaptcha-response.required' => 'Silakan verifikasi bahwa Anda bukan robot.'
        ]);
    
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
        ]);
    
        $result = $response->json();
    
        if (!$result['success']) {
            return back()->withErrors([
                'g-recaptcha-response' => 'Verifikasi reCAPTCHA gagal, silakan coba lagi.'
            ])->onlyInput('email');
        }
    
        if (!Auth::attempt($request->only('email', 'password'))) {
            RateLimiter::hit($throttleKey, 180);
            return back()->withErrors([
                'email' => 'Email atau password salah.'
            ])->onlyInput('email');
        }
    
        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();
        return redirect()->intended('dashboard')->with('success', 'Login berhasil.');
    }

    /**
     * Handle the logout process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate and regenerate session after logout
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }
}
