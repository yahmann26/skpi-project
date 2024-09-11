<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    public $table = 'program_studi';

    protected $guarded = [];

    /* RELATIONS */

    public function jenjangPendidikan()
    {
        return $this->belongsTo(JenjangPendidikan::class, 'jenjang_pendidikan_id');
    }
}
