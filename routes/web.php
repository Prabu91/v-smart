<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtubationController;
use App\Http\Controllers\OriginRoomController;
use App\Http\Controllers\IcuRoomController;
use App\Http\Controllers\IntubationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TransferRoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentilatorController;

/// Route untuk tampilan login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm']);

// Route untuk memproses login
Route::post('login', [AuthController::class, 'login'])->name('login.process');

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard untuk user
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });
    Route::get('hospital/{id}', [DashboardController::class, 'showDetails'])->name('hospital.details');

    // Other resource routes
    Route::resources([
        'patients' => PatientController::class,
        'origin-rooms' => OriginRoomController::class,
        'icu-rooms' => IcuRoomController::class,
        'ventilators' => VentilatorController::class,
        'intubations' => IntubationController::class,
        'extubations' => ExtubationController::class,
        'transfer-rooms' => TransferRoomController::class,
    ]);
});
