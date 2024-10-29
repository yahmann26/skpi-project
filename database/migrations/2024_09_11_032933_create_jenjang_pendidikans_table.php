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
        Schema::create('jenjang_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_en')->nullable();
            $table->string('singkatan')->nullable();
            $table->string('jenis_pendidikan')->nullable();
            $table->string('jenis_pendidikan_en')->nullable();
            $table->string('kualifikasi_kkni');
            $table->string('lama_studi_reguler')->nullable();
            $table->string('jenis_lanjutan')->nullable();
            $table->string('jenis_lanjutan_en')->nullable();
            $table->string('jenjang_lanjutan')->nullable();
            $table->string('jenjang_lanjutan_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenjang_pendidikan');
    }
};
