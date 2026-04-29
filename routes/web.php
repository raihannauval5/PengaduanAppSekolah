<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

// Halaman Login
Route::get('/', function () { return view('login'); })->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Group Route untuk yang sudah Login (Auth)
Route::middleware(['auth'])->group(function () {

    // ROUTE KHUSUS SISWA
    // Pakai SiswaController@index biar data riwayat muncul
    Route::get('/siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
    
    // Simpan Pengaduan (Wajib pakai Nama untuk Blade)
    Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan.store');

    // ROUTE KHUSUS ADMIN
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Update Status & Tanggapan dari Admin
    Route::post('/admin/pengaduan/update/{id}', [AdminController::class, 'updateStatus'])->name('admin.pengaduan.update');

});