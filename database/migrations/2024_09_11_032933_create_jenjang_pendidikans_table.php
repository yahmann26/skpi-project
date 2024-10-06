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
            $table->string('nama', 100);
            $table->string('nama_en', 100)->nullable();
            $table->string('singkatan', 10)->nullable();
            $table->string('kualifikasi_kkni')->nullable();
            $table->string('syarat_masuk')->nullable();
            $table->string('syarat_masuk_en')->nullable();
            $table->string('lama_studi_reguler')->nullable();
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
