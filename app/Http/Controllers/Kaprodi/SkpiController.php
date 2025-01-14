<?php

namespace App\Http\Controllers\Kaprodi;

use App\Models\Pt;
use Carbon\Carbon;
use App\Models\Skpi;
use App\Models\Periode;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Imports\SkpiImportKaprodi;
use  App\Helper\Skpi as HelperSkpi;
use App\Http\Controllers\Controller;
use App\Imports\SkpiImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border as StyleBorder;
use PhpOffice\PhpSpreadsheet\Style\Alignment as StyleAlignment;

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
                    $deleteUrl = route('kaprodi.skpi.destroy', $row->id);
                    $showSkpi = route('kaprodi.skpi.show', $row->id);
                    return '
                        <a href="' . $showSkpi .'" class="show btn btn-light btn-sm"><i class="bi bi-search"></i></a>
                        <form id="deleteForm-' .$row->id .'" action="' .$deleteUrl .'" method="POST" style="display:inline-block;">'
                        . csrf_field() .''
                        . method_field('DELETE') .'
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' .$row->id .')"><i class="bi bi-trash"></i></button>
                        </form>';
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return view('kaprodi.pages.skpi.index');
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

        return redirect()->route('kaprodi.skpi.index')->with('success', 'Periode berhasil ditambahkan');
    }

    public function show(Request $request, string $id)
    {
        $periode = Periode::with(['skpi.mahasiswa.prodi'])->findOrFail($id);

        if ($request->ajax()) {

            $prodi_kaprodi = Auth::user()->kaprodi->program_studi_id;

            $skpi = Skpi::with(['mahasiswa'])
                ->where('periode_id', $periode->id)  // Filter berdasarkan periode
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

        return view('kaprodi.pages.skpi.show', compact('periode'));
    }

    public function destroy($id)
    {
        Periode::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }


    public function cetak($ids)
    {
        $pt = Pt::where('id', 1)->first();

        $idsArray = explode(',', $ids);

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

            $header = view('admin.pages.skpi.header', $data)->render();
            $mpdf->SetHTMLHeader($header);

            $html = view('admin.pages.skpi.cetak1', $data)->render();
            $mpdf->WriteHTML($html);


            $html2 = view('admin.pages.skpi.cetak2', $data)->render();
            $mpdf->WriteHTML($html2);
        }

        return $mpdf->Output('skpi.pdf', 'I');
    }

    public function download()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $downloadTime = Carbon::now()->format('d-m-Y H:i:s');
        $sheet->setCellValue('A1', 'Template Import SKPI');
        $sheet->setCellValue('A2', "Waktu Download: $downloadTime");

        $sheet->mergeCells('A1:E1');
        $sheet->mergeCells('A2:E2');

        $sheet->getStyle('A1:A2')->getFont()->setBold(true)->setSize(14);
        $sheet
            ->getStyle('A1:A2')
            ->getAlignment()
            ->setHorizontal(StyleAlignment::HORIZONTAL_LEFT);

        $header = ['NO', 'NIM', 'NOMOR SKPI', 'NO IJAZAH', 'TANGGAL LULUS'];
        $sheet->fromArray($header, null, 'A3');

        $sheet->getStyle('A3:E3')->getFont()->setBold(true);

        $sheet
            ->getStyle('A3:E3')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(StyleBorder::BORDER_THIN);

        $sheet
            ->getStyle('A3:E500')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(StyleBorder::BORDER_THIN);

        foreach (range('A', 'E') as $columnID) {
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
        // Validasi file yang diunggah
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:2048', // Pastikan file valid
        ]);

        // Pastikan periode dengan ID yang dimaksud ada
        $periode = Periode::findOrFail($periodeId);

        try {
            // Ambil file dari request
            $file = $request->file('file');

            $prodiId = Auth::user()->kaprodi->program_studi_id;

            Excel::import(new SkpiImport($periodeId, $prodiId), $file);

            return redirect()->route('kaprodi.periode.show', $periodeId)
                ->with('success', 'Data SKPI berhasil diimpor');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Tangkap kesalahan validasi dari Excel
            $failures = $e->failures();
            return back()->with('error', 'Kesalahan validasi data pada file yang diunggah. Silakan periksa dan coba lagi.');
        } catch (\Exception $e) {
            // Tangkap kesalahan lainnya
            return back()->with('error', 'Terjadi kesalahan saat mengimpor file: ' . $e->getMessage());
        }
    }
}
