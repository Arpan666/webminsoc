<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'payment_method')) {
                $table->string('payment_method')->nullable();
            }

            if (!Schema::hasColumn('bookings', 'total_price')) {
                $table->integer('total_price')->default(0);
            }

            if (!Schema::hasColumn('bookings', 'status')) {
                $table->string('status')->default('pending_verification');
            }

            if (!Schema::hasColumn('bookings', 'payment_proof_path')) {
                $table->string('payment_proof_path')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'total_price',
                'status',
                'payment_proof_path',
            ]);
        });
    }
};
