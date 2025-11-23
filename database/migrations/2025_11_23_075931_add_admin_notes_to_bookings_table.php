<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Tambahkan kolom untuk catatan admin, bisa diisi NULL jika tidak ada catatan
            $table->text('admin_notes')->nullable()->after('status'); 
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('admin_notes');
        });
    }
};