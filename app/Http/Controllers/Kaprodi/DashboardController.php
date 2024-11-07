<?php

namespace App\Http\Controllers\Kaprodi;

use App\Models\Kegiatan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $kaprodi = Auth::user()->kaprodi;
        $jmlMhs = Mahasiswa::where('program_studi_id',  $kaprodi->prodi->id)->count();
        $jmlKegiatan = Kegiatan::whereHas('mahasiswa', function ($query) use ($kaprodi) {
            $query->where('program_studi_id', $kaprodi->prodi->id);
        })->count();

        $jmlKegiatanValidasi = Kegiatan::whereHas('mahasiswa', function ($query) use ($kaprodi) {
            $query->where('program_studi_id', $kaprodi->prodi->id);
        })->where('status', 'validasi')->count();

        $jmlKegiatanTolak = Kegiatan::whereHas('mahasiswa', function ($query) use ($kaprodi) {
            $query->where('program_studi_id', $kaprodi->prodi->id);
        })->where('status', 'tolak')->count();

        return view('kaprodi.dashboard', compact('jmlMhs', 'jmlKegiatan', 'jmlKegiatanValidasi', 'jmlKegiatanTolak'));
    }
}
