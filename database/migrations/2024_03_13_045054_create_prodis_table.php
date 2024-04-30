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
        Schema::create('prodi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_prodi', 10)->unique();
            $table->string('nama_prodi', 50);
            $table->string('bahasa_pengantar_kuliah', 50);
            $table->string('akreditasi', 50);
            $table->string('sk_akreditasi', 50);
            $table->string('sistem_penilaian', 100);
            $table->string('gelar', 50);
            $table->string('jenis_program_pendidikan', 50);
            $table->string('jenjang_lanjutan', 50);
            $table->string('kualifikasi_kkni', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('prodi');
    }
};
