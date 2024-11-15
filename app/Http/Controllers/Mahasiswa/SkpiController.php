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

        $skpi = Skpi::where('mahasiswa_id', Auth::user()->mahasiswa->id)->first();

        $ajukanSkpi = $skpi ? true : false;

        if ($request->ajax()) {
            $skpi = Skpi::where('mahasiswa_id', Auth::user()->mahasiswa->id)
                ->select('skpi.*')
                ->get();

            return DataTables::of($skpi)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $cetakSkpi = route('mahasiswa.skpi.cetakPdf', $row->id);

                    if ($row->status === 'validasi') {
                        return '
                            <a href="' . $cetakSkpi . '" class="edit btn btn-light btn-sm"><i class="bi bi-printer"></i></a>
                        ';
                    }

                    return '';
                })

                ->addColumn('status', fn($row) => getStatusColor($row->status))
                ->addColumn('mhs', fn($row) => $row->mahasiswa->nama)
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('mahasiswa.pages.skpi.index', compact('ajukanSkpi'));
    }

    public function store(Request $request)
    {
        $skpi = new Skpi();
        $skpi->mahasiswa_id = Auth::user()->mahasiswa->id;

        $skpi->save();
        return response()->json(['success' => true, 'message' => 'SKPI berhasil diajukan.']);
    }

    public function cetakPdf()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $pt = Pt::where('id', 1)->first();

        $skpi = Skpi::with([
            'mahasiswa.prodi.jenjangPendidikan',
            'mahasiswa.kegiatan' => function ($query) {
                $query->where('status', 'validasi');
            }
        ])->where('mahasiswa_id', $mahasiswa->id)->first();

        if (!$skpi) {
            return redirect()->back()->with('error', 'SKPI not found');
        }

        $mahasiswa = $skpi->mahasiswa;
        $prodi = $mahasiswa->prodi;
        $cpl = json_decode($prodi->kualifikasi_cpl, true);
        $jenjangPendidikan = $prodi->jenjangPendidikan;
        $kegiatan = $mahasiswa->kegiatan;
        $namaUniv = HelperSkpi::getSettingByName('nama_universitas');
        $namaUnivEn = HelperSkpi::getSettingByName('nama_universitas_en');
        $ttd = HelperSkpi::getSettingByName('nama_penandatangan');
        $nidn = HelperSkpi::getSettingByName('nip_penandatangan');

        // $logoAplikasiUrl = HelperSkpi::getAssetUrl(HelperSkpi::getSettingByName('logo_aplikasi'));
        $imagePath = public_path('images/unsiq.png');
        $logoUniv = base64_encode(file_get_contents($imagePath));

        $data = [
            'pt' => $pt,
            'skpi' => $skpi,
            'mahasiswa' => $mahasiswa,
            'prodi' => $prodi,
            'cpl' => $cpl,
            'jenjangPendidikan' => $jenjangPendidikan,
            'kegiatan' => $kegiatan,
            'namaUniv' => $namaUniv,
            'namaUnivEn' => $namaUnivEn,
            'ttd' => $ttd,
            'nidn' => $nidn,
            'logoUniv' => $logoUniv,
        ];

        $pdf = app('dompdf.wrapper')->loadView('mahasiswa.pages.skpi.cetakPdf', $data);
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

        return $pdf->stream();
    }
}
