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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_akademik_id')->constrained('tahun_akademik', 'id')->cascadeOnDelete();
            $table->foreignId('kategori_kegiatan_id')->constrained('kategori_kegiatan', 'id')->cascadeOnDelete();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa', 'id')->cascadeOnDelete();
            $table->string('nama');
            $table->string('nama_en');
            $table->string('tingkat');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('pencapaian');
            $table->string('penyelenggara');
            $table->string('file_sertifikat')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('status')->default('diproses');
            $table->string('catatan_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
