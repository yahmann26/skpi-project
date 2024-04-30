<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'tempat_lahir',
        'tgl_lahir',
        'prodi_id',
        'jenis_kelamin',
        'tgl_masuk',
        'tgl_lulus',
    ];

    // protected $casts = [
    //     'validasi_dokumen' => 'boolean',
    // ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    // public function surat()
    // {
    //     return $this->hasOne(surat::class);
    // }
}
