<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $fillable = [
        'kategori_id',
        'nama_kegiatan',
        'tingkat_kegiatan',
        'jabatan',
        'bobot'
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }
}
