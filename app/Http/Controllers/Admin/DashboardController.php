<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kaprodi;
use App\Models\Kegiatan;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Models\KategoriKegiatan;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        $jmlMahasiswa = Mahasiswa::count();
        $jmlProdi = ProgramStudi::count();
        $jmlKaprodi =Kaprodi::count();
        $jmlKategori = KategoriKegiatan::count();
        $jmlKegiatan = Kegiatan::count();
        
        return view('admin.dashboard', compact('jmlMahasiswa', 'jmlProdi', 'jmlKaprodi', 'jmlKategori', 'jmlKegiatan'));
    }
}
