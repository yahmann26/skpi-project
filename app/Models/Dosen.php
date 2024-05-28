<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosen';
    protected $primarykey = 'id';

    protected $fillable = [
        'kode_dosen', 'nama_dosen', 'jabatan', 'prodi_id',
    ];

    public function prodi() {
        return $this->belongsTo(Prodi::class);
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }
}
