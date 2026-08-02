<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = [
        'user_id', 'kabupaten_id', 'nik', 'no_hp', 'alamat', 
        'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir','jabatan', 
        'pas_foto', 'status_verifikasi', 'alasan_penolakan', 
        'diverifikasi_oleh', 'tanggal_verifikasi', 'no_kta','is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean', // <-- Tambahkan ini agar 1/0 otomatis di-cast ke true/false
    ];

    // Relasi balik ke Akun User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Kabupaten (DPD)
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    // Relasi ke Admin yang memverifikasi
    public function verifikator()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }

}