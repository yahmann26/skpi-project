<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pt;
use Carbon\Carbon;
use App\Models\Skpi;
use App\Models\Periode;
use App\Models\Mahasiswa;
use App\Imports\SkpiImport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Helper\Skpi as HelperSkpi;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border as StyleBorder;
use PhpOffice\PhpSpreadsheet\Style\Alignment as StyleAlignment;

class SkpiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
                    $editUrl = route('admin.skpi.edit', $row->id);
                    $deleteUrl = route('admin.skpi.destroy', $row->id);
                    $cetakSkpi = route('admin.skpi.cetak', $row->id);
                    $showSkpi = route('admin.skpi.show', $row->id);
                    return '
                        <a href="' .
                        $editUrl .
                        '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                        <a href="' .
                        $showSkpi .
                        '" class="show btn btn-light btn-sm"><i class="bi bi-search"></i></a>
                        <form id="deleteForm-' .
                        $row->id .
                        '" action="' .
                        $deleteUrl .
                        '" method="POST" style="display:inline-block;">
                            ' .
                        csrf_field() .
                        '
                            ' .
                        method_field('DELETE') .
                        '
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' .
                        $row->id .
                        ')"><i class="bi bi-trash"></i></button>
                        </form>';
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.pages.skpi.index');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
            ],
            [
                'nama.required' => 'Nama harus diisi',
            ],
        );

        Periode::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.skpi.index')->with('success', 'Periode berhasil ditambahkan');
    }

    public function show(Request $request, string $id)
    {
        $periode = Periode::with(['skpi.mahasiswa.prodi'])->findOrFail($id);

        if ($request->ajax()) {
            return DataTables::of($periode->skpi)
                ->addIndexColumn()
                ->addColumn('nama', function ($data) {
                    return $data->mahasiswa ? $data->mahasiswa->nama : '-';
                })
                ->addColumn('prodi', function ($data) {
                    return $data->mahasiswa && $data->mahasiswa->prodi ? $data->mahasiswa->prodi->nama : '-';
                })
                ->rawColumns(['nama', 'prodi'])
                ->make(true);
        }

        return view('admin.pages.skpi.show', compact('periode'));
    }

    public function cetak($id)
    {
        $pt = Pt::where('id', 1)->first();

        $skpi = Skpi::with([
            'mahasiswa.prodi.jenjangPendidikan',
            'mahasiswa.kegiatan' => function ($query) {
                $query->where('status', 'validasi');
            },
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

        $html2 = view('admin.pages.skpi.cetak2', $data)->render();
        $mpdf->WriteHTML($html);
        $mpdf->WriteHTML($html2);

        $mpdf->Output();
    }

    private function generateNomor($skpi)
    {
        $year = date('Y');

        $sequence = str_pad($skpi->id, 5, '0', STR_PAD_LEFT);

        $prodi = $skpi->mahasiswa->prodi->singkatan ?? '';
        $jenjang = $skpi->mahasiswa->prodi->jenjangPendidikan->singkatan ?? '';
        $kode = $skpi->mahasiswa->prodi->kode_prodi ?? '';

        $nomor = "{$sequence}/SKPI/FASTIKOM/UNSIQ/{$jenjang}.{$prodi}/{$kode}/{$year}";

        return $nomor;
    }

    public function destroy($id)
    {
        Skpi::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }

    public function download()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $downloadTime = Carbon::now()->format('d-m-Y H:i:s');
        $sheet->setCellValue('A1', 'Template Import SKPI');
        $sheet->setCellValue('A2', "Waktu Download: $downloadTime");

        $sheet->mergeCells('A1:C1');
        $sheet->mergeCells('A2:C2');

        $sheet->getStyle('A1:A2')->getFont()->setBold(true)->setSize(14);
        $sheet
            ->getStyle('A1:A2')
            ->getAlignment()
            ->setHorizontal(StyleAlignment::HORIZONTAL_LEFT);

        $header = ['NO', 'NIM', 'NOMOR SKPI'];
        $sheet->fromArray($header, null, 'A3');

        $sheet->getStyle('A3:C3')->getFont()->setBold(true);

        $sheet
            ->getStyle('A3:C3')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(StyleBorder::BORDER_THIN);

        $sheet
            ->getStyle('A3:C500')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(StyleBorder::BORDER_THIN);

        foreach (range('A', 'C') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $fileName = 'tempalte SKPI.xlsx';
        $filePath = Storage::path($fileName);

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function import(Request $request, $periodeId)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        $periode = Periode::findOrFail($periodeId);

        try {
            $file = $request->file('file');

            Excel::import(new SkpiImport($periodeId), $file);

            return redirect()->route('admin.periode.show', $periodeId)->with('success', 'Data SKPI berhasil diimpor');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimpor file: ' . $e->getMessage());
        }
    }
}
