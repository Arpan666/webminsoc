<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Kolom untuk menyimpan path bukti pembayaran
            $table->string('payment_proof_path')->nullable()->after('status');

            // Kolom opsional untuk metode pembayaran
            $table->string('payment_method')->nullable()->after('payment_proof_path');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('payment_proof_path');
            $table->dropColumn('payment_method');
        });
    }
};
