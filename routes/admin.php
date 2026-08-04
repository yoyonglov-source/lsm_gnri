<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\KabupatenController;
use App\Http\Controllers\Admin\BeritaController;

// Lindungi SEMUA route admin dengan Auth dan Role Admin/Superadmin/Admin DPW
Route::middleware(['auth', 'role:admin,superadmin,admin_dpw,admin_dpd'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Verifikasi Anggota
    Route::get('/verifikasi', [DashboardController::class, 'verifikasiList'])->name('verifikasi.index');
    Route::post('/verifikasi/{id}/{status}', [DashboardController::class, 'verifikasiProses'])->name('verifikasi.proses');

    // Manajemen Anggota (CRUD)
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/{id}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
    Route::get('/kta/cetak/{id}', [AnggotaController::class, 'cetakKta'])->name('kta.cetak');
    Route::patch('/anggota/{id}/toggle-status', [AnggotaController::class, 'toggleStatus'])->name('anggota.toggle-status');

    // Manajemen Kabupaten / Sekretariat
    Route::get('/kabupaten', [KabupatenController::class, 'index'])->name('kabupaten.index');
    Route::put('/kabupaten/{kabupaten}', [KabupatenController::class, 'update'])->name('kabupaten.update');

    Route::resource('berita', BeritaController::class)->parameters([
    'berita' => 'berita'
]);

});