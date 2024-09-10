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
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_pengaturan_id')->constrained('kategori_pengaturan', 'id')->cascadeOnDelete();
            $table->string('nama', 100);
            $table->string('deskripsi', 255)->nullable();
            $table->longText('nilai')->nullable();
            $table->string('tipe', 100)->default('text'); // text, textarea, number, file, image, select, radio, checkbox, json,dll
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};
