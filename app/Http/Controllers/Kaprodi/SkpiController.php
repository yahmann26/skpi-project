<?php

namespace App\Http\Controllers\Kaprodi;

use App\Models\Pt;
use App\Models\Skpi;
use App\Models\Periode;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use  App\Helper\Skpi as HelperSkpi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SkpiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $skpi = Periode::query()->latest()->get();

            return DataTables::of($skpi)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->addColumn('action', function ($row) {
                    $showSkpi = route('kaprodi.skpi.show', $row->id);
                    return '
                        <a href="' .
                        $showSkpi .
                        '" class="show btn btn-light btn-sm"><i class="bi bi-search"></i></a>';
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return view('kaprodi.pages.skpi.index');
    }

    public function show(Request $request, string $id)
    {
        $periode = Periode::with(['skpi.mahasiswa.prodi'])->findOrFail($id);
        if ($request->ajax()) {

            $prodi_kaprodi = Auth::user()->kaprodi->program_studi_id;

            // Ambil data SKPI berdasarkan prodi kaprodi
            $skpi = Skpi::with(['mahasiswa'])
                ->whereHas('mahasiswa', function ($query) use ($prodi_kaprodi) {
                    $query->whereHas('prodi', function ($query) use ($prodi_kaprodi) {
                        $query->where('id', $prodi_kaprodi);
                    });
                })
                ->select('skpi.*')
                ->orderBy('created_at', 'desc')
                ->get();
            return DataTables::of($skpi)
                ->addIndexColumn()
                ->addColumn('nim', function ($data) {
                    return optional($data->mahasiswa)->nim ?? '-';
                })
                ->addColumn('nama', function ($data) {
                    return optional($data->mahasiswa)->nama ?? '-';
                })
                ->rawColumns(['nim', 'nama'])
                ->make(true);
        }

        // Render view jika bukan permintaan AJAX
        return view('kaprodi.pages.skpi.show', compact('periode'));
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
            return redirect()->route('kaprodi.skpi.index', $skpi->id)->with('success', 'Status SKPI berhasil diperbarui!!! Nomor: ' . $skpi->nomor);
        } elseif ($request->status === 'tolak') {
            return redirect()->route('kaprodi.skpi.index')->with('success', 'SKPI ditolak !!!');
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

    public function cetak($ids)
    {
        $pt = Pt::where('id', 1)->first();

        // Mengubah string ID menjadi array
        $idsArray = explode(',', $ids);

        // Mengambil SKPI berdasarkan array ID
        $skpis = Skpi::with([
            'mahasiswa.prodi.jenjangPendidikan',
            'mahasiswa.kegiatan' => function ($query) {
                $query->where('status', 'validasi');
            },
        ])->whereIn('id', $idsArray)->get();

        // Jika tidak ada SKPI yang ditemukan
        if ($skpis->isEmpty()) {
            return redirect()->back()->with('error', 'SKPI tidak ditemukan');
        }

        // Menginisialisasi MPDF
        $mpdf = new \Mpdf\Mpdf([
            'setAutoTopMargin' => 'stretch',
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
        ]);

        $mpdf->SetHTMLFooter('
        <div style="text-align: left; font-size: 12px; border-top: 2px solid; padding-left: 35px;">
        {PAGENO}      | SURAT KETERANGAN PENDAMPING IJAZAH - <span style="font-style: italic; color: gray;">Diploma Supplement</span>
        </div>
    ');

        // Path logo universitas
        $imagePath = public_path('images/unsiq.png');
        $logoUniv = base64_encode(file_get_contents($imagePath));
        $imagePath2 = public_path('images/logo unsiq.png');
        $logoUniv2 = base64_encode(file_get_contents($imagePath2));

        foreach ($skpis as $skpi) {
            $mahasiswa = $skpi->mahasiswa;
            $prodi = $mahasiswa->prodi;
            $cpl = json_decode($prodi->kualifikasi_cpl, true);
            $jenjangPendidikan = $prodi->jenjangPendidikan;
            $kegiatan = $mahasiswa->kegiatan;
            $namaUniv = HelperSkpi::getSettingByName('nama_universitas');
            $namaSingkat = HelperSkpi::getSettingByName('nama_universitas_singkat');
            $namaUnivEn = HelperSkpi::getSettingByName('nama_universitas_en');
            $ttd = HelperSkpi::getSettingByName('nama_penandatangan');
            $nidn = HelperSkpi::getSettingByName('nip_penandatangan');

            // Data untuk dikirim ke view
            $data = [
                'pt' => $pt,
                'skpi' => $skpi,
                'mahasiswa' => $mahasiswa,
                'prodi' => $prodi,
                'cpl' => $cpl,
                'jenjangPendidikan' => $jenjangPendidikan,
                'kegiatan' => $kegiatan,
                'namaUniv' => $namaUniv,
                'namaSingkat' => $namaSingkat,
                'namaUnivEn' => $namaUnivEn,
                'ttd' => $ttd,
                'nidn' => $nidn,
                'logoUniv' => $logoUniv,
                'logoUniv2' => $logoUniv2,
            ];

            // Render header dan halaman PDF
            $header1 = view('admin.pages.skpi.header1', $data)->render();
            $mpdf->SetHTMLHeader($header1, 'O');

            $mpdf->AddPage('P', '', 1);

            $html = view('admin.pages.skpi.cetak1', $data)->render();
            $mpdf->WriteHTML($html);

            $header = view('admin.pages.skpi.header', $data)->render();
            $mpdf->SetHTMLHeader($header);

            $html2 = view('admin.pages.skpi.cetak2', $data)->render();
            $mpdf->WriteHTML($html2);
        }

        return $mpdf->Output('skpi.pdf', 'I');
    }
}
