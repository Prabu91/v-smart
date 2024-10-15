<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Route untuk tampilan login
Route::get('/', [AuthController::class, 'showLoginForm'])
->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])
->name('login');

// Route untuk memproses login
Route::post('login', [AuthController::class, 'login']);


Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    // Route untuk menambah pengguna
    Route::get('admin/users/create', [UserController::class, 'create'])
        ->name('admin.users.create');

    Route::post('admin/users', [UserController::class, 'store'])
        ->name('admin.users.store');

    
});
    