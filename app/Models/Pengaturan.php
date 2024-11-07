<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;

    public $table = 'pengaturan';

    public $fillable = [
        'nama',
        'tipe',
        'nilai'
    ];

    public function kategoriPengaturan() {
        return $this->belongsTo(KategoriPengaturan::class, 'kategori_pengaturan_id');
    }
}
