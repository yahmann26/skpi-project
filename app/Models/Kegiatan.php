<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $guarded = [];

    public function kategoriKegiatan() {
        return $this->belongsTo(KategoriKegiatan::class, 'kategori_kegiatan_id');
    }

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
