<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $guarded = [];


    // protected $casts = [
    //     'validasi_dokumen' => 'boolean',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prodi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }

    public function jenisPendaftaran()
    {
        return $this->belongsTo(JenisPendaftaran::class, 'jenis_pendaftaran_id');
    }

    public function kegiatan () {
        return $this->hasMany(Kegiatan::class);
    }

    public function skpi() {
        return $this->hasOne(Skpi::class);
    }


}
