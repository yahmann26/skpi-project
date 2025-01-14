<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Imports\MahasiswaImport;
use App\Models\JenisPendaftaran;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\Border as StyleBorder;
use PhpOffice\PhpSpreadsheet\Style\Alignment as StyleAlignment;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Mahasiswa::query()->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->addColumn('prodi', function (Mahasiswa $mahasiswa) {
                    return $mahasiswa->prodi->nama;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.mahasiswa.edit', $row->id);
                    $deleteUrl = route('admin.mahasiswa.destroy', $row->id);
                    $resetPasswordUrl = route('admin.mahasiswa.reset-password', $row->id);
                    return '
                        <a href="#" class="btn btn-info btn-sm" onclick="confirmResetPassword(\'' . $resetPasswordUrl . '\')"><i class="bi bi-lock"></i></a>
                        <a href="' . $editUrl . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                        <form id="deleteForm-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $row->id . ')"><i class="bi bi-trash"></i></button>
                        </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.mahasiswa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = ProgramStudi::all();
        $jenisPendaftaran = JenisPendaftaran::all();

        return view('admin.pages.mahasiswa.create', [
            'prodi' => $prodi,
            'jenisPendaftaran' => $jenisPendaftaran,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa,nim',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'program_studi_id' => 'required',
            'email' => 'required',
        ], [
            'nim.required' => 'NIM wajib diisi',
            'nim.numeric' => 'NIM Hanya Angka',
            'nim.unique' => 'NIM sudah ada ',
            'nama.required' => 'Nama Mahasiswa wajib diisi',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi',
            'tgl_lahir.required' => 'Tanggal Lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib Dipilih',
            'program_studi_id.required' => 'Prodi Wajib Dipilih',
            'email.required' => 'email wajib diisi',
        ]);

        DB::transaction(function () use ($request) {
            $nim = $request->nim;

            $user = User::create([
                'uid' => $nim,
                'email' => $request->email,
                'password' => Hash::make($nim) // mengatur password sama dengan nim
            ]);

            Mahasiswa::create([
                'nim' => $nim,
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'program_studi_id' => $request->program_studi_id,
                'jenis_pendaftaran_id' => $request->jenis_pendaftaran_id,
                'tgl_masuk' => $request->tgl_masuk,
                'user_id' => $user->id,
            ]);
        });

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // get prodi
        $prodi = ProgramStudi::all();
        $jenisPendaftaran = JenisPendaftaran::all();

        $mahasiswa = Mahasiswa::with('prodi', 'jenisPendaftaran')->find($id);

        return  view('admin.pages.mahasiswa.edit', [
            'mahasiswa' => $mahasiswa,
            'prodi' => $prodi,
            'jenisPendaftaran' => $jenisPendaftaran,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'program_studi_id' => 'required',
            'email' => 'required|email|max:255',

        ], [
            'nama.required' => 'Nama Mahasiswa wajib diisi',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi',
            'tgl_lahir.required' => 'Tanggal Lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib Dipilih',
            'program_studi_id.required' => 'Prodi Wajib Dipilih',
            'email.required' => 'email wajib diisi',
        ]);

        // update data mahasiswa
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'tgl_masuk' => $request->tgl_masuk,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jenis_pendaftaran_id' => $request->jenis_pendaftaran_id,
            'program_studi_id' => $request->program_studi_id,
        ]);

        // dd($mahasiswa);

        //update data user
        $user = User::findOrFail($mahasiswa->user_id);

        $user->update([
            'uid' => $request->nim,
            'email' => $request->email,
        ]);

        // dd($user);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diupdate!');
    }

    public function destroy($id)
    {
        // Cari data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::findOrFail($mahasiswa->user_id);
        $mahasiswa->delete();

        $user->delete();

        return redirect()->back()->with('success', 'Data Mahasiswa berhasil dihapus!');
    }

    public function resetPassword($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $user = $mahasiswa->user;

        if ($user) {
            $user->password = bcrypt($mahasiswa->nim);
            $user->save();

            return redirect()->route('admin.mahasiswa.index')->with('success', 'Password telah berhasil direset');
        } else {
            return redirect()->route('admin.mahasiswa.index')->with('error', 'User tidak ditemukan.');
        }
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        // Import data dari file Excel
        Excel::import(new MahasiswaImport, $request->file('file'));

        return back()->with('success', 'Data mahasiswa berhasil diimpor!');
    }

    public function download()
    {
        // Ambil data dari database untuk kolom PRODI
        $prodiList = ProgramStudi::pluck('nama')->toArray();
        $jenisPendaftaranList = JenisPendaftaran::pluck('nama')->toArray();
        $jenisKelamin = ['L', 'P'];

        // Buat Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Tambahkan judul di atas header
        $downloadTime = Carbon::now()->format('d-m-Y H:i:s');
        $sheet->setCellValue('A1', 'Template Import Mahasiswa');
        $sheet->setCellValue('A2', "Waktu Download: $downloadTime");

        // Gabungkan sel untuk judul
        $sheet->mergeCells('A1:J1');
        $sheet->mergeCells('A2:J2');

        // Atur gaya untuk judul
        $sheet->getStyle('A1:A2')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1:A2')->getAlignment()->setHorizontal(StyleAlignment::HORIZONTAL_LEFT);

        // Tambahkan header
        $header = ['NO', 'NIM', 'EMAIL', 'NAMA', 'TEMPAT LAHIR', 'TGL LAHIR', 'JENIS KELAMIN', 'PRODI', 'TGL MASUK', 'JENIS PENDAFTARAN'];
        $sheet->fromArray($header, null, 'A3');

        // Header bold
        $sheet->getStyle('A3:J3')->getFont()->setBold(true);

        // Tambahkan border ke header
        $sheet->getStyle('A3:J3')->getBorders()->getAllBorders()->setBorderStyle(StyleBorder::BORDER_THIN);

        // Tambahkan dropdown untuk "JENIS KELAMIN"
        $jenisKelaminValidation = new DataValidation();
        $jenisKelaminValidation->setType(DataValidation::TYPE_LIST);
        $jenisKelaminValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
        $jenisKelaminValidation->setAllowBlank(true);
        $jenisKelaminValidation->setShowDropDown(true);
        $jenisKelaminValidation->setFormula1('"' . implode(',', $jenisKelamin) . '"');

        foreach (range(4, 500) as $row) {
            $sheet->getCell("G$row")->setDataValidation(clone $jenisKelaminValidation);
        }

        // Tambahkan dropdown untuk "PRODI"
        $prodiValidation = new DataValidation();
        $prodiValidation->setType(DataValidation::TYPE_LIST);
        $prodiValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
        $prodiValidation->setAllowBlank(true);
        $prodiValidation->setShowDropDown(true);
        $prodiValidation->setFormula1('"' . implode(',', $prodiList) . '"');

        foreach (range(4, 500) as $row) {
            $sheet->getCell("H$row")->setDataValidation(clone $prodiValidation);
        }
        // Tambahkan dropdown untuk "Jenis Pendaftaran"
        $jenisPendaftaranValidation = new DataValidation();
        $jenisPendaftaranValidation->setType(DataValidation::TYPE_LIST);
        $jenisPendaftaranValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
        $jenisPendaftaranValidation->setAllowBlank(true);
        $jenisPendaftaranValidation->setShowDropDown(true);
        $jenisPendaftaranValidation->setFormula1('"' . implode(',', $jenisPendaftaranList) . '"');

        foreach (range(4, 500) as $row) {
            $sheet->getCell("J$row")->setDataValidation(clone $jenisPendaftaranValidation);
        }

        // Validasi Email untuk kolom EMAIL (kolom C)
        $emailValidation = new DataValidation();
        $emailValidation->setType(DataValidation::TYPE_CUSTOM);
        $emailValidation->setErrorStyle(DataValidation::STYLE_STOP);
        $emailValidation->setAllowBlank(true);
        $emailValidation->setShowInputMessage(true);
        $emailValidation->setShowErrorMessage(true);
        $emailValidation->setErrorTitle('Input Error');
        $emailValidation->setError('Please enter a valid email address.');
        $emailValidation->setPromptTitle('Allowed Input');
        $emailValidation->setPrompt('Email address should contain @ symbol');
        $emailValidation->setFormula1('=ISNUMBER(FIND("@",C4))');

        foreach (range(4, 500) as $row) {
            $sheet->getCell("C$row")->setDataValidation(clone $emailValidation);
        }

        // Tambahkan Date Picker untuk kolom TGL LAHIR, TGL MASUK, TGL LULUS (kolom F, I, J)
        $dateValidation = new DataValidation();
        $dateValidation->setType(DataValidation::TYPE_DATE);
        $dateValidation->setErrorStyle(DataValidation::STYLE_STOP);
        $dateValidation->setAllowBlank(true);
        $dateValidation->setShowDropDown(true);
        $dateValidation->setShowInputMessage(true);
        $dateValidation->setShowErrorMessage(true);
        $dateValidation->setErrorTitle('Input Error');
        $dateValidation->setError('Please enter a valid date.');
        $dateValidation->setPromptTitle('Allowed Input');
        $dateValidation->setPrompt('Date should be in format DD/MM/YYYY');

        foreach (range(4, 500) as $row) {
            // Validasi untuk TGL LAHIR (kolom F)
            $sheet->getCell("F$row")->setDataValidation(clone $dateValidation);
            // Validasi untuk TGL MASUK (kolom I)
            $sheet->getCell("I$row")->setDataValidation(clone $dateValidation);
        }

        // Tambahkan border ke semua sel yang relevan (header + data)
        $sheet->getStyle('A3:J500')->getBorders()->getAllBorders()->setBorderStyle(StyleBorder::BORDER_THIN);

        // Atur lebar kolom agar sesuai konten
        foreach (range('A', 'J') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Simpan file sementara di storage Laravel
        $fileName = 'Template Import Mahasiswa.xlsx';
        $filePath = Storage::path($fileName);

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        // Kirim file ke browser untuk diunduh
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
