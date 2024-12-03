<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    use HasFactory;

    protected $table = 'tahun_akademik';

    protected $guarded = [];

     /* RELATIONS */

     public function semester()
     {
        return $this->belongsTo(Semester::class);
     }

     public function Kegiatan()
     {
         return $this->hasMany(Kegiatan::class);
     }
}
