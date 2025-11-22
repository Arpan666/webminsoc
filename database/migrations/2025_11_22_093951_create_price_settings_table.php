<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_settings', function (Blueprint $table) {
            $table->id();

            // Relasi ke lapangan
            $table->foreignId('field_id')
                ->constrained()
                ->cascadeOnDelete();

            // weekday / weekend
            $table->enum('day_type', ['weekday', 'weekend']);

            // Jam operasional yang berlaku untuk harga ini
            $table->time('start_time');
            $table->time('end_time');

            // Harga
            $table->decimal('price_per_hour', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_settings');
    }
};
