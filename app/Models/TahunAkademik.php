<?php

namespace App\Models;

use App\Models\Kegiatan;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunAkademik extends Model
{
    use HasFactory;

    protected $table = 'tahun_akademik';

    protected $fillable = ['semester_id', 'nama'];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function Kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }
}
