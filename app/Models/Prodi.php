<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
        'bahasa_pengantar_kuliah',
        'akreditasi',
        'sk_akreditasi',
        'sistem_penilaian',
        'gelar',
        'jenis_program_pendidikan',
        'jenjang_lanjutan',
        'kualifikasi_kkni',
    ];
    protected $table = 'prodi';

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }

    public function cp()
    {
        return $this->hasOne(CapaianPembelajaran::class);
    }
}
