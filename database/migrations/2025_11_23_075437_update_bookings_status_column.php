<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Ubah tipe kolom menjadi VARCHAR
            // Jika sebelumnya ENUM, ini akan mengubahnya menjadi string umum
            // $table->string('status', 30)->change();
            
            // Atau, jika Anda ingin tetap ENUM:
            $table->enum('status', ['pending_verification', 'waiting_confirmation', 'confirmed', 'rejected', 'cancelled'])->default('pending_verification')->change();
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Kembalikan ke tipe data asli Anda (misalnya: ENUM lama)
            // Ini mungkin sulit jika Anda tidak tahu nilai ENUM aslinya.
            // Biarkan saja VARCHAR(30) jika Anda memilih opsi itu di atas.
        });
    }
};