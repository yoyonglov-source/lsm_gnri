<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Kabupaten; 

class AdminDpwSeeder extends Seeder
{
    public function run(): void
    {
        $dpwList = [
            ['name' => 'Admin DPW Pekanbaru', 'email' => 'pekanbaru@gnri-riau.online', 'kode_wilayah' => 'PKU'],
            ['name' => 'Admin DPW Dumai', 'email' => 'dumai@gnri-riau.online', 'kode_wilayah' => 'DMI'],
            ['name' => 'Admin DPW Kampar', 'email' => 'kampar@gnri-riau.online', 'kode_wilayah' => 'KMP'],
            ['name' => 'Admin DPW Indragiri Hulu', 'email' => 'inhu@gnri-riau.online', 'kode_wilayah' => 'INHU'],
            ['name' => 'Admin DPW Indragiri Hilir', 'email' => 'inhi@gnri-riau.online', 'kode_wilayah' => 'INHI'],
            ['name' => 'Admin DPW Pelalawan', 'email' => 'pelalawan@gnri-riau.online', 'kode_wilayah' => 'PLW'],
            ['name' => 'Admin DPW Siak', 'email' => 'siak@gnri-riau.online', 'kode_wilayah' => 'SIAK'],
            ['name' => 'Admin DPW Kuantan Singingi', 'email' => 'kuansing@gnri-riau.online', 'kode_wilayah' => 'KUANSING'],
            ['name' => 'Admin DPW Bengkalis', 'email' => 'bengkalis@gnri-riau.online', 'kode_wilayah' => 'BKL'],
            ['name' => 'Admin DPW Rokan Hulu', 'email' => 'rohul@gnri-riau.online', 'kode_wilayah' => 'ROHUL'],
            ['name' => 'Admin DPW Rokan Hilir', 'email' => 'rohil@gnri-riau.online', 'kode_wilayah' => 'ROHIL'],
            ['name' => 'Admin DPW Kepulauan Meranti', 'email' => 'meranti@gnri-riau.online', 'kode_wilayah' => 'MRT'],

        ];

        foreach ($dpwList as $dpw) {
            // 1. Cari ID kabupaten berdasarkan kode_wilayah dari Seeder Kabupaten
            $kabupaten = Kabupaten::where('kode_wilayah', $dpw['kode_wilayah'])->first();
            User::updateOrCreate(
                ['email' => $dpw['email']],
                [
                    'name'         => $dpw['name'],
                    'password'     => Hash::make('Gnri-Riau2026'), // Password default awal
                    'role'         => 'admin_dpw',
                    'kabupaten_id' => $kabupaten ? $kabupaten->id : null, // Memasukkan ID kabupaten yang sesuai
                ]
            );
        }
    }
}