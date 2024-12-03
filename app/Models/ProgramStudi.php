<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPStan\PhpDocParser\Ast\Type\ThisTypeNode;

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

    public function kaprodi()
    {
        return $this->hasOne(Kaprodi::class, 'program_studi_id');
    }
}
