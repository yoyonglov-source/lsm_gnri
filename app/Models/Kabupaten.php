<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    // Tambahkan properti ini agar kolom nama_kabupaten & kode_wilayah bisa diisi dengan aman
    protected $fillable = [
        'nama_kabupaten',
        'kode_wilayah',
        'email_sekretariat',
        'alamat_sekretariat',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'kabupaten_id');
    }
}