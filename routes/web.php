<?php

use App\Http\Controllers\ActivityLogController;
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
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

});

Route::middleware(['auth', CheckIntubationStatus::class])->group(function () {
    Route::get('/logs', [ActivityLogController::class, 'index'])->name('logs.index')->middleware('auth');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::middleware(['role'])->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('users', UserController::class);
        });
    });

    Route::middleware(['check.venti'])->group(function () {
        Route::resources([
            'patients' => PatientController::class,
        ]);
    });

    Route::get('hospital/{id}', [DashboardController::class, 'showDetails'])->name('hospital.details');

    Route::resources([
        'patients' => PatientController::class,
        'origin-rooms' => OriginRoomController::class,
        'icu-rooms' => IcuRoomController::class,
        'ventilators' => VentilatorController::class,
        'intubations' => IntubationController::class,
        'extubations' => ExtubationController::class,
        'transfer-rooms' => TransferRoomController::class,
    ]);

    Route::post('/ventilators/{id}/release', [VentilatorController::class, 'release'])->name('ventilators.release');

    Route::get('/patients/{patient}/export-pdf', [PatientController::class, 'exportPdf'])->name('patients.export-pdf');
    Route::get('/hospital/{id}/download', [DashboardController::class, 'downloadDetails'])->name('hospital.download');

});

