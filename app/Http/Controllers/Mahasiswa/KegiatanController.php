<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\KategoriKegiatan;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Helper\Skpi as  HelperSkpi;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        // Fungsi untuk mendapatkan warna status
        if (!function_exists('getStatusColor')) {
            function getStatusColor($status)
            {
                $status = strtolower($status);
                switch ($status) {
                    case 'diproses':
                        return '<span class="badge bg-warning">Diproses</span>';
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
            // Ambil data kegiatan untuk mahasiswa yang sedang login
            $kegiatan = Kegiatan::where('mahasiswa_id', Auth::user()->mahasiswa->id)
                ->with('kategoriKegiatan')
                ->select('kegiatan.*')->orderBy('created_at', 'desc')
                ->get();

            return DataTables::of($kegiatan)
                ->addIndexColumn()
                ->addColumn('kategori', fn($row) => $row->kategoriKegiatan->nama)
                ->addColumn('aksi', function ($row) {
                    $editUrl = route('mahasiswa.kegiatan.edit', $row->id);
                    $deleteUrl = route('mahasiswa.kegiatan.destroy', $row->id);
                    $showUrl = route('mahasiswa.kegiatan.show', $row->id);

                    // Check the validation status
                    if ($row->status === 'validasi' || $row->status === 'tolak') {
                        $actionButtons = '
                            <a href="' . $showUrl . '" class="edit btn btn-warning btn-sm"><i class="bi bi-search"></i></a>
                        ';
                    } else {
                        $actionButtons = '
                            <a href="' . $editUrl . '" class="edit btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                        ';
                    }

                    return '
                        ' . $actionButtons . '
                        <form id="deleteForm-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $row->id . ')"><i class="bi bi-trash"></i></button>
                        </form>';
                })
                ->addColumn('sertifikat', function ($row) {
                    return $row->file_sertifikat
                        ? '<button type="button" class="btn btn-sm btn-success open-file" data-url="' . asset('storage/' . $row->file_sertifikat) . '" data-type="' . pathinfo($row->file_sertifikat, PATHINFO_EXTENSION) . '"><i class="bi bi-file-earmark"></i> Lihat </button>'
                        : '<span class="badge bg-secondary">Tidak ada</span>';
                })
                ->addColumn('status', fn($row) => getStatusColor($row->status))
                ->addColumn('nama', function ($row) {
                    return '<div>' . $row->nama . '</div><div class="fst-italic text-muted">' . $row->nama_en . '</div>';
                })
                ->rawColumns(['aksi', 'sertifikat', 'pencapaian', 'nama', 'status'])
                ->make(true);
        }

        return view('mahasiswa.pages.kegiatan.index');
    }

    public function create()
    {
        $kategori = KategoriKegiatan::all();
        $semester = Semester::all();

        // dd($kategori);

        return view('mahasiswa.pages.kegiatan.create', [
            'kategori' => $kategori,
            'semester' => $semester,
        ]);
    }

    public function getTahunAkademikBySemester($semester_id)
    {
        $tahunAkademik = TahunAkademik::where('semester_id', $semester_id)->get();

        if ($tahunAkademik->isEmpty()) {
            return response()->json(['message' => 'Tidak ada Tahun Akademik untuk semester ini'], 404);
        }

        return response()->json($tahunAkademik);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_akademik_id' => 'required|exists:tahun_akademik,id',
            'kategori_kegiatan_id' => 'required|exists:kategori_kegiatan,id',
            'nama' => 'required',
            'nama_en' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'deskripsi' => 'required',
            'file_sertifikat' => 'required_if:sertifikat_option,file|nullable|file|mimes:pdf,jpg,jpeg,png|max:3072',
        ], [
            'kategori_kegiatan_id.required' => 'Kategori Kegiatan Wajib Dipilih',
            'nama.required' => 'Nama kegiatan harus diisi',
            'nama_en.required' => 'Nama kegiatan harus diisi',
            'tgl_mulai.required' => 'Tanggal Mulai kegiatan harus diisi',
            'tgl_selesai.required' => 'Tanggal Selesai kegiatan harus diisi',
            'penyelenggara.required' => 'Penyelenggara kegiatan harus diisi',
            'deskripsi.required' => 'deskripsi kegiatan harus diisi',
            'file_sertifikat.required_if' => 'File sertifikat kegiatan harus diisi jika opsi \'file\' dipilih',
            'file_sertifikat.file' => 'File sertifikat kegiatan tidak valid',
            'file_sertifikat.mimes' => 'File sertifikat kegiatan harus berupa file PDF, JPG, JPEG, PNG',
            'file_sertifikat.max' => 'File sertifikat kegiatan maksimal 3 MB (3000 KB)',
        ]);

        $kegiatan = new kegiatan();
        $kegiatan->mahasiswa_id = Auth::user()->mahasiswa->id;
        $kegiatan->tahun_akademik_id = $request->tahun_akademik_id;
        $kegiatan->kategori_kegiatan_id = $request->kategori_kegiatan_id;
        $kegiatan->nama = $request->nama;
        $kegiatan->nama_en = $request->nama_en;
        $kegiatan->tgl_mulai = $request->tgl_mulai;
        $kegiatan->tgl_selesai = $request->tgl_selesai;
        $kegiatan->penyelenggara = $request->penyelenggara;
        $kegiatan->deskripsi = $request->deskripsi;

        // upload file sertifikat
        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $filePath = $file->storeAs('kegiatan', $fileName, 'public');
            $kegiatan->file_sertifikat = $filePath;
        } else {
            $kegiatan->file_sertifikat = $request->kegiatan_sertifikat_url;
        }

        // dd($kegiatan);

        $kegiatan->save();

        return redirect()->route('mahasiswa.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function show($id)
    {
        $kategori = KategoriKegiatan::all();

        $kegiatan = Kegiatan::with('kategoriKegiatan')->find($id);

        return  view('mahasiswa.pages.kegiatan.show', [
            'kategori' => $kategori,
            'kegiatan' => $kegiatan
        ]);
    }

    public function edit($id)
    {
        // get kategori
        $kategori = KategoriKegiatan::all();
        $semester = Semester::all();

        $kegiatan = Kegiatan::with('tahunAkademik.semester', 'kategoriKegiatan')->find($id);

        return  view('mahasiswa.pages.kegiatan.edit', [
            'kategori' => $kategori,
            'kegiatan' => $kegiatan,
            'semester' => $semester
        ]);
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'tahun_akademik_id' => 'required|exists:tahun_akademik,id',
            'kategori_kegiatan_id' => 'required|exists:kategori_kegiatan,id',
            'nama' => 'required',
            'nama_en' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'penyelenggara' => 'required',
            'deskripsi' => 'required',
            'file_sertifikat' => 'required_if:sertifikat_option,file|nullable|file|mimes:pdf,jpg,jpeg,png|max:1024',
        ], [
            'kategori_kegiatan_id.required' => 'Kategori Kegiatan Wajib Dipilih',
            'nama.required' => 'Nama kegiatan harus diisi',
            'nama_en.required' => 'Nama kegiatan harus diisi',
            'tgl_mulai.required' => 'Tanggal Mulai kegiatan harus diisi',
            'tgl_selesai.required' => 'Tanggal Selesai kegiatan harus diisi',
            'penyelenggara.required' => 'Penyelenggara kegiatan harus diisi',
            'deskripsi.required' => 'deskripsi kegiatan harus diisi',
            'file_sertifikat.required_if' => 'File sertifikat kegiatan harus diisi jika opsi \'file\' dipilih',
            'file_sertifikat.file' => 'File sertifikat kegiatan tidak valid',
            'file_sertifikat.mimes' => 'File sertifikat kegiatan harus berupa file PDF, JPG, JPEG, PNG',
            'file_sertifikat.max' => 'File sertifikat kegiatan maksimal 1 MB (1024 KB)',
        ]);

        $kegiatan->tahun_akademik_id = $request->tahun_akademik_id;
        $kegiatan->kategori_kegiatan_id = $request->kategori_kegiatan_id;
        $kegiatan->nama = $request->nama;
        $kegiatan->nama_en = $request->nama_en;
        $kegiatan->tgl_mulai = $request->tgl_mulai;
        $kegiatan->tgl_selesai = $request->tgl_selesai;
        $kegiatan->penyelenggara = $request->penyelenggara;
        $kegiatan->deskripsi = $request->deskripsi;

        if ($request->hasFile('file_sertifikat')) {
            // Hapus file lama jika perlu
            if ($kegiatan->file_sertifikat) {
                Storage::disk('public')->delete($kegiatan->file_sertifikat);
            }

            // Upload file baru
            $file = $request->file('file_sertifikat');
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $filePath = $file->storeAs('kegiatan', $fileName, 'public');
            $kegiatan->file_sertifikat = $filePath;
        }

        $kegiatan->save();

        return redirect()->route('mahasiswa.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $file = $kegiatan->file_sertifikat;

        if ($file && $file != '') {
            if (Storage::exists('public/' . $file)) {
                Storage::delete('public/' . $file);
            }
        }

        $kegiatan->delete();

        return redirect()->route('mahasiswa.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus');
    }

    public function cetak()
    {
        // $kegiatan = Kegiatan::where('mahasiswa_id', Auth::user()->mahasiswa_id);
        $semester = Semester::all();

        return view('mahasiswa.pages.kegiatan.cetak', compact('semester'));
    }

    public function cetakSemester(Request $request)
    {
        $validated = $request->validate([
           'semester_id' => 'required|exists:semester,id',
            'tahun_akademik_id' => 'required|exists:tahun_akademik,id',
        ]);

        // dd($validated);

        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            return redirect()->back()->withErrors(['mahasiswa' => 'Mahasiswa tidak ditemukan untuk user ini!']);
        }

        // dd($mahasiswa);

        $semester = Semester::findOrFail($validated['semester_id']);
        $tahunAkademik = TahunAkademik::findOrFail($validated['tahun_akademik_id']);

        $kegiatans = Kegiatan::with('kategoriKegiatan')
            ->where('tahun_akademik_id', $tahunAkademik->id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'validasi')
            ->get();


        // dd($kegiatans);

        $prodi = $mahasiswa->prodi;
        $kaprodi = $prodi ? $prodi->kaprodi : null;
        $kategori = $kegiatans->groupBy('kategoriKegiatan.nama');
        $imagePath = public_path('images/unsiq.png');
        $logoUniv = base64_encode(file_get_contents($imagePath));

        $alamat = HelperSkpi::getSettingByName('alamat_universitas');
        $telp = HelperSkpi::getSettingByName('telepon_universitas');
        $email = HelperSkpi::getSettingByName('email_universitas');
        $fax = HelperSkpi::getSettingByName('fax');
        $website = HelperSkpi::getSettingByName('website');

        $data = [
            'mahasiswa' => $mahasiswa,
            'logoUniv' => $logoUniv,
            'alamat' => $alamat,
            'telp' => $telp,
            'email' => $email,
            'kegiatan' => $kegiatans,
            'kategori' => $kategori,
            'tahunAkademik' => $tahunAkademik,
            'prodi' => $prodi,
            'kaprodi' => $kaprodi,
            'semester' => $semester,
            'fax' => $fax,
            'website' => $website
        ];

        $mpdf = new \Mpdf\Mpdf([
            'setAutoTopMargin' => 'stretch',
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
        ]);

        $mpdf->AddPage();
        $html = view('mahasiswa.pages.kegiatan.cetakSemester', $data)->render();
        $mpdf->WriteHTML($html);

        $mpdf->Output();
    }

    public function cetakTranskip(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        // dd($mahasiswa);

        $kegiatans = Kegiatan::where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'validasi')
            ->get();

        // dd($kegiatans);

        $prodi = $mahasiswa->prodi;
        $kaprodi = $prodi ? $prodi->kaprodi : null;
        $tahunAkademik = $kegiatans->groupBy('tahunAkademik');
        $semester = $tahunAkademik->groupBy('semester');
        $kategori = $kegiatans->groupBy('kategoriKegiatan.nama')
        ->sortBy(function ($kegiatan, $key) {
            return $kegiatan->first()->kategoriKegiatan->id;
        });
        $imagePath = public_path('images/unsiq.png');
        $logoUniv = base64_encode(file_get_contents($imagePath));

        $alamat = HelperSkpi::getSettingByName('alamat_universitas');
        $telp = HelperSkpi::getSettingByName('telepon_universitas');
        $email = HelperSkpi::getSettingByName('email_universitas');
        $fax = HelperSkpi::getSettingByName('fax');
        $website = HelperSkpi::getSettingByName('website');

        $data = [
            'mahasiswa' => $mahasiswa,
            'logoUniv' => $logoUniv,
            'alamat' => $alamat,
            'telp' => $telp,
            'email' => $email,
            'kegiatan' => $kegiatans,
            'kategori' => $kategori,
            'tahunAkademik' => $tahunAkademik,
            'semester' => $semester,
            'prodi' => $prodi,
            'kaprodi' => $kaprodi,
            'fax' => $fax,
            'website' => $website
        ];

        $mpdf = new \Mpdf\Mpdf([
            'setAutoTopMargin' => 'stretch',
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
        ]);

        $mpdf->AddPage();
        $html = view('mahasiswa.pages.kegiatan.cetakTranskip', $data)->render();
        $mpdf->WriteHTML($html);

        $mpdf->Output();
    }
}
