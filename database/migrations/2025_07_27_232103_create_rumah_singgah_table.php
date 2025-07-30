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
        Schema::create('rumah_singgah', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable();
            $table->text('isi')->nullable();
            $table->text('lokasi')->nullable();

            // Gallery images (JSON array of image paths)
            $table->json('galeri')->nullable();

            // Facilities (JSON array)
            $table->json('fasilitas')->nullable();

            // Guest criteria (JSON array)
            $table->json('kriteria_tamu')->nullable();

            // Video
            $table->string('video')->nullable();

            // Service flow diagram
            $table->string('alur_pelayanan')->nullable();

            // Contact information
            $table->string('alamat_lengkap')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();

            // Operating hours
            $table->json('jam_operasional')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumah_singgah');
    }
};
