<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pt;
use App\Models\Skpi;
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
            $skpi = skpi::with(['mahasiswa.kegiatan', 'mahasiswa.prodi.jenjangPendidikan'])->latest()->get();

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
                    $deleteUrl = route('admin.skpi.destroy', $row->id);
                    $cetakSkpi = route('admin.skpi.cetak', $row->id);
                    $showSkpi = route('admin.skpi.show', $row->id);

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
                ->addColumn('kategori', fn($row) => $row->kategoriKegiatan->nama ?? 'N/A')
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

        $imagePath = public_path('images/unsiq.png');
        $logoUniv = base64_encode(file_get_contents($imagePath));
        $imagePath2 = public_path('images/logo unsiq.png');
        $logoUniv2 = base64_encode(file_get_contents($imagePath2));

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
            'logoUniv2' => $logoUniv2,
        ];

        $mpdf = new \Mpdf\Mpdf([
            'setAutoTopMargin' => 'stretch',
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
        ]);

        $mpdf->SetHTMLFooter('

            <div style="text-align: left; font-size: 12px; border-top: 2px solid; border-top: 2px solid;  padding-left: 35px;">
                {PAGENO}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | SURAT KETERANGAN PENDAMPING IJAZAH - <span style = "font-style: italic; color: gray; ">Diploma Suplement</span>
            </div>
        ');

        $mpdf->AddPage();
        $html = view('admin.pages.skpi.cetak1', $data)->render();

        $htmlHeader = view('admin.pages.skpi.header', $data)->render();
        $mpdf->SetHTMLHeader($htmlHeader);

        // $mpdf->SetMargins(10, 10, 20);
        $html2 = view('admin.pages.skpi.cetak2', $data)->render();
        $mpdf->WriteHTML($html);
        $mpdf->WriteHTML($html2);

        // Output PDF ke browser
        $mpdf->Output();
    }

    public function updateStatus(Request $request, $id)
    {

        $request->validate([
            'status' => 'required|in:validasi,tolak',
        ]);

        $skpi = Skpi::findOrFail($id);

        $skpi->status = $request->status;

        if ($request->status === 'validasi') {
            $skpi->nomor = $this->generateNomor($skpi);
        }

        $skpi->save();

        if ($request->status === 'validasi') {
            return redirect()->route('admin.skpi.index', $skpi->id)->with('success', 'Status SKPI berhasil diperbarui!!! Nomor: ' . $skpi->nomor);
        } elseif ($request->status === 'tolak') {
            return redirect()->route('admin.skpi.index')->with('success', 'SKPI ditolak !!!');
        }
    }

    private function generateNomor($skpi)
    {
        $year = date('Y');

        $sequence = str_pad($skpi->id, 5, '0', STR_PAD_LEFT); // Menghasilkan nomor urut seperti '00001'

        $prodi = $skpi->mahasiswa->prodi->singkatan ?? '';
        $jenjang = $skpi->mahasiswa->prodi->jenjangPendidikan->singkatan ?? '';  // Misalnya 'S1.TI'
        $nim = $skpi->mahasiswa->nim ?? ''; // Misalnya '55201'

        // Gabungkan semua bagian untuk menghasilkan nomor SKPI
        $nomor = "{$sequence}/SKPI/FASTIKOM/UNSIQ/{$jenjang}.{$prodi}/{$nim}/{$year}";

        return $nomor;
    }

    public function destroy($id)
    {
        Skpi::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
