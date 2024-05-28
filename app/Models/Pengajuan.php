<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'mahasiswa_id',
        'dosen_id',
        'kegiatan_id',
        'tanggal',
        'deskripsi',
        'status',
        'dokumen',
    ];

    const STATUS_PENGAJUAN = 'pengajuan';
    const STATUS_DITERIMA = 'diterima';
    const STATUS_DITOLAK = 'ditolak';

    public static function getStatusOptions()
    {
        return [
            self::STATUS_PENGAJUAN,
            self::STATUS_DITERIMA,
            self::STATUS_DITOLAK,
        ];
    }

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function dosen() {
        return $this->belongsTo(Dosen::class);
    }
}
