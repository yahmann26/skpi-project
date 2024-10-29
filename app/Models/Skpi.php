<?php

namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skpi extends Model
{
    use HasFactory;

    protected $table = 'skpi';

    protected $guarded = [];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
