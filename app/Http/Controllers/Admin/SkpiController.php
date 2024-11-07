<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pt;
use Dompdf\Dompdf;
use App\Models\Skpi;
use App\Models\Kegiatan;
use Barryvdh\DomPDF\PDF;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use  App\Helper\Skpi as HelperSkpi;
use App\Http\Controllers\Controller;

class SkpiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            // Mengambil data mahasiswa dengan relasi ke skpi, program studi, dan jenjang pendidikan
            $skpi = skpi::with(['mahasiswa.kegiatan', 'mahasiswa.prodi.jenjangPendidikan'])->latest();

            return DataTables::of($skpi)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->addColumn('nim', function (Skpi $skpi) {
                    return $skpi->mahasiswa->nim ?? 'Tidak ada';
                })
                ->addColumn('nama', function (Skpi $skpi) {
                    return $skpi->mahasiswa->nama ?? 'Tidak ada';
                })
                ->addColumn('prodi', function (Skpi $skpi) {
                    return $skpi->mahasiswa->prodi->nama;
                })
                ->addColumn('status', fn($row) => getStatusColor($row->status))
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.skpi.edit', $row->id);
                    $deleteUrl = route('admin.mahasiswa.destroy', $row->id);
                    $cetakSkpi = route('admin.skpi.cetakPdf', $row->id);
                    $showSkpi = route('admin.skpi.show', $row->id); // Adjust this route as needed

                    // Check the validation status
                    if ($row->status === 'validasi') {
                        $actionButtons = '
                            <a href="' . $cetakSkpi . '" class="edit btn btn-light btn-sm"><i class="bi bi-printer"></i></a>
                        ';
                    } else {
                        $actionButtons = '
                            <a href="' . $showSkpi . '" class="edit btn btn-light btn-sm"><i class="bi bi-search"></i></a>
                        ';
                    }

                    return '
                        ' . $actionButtons . '
                        <a href="' . $editUrl . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                        <form id="deleteForm-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $row->id . ')"><i class="bi bi-trash"></i></button>
                        </form>';
                })


                ->rawColumns(['action', 'prodi', 'nama', 'nim', 'status'])
                ->make(true);
        }

        return view('admin.pages.skpi.index');
    }

    public function show(Request $request, string $id)
    {
        $mahasiswa = Mahasiswa::all();
        $skpi = Skpi::with('mahasiswa.prodi.jenjangPendidikan')->findOrFail($id);

        // dd($skpi);

        if ($request->ajax()) {
            $kegiatan = $skpi->mahasiswa->kegiatan()->with('kategoriKegiatan')
                ->where('status', 'validasi')
                ->get();

            return DataTables::of($kegiatan)
                ->addIndexColumn()
                ->addColumn('kategori', fn($row) => $row->kategoriKegiatan->nama ?? 'N/A') // Gunakan null coalescing untuk menghindari kesalahan
                ->addColumn('nama', function ($row) {
                    return '<div>' . $row->nama . '</div><div class="small fst-italic text-muted">' . $row->nama_en . '</div>';
                })
                ->addColumn('pencapaian', function ($row) {
                    return '<div>' . $row->pencapaian . '</div><div class="small fst-italic text-muted">tingkat: ' . $row->tingkat . '</div>';
                })
                ->rawColumns(['kategori', 'nama', 'pencapaian'])
                ->make(true);
        }

        return view('admin.pages.skpi.show', compact('mahasiswa', 'skpi'));
    }

    public function cetak($id)
    {
        $pt = Pt::where('id', 1)->first();

        // dd($pt);

        // Ambil data SKPI berdasarkan ID
        $skpi = Skpi::with([
            'mahasiswa.prodi.jenjangPendidikan',
            'mahasiswa.kegiatan' => function ($query) {
                $query->where('status', 'validasi');
            }
        ])->find($id);

        if (!$skpi) {
            return redirect()->back()->with('error', 'SKPI not found');
        }

        // dd($skpi);

        // Ambil data yang diperlukan
        $mahasiswa = $skpi->mahasiswa;
        $prodi = $mahasiswa->prodi;
        $cpl = json_decode($prodi->kualifikasi_cpl, true);
        $jenjangPendidikan = $prodi->jenjangPendidikan;
        $kegiatan = $skpi->mahasiswa->kegiatan;
        $namaUniv = HelperSkpi::getSettingByName('nama_universitas');
        $namaUnivEn = HelperSkpi::getSettingByName('nama_universitas_en');
        $ttd = HelperSkpi::getSettingByName('nama_penandatangan');
        $nidn = HelperSkpi::getSettingByName('nip_penandatangan');
        $logoUniv = HelperSkpi::getAssetUrl(HelperSkpi::getSettingByName('logo_universitas'));

        // dd($cpl);

        return view('admin.pages.skpi.cetak', compact('skpi', 'mahasiswa', 'prodi', 'jenjangPendidikan', 'kegiatan', 'pt', 'cpl', 'namaUniv', 'namaUnivEn', 'ttd', 'nidn', 'logoUniv'));
    }

    public function cetakPdf($id)
    {
        $pt = Pt::where('id', 1)->first();

        $skpi = Skpi::with([
            'mahasiswa.prodi.jenjangPendidikan',
            'mahasiswa.kegiatan' => function ($query) {
                $query->where('status', 'validasi');
            }
        ])->find($id);

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
        $logoUniv = asset('images/unsiq.png');
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

        $pdf = app('dompdf.wrapper')->loadView('admin.pages.skpi.cetakPdf', $data);

        return $pdf->stream();
        // $logoPath = public_path(HelperSkpi::getAssetUrl(HelperSkpi::getSettingByName('logo_universitas')));

        // $data = [
        //     'title' => '',
        //     'content' => '',
        //     'logoUniv' =>$logoPath
        // ];

        // // dd($data);

        // // Mengatur ukuran kertas dan margin
        // $pdf = app('dompdf.wrapper')->loadView('admin.pages.skpi.cetakPdf', $data);
        // $pdf->setPaper('A4', 'portrait');
        // $pdf->set_option('margin-top', 3);
        // $pdf->set_option('margin-bottom', 3);
        // $pdf->set_option('margin-left', 3);
        // $pdf->set_option('margin-right', 3);

        // return $pdf->stream();
    }



    public function updateStatus(Request $request, $id)
    {
        // Validasi input jika diperlukan (opsional)
        $request->validate([
            'status' => 'required|in:validasi,tolak',
        ]);

        // Ambil data skpi berdasarkan ID
        $skpi = Skpi::findOrFail($id);

        // Update status skpi
        $skpi->status = $request->status;

        // Jika status validasi, generate nomor otomatis
        if ($request->status === 'validasi') {
            $skpi->nomor = $this->generateNomor(); // Panggil fungsi untuk mengenerate nomor
        }

        $skpi->save();



        // Cek status dan redirect sesuai kebutuhan
        if ($request->status === 'validasi') {
            return redirect()->route('admin.skpi.index', $skpi->id)->with('success', 'Status SKPI berhasil diperbarui!!! Nomor: ' . $skpi->nomor);
        } elseif ($request->status === 'tolak') {
            return redirect()->route('admin.skpi.index')->with('success', 'SKPI ditolak !!!');
        }
    }

    private function generateNomor()
    {
        // Ambil nomor terakhir dari database
        $lastSkpi = Skpi::orderBy('nomor', 'desc')->first();

        // Ambil bagian nomor yang relevan untuk diincrement
        if ($lastSkpi) {
            // Mengambil bagian angka dari nomor
            preg_match('/\d+/', $lastSkpi->nomor, $matches);
            $nextNomor = isset($matches[0]) ? intval($matches[0]) + 1 : 1;
        } else {
            $nextNomor = 1; // Jika tidak ada, mulai dari 1
        }

        // Format nomor dengan padding 4 digit
        $formattedNomor = sprintf('%04d/SKPI', $nextNomor);

        // Cek apakah nomor sudah ada di database
        while (Skpi::where('nomor', $formattedNomor)->exists()) {
            $nextNomor++;
            $formattedNomor = sprintf('%04d/SKPI', $nextNomor);
        }

        return $formattedNomor; // Kembalikan nomor baru

    }
}
