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
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom relasi dengan aman setelah tabel kabupatens dipastikan ada
            $table->foreignId('kabupaten_id')
                  ->nullable()
                  ->after('role') // Meletakkan posisi kolom tepat di bawah kolom role
                  ->constrained('kabupatens')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key dan kolom jika migration di-rollback
            $table->dropForeign(['kabupaten_id']);
            $table->dropColumn('kabupaten_id');
        });
    }
};