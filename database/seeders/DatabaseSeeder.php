<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Superadmin Pusat
        User::updateOrCreate(
            ['email' => 'yoyonglov@gmail.com'], // Pengecekan biar gak duplikat
            [
                'name'     => 'Superadmin GNRI',
                'password' => Hash::make('Bianalana12!'), // Ganti dengan password aman
                'role'     => 'superadmin', // Sesuaikan dengan kolom role/level milikmu
            ]
        );

        $this->call([
            KabupatenSeeder::class,
        ]);

        $this->call([
            AdminDpwSeeder::class,
        ]);
    }
}
