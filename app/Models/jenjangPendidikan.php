<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenjangPendidikan extends Model
{
    use HasFactory;

    public $table = 'jenjang_pendidikan';

    protected $guarded = [];

    /* RELATIONS */
    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class, 'jenjang_pendidikan_id', 'id');
    }
}
