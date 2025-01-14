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
            $table->string('kode_prodi')->nullable();
            $table->string('nama');
            $table->string('nama_en');
            $table->string('singkatan');
            $table->string('akreditasi');
            $table->string('sk_akreditasi');
            $table->string('bhs_pengantar_kuliah')->nullable();
            $table->string('bhs_pengantar_kuliah_en')->nullable();
            $table->string('sistem_penilaian');
            $table->string('sistem_penilaian_en');
            $table->string('gelar')->nullable();
            $table->string('gelar_en')->nullable();
            $table->string('gelar_singkat')->nullable();
            $table->text('kualifikasi_cpl')->nullable();
            $table->text('kegiatan_default')->nullable();
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
