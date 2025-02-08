<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\LogHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Support\Str;

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
        $userId = User::where('username', $request->username)->first();
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 2)) {
            $seconds = RateLimiter::availableIn($this->throttleKey($request));

            return back()->withErrors([
                'username' => "Terlalu banyak percobaan login. Silakan coba lagi dalam $seconds detik."
            ])->withInput();
        }

        $credentials = $request->only('username', 'password');
        $user = User::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            RateLimiter::clear($this->throttleKey($request));
            LogHelper::log('Login', "User {$request->name} (ID: {$userId->id} Role: {$userId->role}) berhasil login.");
            return redirect()->intended('/dashboard')->with('success', 'Login Berhasil!');
        }

        RateLimiter::hit($this->throttleKey($request), 180); 

        return back()->withErrors([
            'username' => 'username atau password salah!'
        ])->withInput();
    }

    private function throttleKey(Request $request)
    {
        return Str::lower($request->input('username')) . '|' . $request->ip();
    }

    /**
     * Handle the logout process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Ambil data user sebelum logout
        $user = Auth::user();

        if ($user) {
            LogHelper::log('Logout', "User {$user->name} (ID: {$user->id} Role: {$user->role}) berhasil logout.");
        }

        Auth::logout();

        // Invalidate and regenerate session after logout
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }
}
