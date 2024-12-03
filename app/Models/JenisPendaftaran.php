<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'jenis_pendaftaran';

    protected $guarded = [];

     /* RELATIONS */
     public function Mahasiswa()
     {
         return $this->hasMany(Mahasiswa::class);
     }
}
