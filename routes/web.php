<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ObservationController;
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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    
    Route::prefix('admin')->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });
    
    Route::get('observation', [ObservationController::class, 'index'])->name('observasi.index');
    Route::post('/observation', [ObservationController::class, 'store'])->name('observation.store');
    
});
    