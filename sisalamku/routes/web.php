<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\UserController;

// --- RUTE LOGIN ---
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);

// --- RUTE YANG WAJIB LOGIN ---
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- ALUR UTAMA PENGAJUAN (SISALAMKU) ---
    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('/pengajuan/{id}', [PengajuanController::class, 'show'])->name('pengajuan.show');

    Route::get('/buat-pengajuan', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/buat-pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');

    // --- PROSES PERSETUJUAN MULTI-ROLE ---
    Route::post('/pengajuan/{id}/verifikasi', [PengajuanController::class, 'verifikasi'])->name('pengajuan.verifikasi');
    Route::post('/pengajuan/{id}/approval-ppk', [PengajuanController::class, 'ppkApproval'])->name('pengajuan.ppkApproval');
    Route::post('/pengajuan/{id}/realisasi', [PengajuanController::class, 'realisasi'])->name('pengajuan.realisasi');

    // --- FITUR KETERSEDIAAN ANGGARAN ---
    Route::get('/anggaran', [AnggaranController::class, 'index'])->name('anggaran.index');
    Route::post('/anggaran/upload', [AnggaranController::class, 'upload'])->name('anggaran.upload');

    // --- FITUR EKSPOR EXCEL & CETAK ---
    Route::get('/pengajuan-excel', [PengajuanController::class, 'exportExcel'])->name('pengajuan.excel');
    Route::get('/pengajuan/{id}/cetak', [PengajuanController::class, 'cetak'])->name('pengajuan.cetak');

    // --- KELOLA USER (ADMIN KEUANGAN) ---
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/notifications/{id}/read', [DashboardController::class, 'markNotificationAsRead'])->name('notifications.read');
});