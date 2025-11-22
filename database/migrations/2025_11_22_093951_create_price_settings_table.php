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
            $table->foreignId('field_id')->constrained()->cascadeOnDelete();
            $table->enum('day_type', ['weekday', 'weekend']); // Siang/Malam diwakili waktu
            $table->time('start_time'); // Contoh: 08:00:00
            $table->time('end_time');   // Contoh: 17:00:00
            $table->decimal('price_per_hour', 10, 2);
            $table->timestamps();
        });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_settings');
    }
};
