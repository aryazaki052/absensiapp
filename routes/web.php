<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\presensiController;
use Illuminate\Support\Facades\Route;

// Hanya bisa diakses oleh yang BELUM login
Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/prosesLogin', [AuthController::class, 'prosesLogin']);
});

// Hanya bisa diakses oleh yang SUDAH login
Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/prosesLogout', [AuthController::class, 'prosesLogout']);

    // presensi
    Route::get('/presensi/create', [presensiController::class, 'create']);    
    Route::post('/presensi/store', [presensiController::class, 'store']);    
    
});
