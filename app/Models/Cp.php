<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cp extends Model
{
    use HasFactory;

    protected $table = 'cp';

    protected $guarded = [];


     /* RELATIONS */

     public function prodi()
     {
         return $this->belongsTo(ProgramStudi::class);
     }
}
