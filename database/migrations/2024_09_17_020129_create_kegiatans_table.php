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
            $table->foreignId('kategori_kegiatan_id')->constrained('kategori_kegiatan', 'id')->cascadeOnDelete();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa', 'id')->cascadeOnDelete();
            $table->string('nama'); // nama kegiatan / prestasi / aktifitas
            $table->string('nama_en'); // nama kegiatan / prestasi / aktifitas dlm bhs inggris
            $table->string('tingkat'); // himpunan, univ, kota, provinsi
            $table->year('tahun');
            $table->string('jabatan'); // peserta, anggota, juara 1, dll
            $table->string('penyelenggara');
            $table->string('file_sertifikat')->nullable();
            $table->string('status')->default('diproses'); // diproses, diterima, ditolak
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
