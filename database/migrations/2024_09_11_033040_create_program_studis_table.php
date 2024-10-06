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
        Schema::create('program_studi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenjang_pendidikan_id')->constrained('jenjang_pendidikan', 'id')->cascadeOnDelete();
            $table->string('nama', 100);
            $table->string('nama_en', 100)->nullable();
            $table->string('akreditasi', 10)->nullable();
            $table->string('bhs_pengantar_kuliah')->nullable();
            $table->string('bhs_pengantar_kuliah_en')->nullable();
            $table->string('sistem_penilaian')->nullable();
            $table->string('sistem_penilaian_en')->nullable();
            $table->string('gelar', 100)->nullable();
            $table->string('gelar_en', 100)->nullable();
            $table->text('kualifikasi_cpl')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_studi');
    }
};
