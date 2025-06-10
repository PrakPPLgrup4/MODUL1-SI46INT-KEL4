<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('appointment', function (Blueprint $table) {
            $table->ulid('id')->unique(); // ID unik untuk janji temu
            $table->ulid('user_id'); // Referensi ke pengguna yang membuat janji temu
            $table->ulid('specialist_id'); // Referensi ke psikiater
            $table->string('category'); // Kategori konseling
            $table->timestamp('appointment_time')->nullable(); // Waktu janji temu yang dipilih oleh pengguna
            $table->string('payment_proof')->nullable(); // Path ke file bukti pembayaran yang diupload
            $table->string('status')->default('requested'); // Status janji temu (misalnya, requested, confirmed)
            $table->boolean('completed')->default(false); // Menandakan apakah sesi telah selesai
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Membalikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};