<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use Illuminate\Database\Seeder;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kabupatens = [
            ['nama_kabupaten' => 'Kota Pekanbaru', 'kode_wilayah' => 'PKU'],
            ['nama_kabupaten' => 'Kota Dumai', 'kode_wilayah' => 'DMI'],
            ['nama_kabupaten' => 'Kabupaten Kampar', 'kode_wilayah' => 'KMP'],
            ['nama_kabupaten' => 'Kabupaten Indragiri Hulu', 'kode_wilayah' => 'INHU'],
            ['nama_kabupaten' => 'Kabupaten Indragiri Hilir', 'kode_wilayah' => 'INHI'],
            ['nama_kabupaten' => 'Kabupaten Pelalawan', 'kode_wilayah' => 'PLW'],
            ['nama_kabupaten' => 'Kabupaten Siak', 'kode_wilayah' => 'SIAK'],
            ['nama_kabupaten' => 'Kabupaten Kuantan Singingi', 'kode_wilayah' => 'KUANSING'],
            ['nama_kabupaten' => 'Kabupaten Bengkalis', 'kode_wilayah' => 'BKL'],
            ['nama_kabupaten' => 'Kabupaten Rokan Hulu', 'kode_wilayah' => 'ROHUL'],
            ['nama_kabupaten' => 'Kabupaten Rokan Hilir', 'kode_wilayah' => 'ROHIL'],
            ['nama_kabupaten' => 'Kabupaten Kepulauan Meranti', 'kode_wilayah' => 'MRT'],
        ];

        foreach ($kabupatens as $kab) {
            Kabupaten::updateOrCreate(['nama_kabupaten' => $kab['nama_kabupaten']], $kab);
        }
    }
}