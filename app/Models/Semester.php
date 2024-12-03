<?php

namespace App\Models;

use App\Models\TahunAkademik;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;

    protected $table = 'semester';

    protected $fillable = ['nama'];

    public function tahunAkademik()
    {
        return $this->hasMany(TahunAkademik::class);
    }
}
