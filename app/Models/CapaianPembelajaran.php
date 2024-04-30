<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianPembelajaran extends Model
{
    use HasFactory;
    protected $table = 'capaian_pembelajaran';
    protected $primarykey = 'id';

    protected $fillable = [
        'penguasaan_pengetahuan',
        'keterampilan',
        'kemampuan_kerja',
        'sikap',
        'prodi_id'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
