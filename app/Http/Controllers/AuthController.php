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
        $username = strtolower($request->input('username'));
        $ip = $request->ip();
        $throttleKey = "login:$username|$ip";
    
        if (RateLimiter::tooManyAttempts($throttleKey, 1)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'username' => "Terlalu banyak percobaan login. Coba lagi dalam $seconds detik."
            ])->onlyInput('username');
        }
    
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required'
        ], [
            'username.required' => 'Username harus diisi.',   
            'username.username' => 'Username tidak valid.',
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
            ])->onlyInput('username');
        }
    
        if (!Auth::attempt($request->only('username', 'password'))) {
            RateLimiter::hit($throttleKey, 180);
            return back()->withErrors([
                'username' => 'Username atau password salah.'
            ])->onlyInput('username');
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
