<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periode extends Model
{    use HasFactory;

    protected $table = 'periode';

    protected $fillable = [
        'nama',
    ];

    public function skpi() {
        return $this->hasMany(Skpi::class);
    }
}
