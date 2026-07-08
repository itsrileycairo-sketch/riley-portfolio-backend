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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('role'); // Posisi (Contoh: S1 Teknik Komputer)
            $table->string('company'); // Tempat (Contoh: UTDI)
            $table->string('date'); // Waktu (Contoh: 2024 - Sekarang)
            $table->string('type'); // Tipe (Contoh: Education atau Professional)
            $table->json('description'); // Penjelasan (Kita pakai JSON karena bentuknya list/poin-poin)
            $table->json('tech')->nullable(); // Teknologi yang dipakai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
