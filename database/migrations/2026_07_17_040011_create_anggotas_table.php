<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke User (Akun Login) dan Kabupaten (Wilayah DPD)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('kabupaten_id')->nullable()->constrained()->onDelete('restrict');
            
            // Biodata Fisik Anggota (Dibuat nullable agar register awal tidak error)
            $table->string('nik')->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->text('alamat')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            
            // Berkas Pendukung
            $table->string('pas_foto')->nullable(); // Menyimpan path file gambar
            
            // Sistem Validasi Berkas LSM
            $table->enum('status_verifikasi', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->text('alasan_penolakan')->nullable(); // Catatan jika berkas tidak valid
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('tanggal_verifikasi')->nullable();
            
            // Kolom nomor KTA (Akan terisi otomatis di Poin 2 setelah disetujui)
            $table->string('no_kta')->nullable()->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};