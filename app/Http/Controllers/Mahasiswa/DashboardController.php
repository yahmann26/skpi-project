<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $mhs = Auth::user()->mahasiswa;
        $jmlKegiatan = Kegiatan::where('mahasiswa_id',  $mhs->id)->count();
        $jmlKegiatanValidasi = Kegiatan::where('mahasiswa_id',  $mhs->id)->where('status', 'validasi')->count();
        $jmlKegiatanTolak = Kegiatan::where('mahasiswa_id',  $mhs->id)->where('status', 'tolak')->count();

        return view('mahasiswa.dashboard', compact('jmlKegiatan', 'jmlKegiatanValidasi', 'jmlKegiatanTolak'));
    }
}
