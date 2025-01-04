<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Pt;
use App\Models\Skpi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Helper\Skpi as  HelperSkpi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SkpiController extends Controller
{
    public function index(Request $request)
    {

        $skpi = Skpi::where('mahasiswa_id', Auth::user()->mahasiswa->id)->first();

        if ($request->ajax()) {
            $skpi = Skpi::where('mahasiswa_id', Auth::user()->mahasiswa->id)
                ->select('skpi.*')
                ->get();

            return DataTables::of($skpi)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $cetakSkpi = route('mahasiswa.skpi.cetak', $row->id);
                    return '<a href="' .
                        $cetakSkpi .
                        '" class="show btn btn-success btn-sm" target="_blank"><i class="bi bi-printer"></i></a>';
                })
                ->addColumn('mhs', fn($row) => $row->mahasiswa->nama)
                ->rawColumns(['action', 'mhs'])
                ->make(true);
        }

        return view('mahasiswa.pages.skpi.index');
    }

    public function cetak()
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
        $namaSingkat = HelperSkpi::getSettingByName('nama_universitas_singkat');
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
            'namaSingkat' => $namaSingkat,
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
        $html = view('mahasiswa.pages.skpi.cetak1', $data)->render();

        $htmlHeader = view('mahasiswa.pages.skpi.header', $data)->render();
        $mpdf->SetHTMLHeader($htmlHeader);

        // $mpdf->SetMargins(10, 10, 20);
        $html2 = view('mahasiswa.pages.skpi.cetak2', $data)->render();
        $mpdf->WriteHTML($html);
        $mpdf->WriteHTML($html2);

        $mpdf->Output();
    }
}
