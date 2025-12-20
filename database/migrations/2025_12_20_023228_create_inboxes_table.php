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
    Schema::create('inboxes', function (Blueprint $table) {
        $table->id();
        $table->string('name');    // Nama Client
        $table->string('email');   // Email Client
        $table->text('message');   // Isi Pesan
        $table->timestamps();      // Waktu Kirim
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inboxes');
    }
};
