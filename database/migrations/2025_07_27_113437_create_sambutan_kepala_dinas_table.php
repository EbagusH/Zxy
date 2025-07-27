<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sambutan_kepala_dinas', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nama_kepala_dinas');
            $table->string('jabatan');
            $table->text('isi_sambutan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sambutan_kepala_dinas');
    }
};
