<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\OriginRoomController;
use App\Http\Controllers\IcuRoomController;
use App\Http\Controllers\VentilatorController;
use App\Http\Controllers\IntubationController;
use App\Http\Controllers\ExtubationController;
use App\Http\Controllers\TransferRoomController;
use App\Http\Middleware\CheckIntubationStatus;

Route::middleware('guest')->group(function () {
    // Route untuk tampilan login (akses hanya untuk yang belum login)
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

Route::middleware(['auth', CheckIntubationStatus::class])->group(function () {
    // Route logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard untuk user
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin routes (akses hanya untuk admin)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
    });

    // Route untuk melihat detail rumah sakit
    Route::get('hospital/{id}', [DashboardController::class, 'showDetails'])->name('hospital.details');

    // Routes untuk resource lainnya
    Route::resources([
        'patients' => PatientController::class,
        'origin-rooms' => OriginRoomController::class,
        'icu-rooms' => IcuRoomController::class,
        'ventilators' => VentilatorController::class,
        'intubations' => IntubationController::class,
        'extubations' => ExtubationController::class,
        'transfer-rooms' => TransferRoomController::class,
    ]);

    // Route khusus untuk release ventilator
    Route::post('/ventilators/{id}/release', [VentilatorController::class, 'release'])->name('ventilators.release');

    // Export PDF untuk pasien
    Route::get('/patients/{patient}/export-pdf', [PatientController::class, 'exportPdf'])->name('patients.export-pdf');
});

