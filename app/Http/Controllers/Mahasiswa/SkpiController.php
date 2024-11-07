<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Pt;
use App\Models\Skpi;
use App\Helper\Skpi as  HelperSkpi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\Auth;

class SkpiController extends Controller
{
    public function index(Request $request)
    {
        // Fungsi untuk mendapatkan warna status
        if (!function_exists('getStatusColor')) {
            function getStatusColor($status)
            {
                $status = strtolower($status);
                switch ($status) {
                    case 'pengajuan':
                        return '<span class="badge bg-warning">Pengajuan</span>';
                    case 'tolak':
                        return '<span class="badge bg-danger">Ditolak</span>';
                    case 'validasi':
                        return '<span class="badge bg-success">Validasi</span>';
                    default:
                        return '<span class="badge bg-secondary">Tidak diketahui</span>';
                }
            }
        }

        if ($request->ajax()) {
            // Ambil data skpi untuk mahasiswa yang sedang login
            $skpi = Skpi::where('mahasiswa_id', Auth::user()->mahasiswa->id)
                ->select('skpi.*')
                ->get();

            return DataTables::of($skpi)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $cetakSkpi = route('mahasiswa.skpi.cetak', $row->id);

                    // Check the validation status
                    if ($row->status === 'validasi') {
                        return '
                            <a href="' . $cetakSkpi . '" class="edit btn btn-light btn-sm"><i class="bi bi-printer"></i></a>
                        ';
                    }

                    // If status is not validasi, return nothing
                    return '';
                })

                ->addColumn('status', fn($row) => getStatusColor($row->status))
                ->addColumn('mhs', fn($row) => $row->mahasiswa->nama)
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('mahasiswa.pages.skpi.index');
    }

    public function store(Request $request)
    {
        $skpi = new Skpi();
        $skpi->mahasiswa_id = Auth::user()->mahasiswa->id;

        $skpi->save();

        // dd($cpl);

        return response()->json(['success' => true, 'message' => 'SKPI berhasil diajukan.']);
    }

    public function cetak()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        // Ambil data SKPI berdasarkan mahasiswa ID
        $skpi = Skpi::with([
            'mahasiswa.prodi.jenjangPendidikan',
            'mahasiswa.kegiatan' => function ($query) {
                $query->where('status', 'validasi');
            }
        ])->where('mahasiswa_id', $mahasiswa->id)->first();

        if (!$skpi) {
            return redirect()->back()->with('error', 'SKPI not found');
        }

        // Ambil data yang diperlukan
        $prodi = $mahasiswa->prodi;
        $cpl = json_decode($prodi->kualifikasi_cpl, true);
        $jenjangPendidikan = $prodi->jenjangPendidikan;
        $kegiatan = $skpi->mahasiswa->kegiatan;

        // Ambil data PT
        $pt = Pt::where('id', 1)->first();

        $namaUniv = HelperSkpi::getSettingByName('nama_universitas');
        $namaUnivEn = HelperSkpi::getSettingByName('nama_universitas_en');
        $ttd = HelperSkpi::getSettingByName('nama_penandatangan');
        $nidn = HelperSkpi::getSettingByName('nip_penandatangan');
        $logoUniv = HelperSkpi::getAssetUrl(HelperSkpi::getSettingByName('logo_universitas'));

        return view('mahasiswa.pages.skpi.cetak', compact('skpi', 'mahasiswa', 'prodi', 'jenjangPendidikan', 'kegiatan', 'pt', 'cpl','logoUniv', 'ttd', 'nidn', 'namaUniv', 'namaUnivEn'));
    }

    public function cetak1()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        // Ambil data SKPI berdasarkan mahasiswa ID
        $skpi = Skpi::with([
            'mahasiswa.prodi.jenjangPendidikan',
            'mahasiswa.kegiatan' => function ($query) {
                $query->where('status', 'validasi');
            }
        ])->where('mahasiswa_id', $mahasiswa->id)->first();

        if (!$skpi) {
            return redirect()->back()->with('error', 'SKPI not found');
        }

        // Ambil data yang diperlukan
        $prodi = $mahasiswa->prodi;
        $cpl = json_decode($prodi->kualifikasi_cpl, true);
        $jenjangPendidikan = $prodi->jenjangPendidikan;
        $kegiatan = $skpi->mahasiswa->kegiatan;

        // Ambil data PT
        $pt = Pt::where('id', 1)->first();

        $namaUniv = HelperSkpi::getSettingByName('nama_universitas');
        $namaUnivEn = HelperSkpi::getSettingByName('nama_universitas_en');
        $ttd = HelperSkpi::getSettingByName('nama_penandatangan');
        $nidn = HelperSkpi::getSettingByName('nip_penandatangan');
        $logoUniv = HelperSkpi::getAssetUrl(HelperSkpi::getSettingByName('logo_universitas'));

        return view('mahasiswa.pages.skpi.cetak1', compact('skpi', 'mahasiswa', 'prodi', 'jenjangPendidikan', 'kegiatan', 'pt', 'cpl','logoUniv', 'ttd', 'nidn', 'namaUniv', 'namaUnivEn'));
    }
}
