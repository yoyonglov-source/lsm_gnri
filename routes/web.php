<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Member\ProfileController as MemberProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KtaVerificationController;

// 1. Halaman Depan / Welcome publik
Route::get('/', function () {
    return view('welcome');
});
Route::get('/cek-keanggotaan', [KtaVerificationController::class, 'search'])->name('cek-keanggotaan.search');
Route::get('/verify-kta/{no_kta}', [KtaVerificationController::class, 'verify'])->name('kta.verify');

// 2. RUTE KHUSUS USER UMUM / ANGGOTA BIASA (Sudah Login)
Route::middleware(['auth', 'verified', 'role:user,anggota'])->group(function () {
    
    // Dashboard Anggota Biasa
    Route::get('/dashboard', [MemberProfileController::class, 'index'])->name('dashboard');
    Route::post('/profile-anggota', [MemberProfileController::class, 'store'])->name('profile.anggota.store');
        
    // Rute bawaan Breeze untuk edit akun (profile password/email)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. File Auth Bawaan Breeze (Login, Register, dll)
require __DIR__.'/auth.php';

// 4. File Rute Khusus Admin
require __DIR__.'/admin.php';