<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\KategoriKegiatan;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
                ->addColumn('pencapaian', function ($row) {
                    return '<div>' . $row->pencapaian . '</div><div class="small text-muted">tingkat: ' . $row->tingkat . '</div>';
                })
                ->rawColumns(['aksi', 'sertifikat', 'pencapaian', 'nama', 'status'])
                ->make(true);
        }

        return view('mahasiswa.pages.kegiatan.index');
    }

    public function create()
    {
        $kategori = KategoriKegiatan::all();

        return view('mahasiswa.pages.kegiatan.create', [
            'kategori' => $kategori
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_kegiatan_id' => 'required|exists:kategori_kegiatan,id',
            'nama' => 'required',
            'nama_en' => 'required',
            'tingkat' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'penyelenggara' => 'required',
            'deskripsi' => 'required',
            'pencapaian' => 'required',
            'file_sertifikat' => 'required_if:sertifikat_option,file|nullable|file|mimes:pdf,jpg,jpeg,png|max:3072',
        ], [
            'kategori_kegiatan_id.required' => 'Kategori Kegiatan Wajib Dipilih',
            'nama.required' => 'Nama kegiatan harus diisi',
            'nama_en.required' => 'Nama kegiatan harus diisi',
            'tingkat.required' => 'Tingkat kegiatan harus diisi',
            'tgl_mulai.required' => 'Tanggal Mulai kegiatan harus diisi',
            'tgl_selesai.required' => 'Tanggal Selesai kegiatan harus diisi',
            'penyelenggara.required' => 'Penyelenggara kegiatan harus diisi',
            'deskripsi.required' => 'deskripsi kegiatan harus diisi',
            'pencapaian.required' => 'pencapaian harus diisi',
            'file_sertifikat.required_if' => 'File sertifikat kegiatan harus diisi jika opsi \'file\' dipilih',
            'file_sertifikat.file' => 'File sertifikat kegiatan tidak valid',
            'file_sertifikat.mimes' => 'File sertifikat kegiatan harus berupa file PDF, JPG, JPEG, PNG',
            'file_sertifikat.max' => 'File sertifikat kegiatan maksimal 3 MB (3000 KB)',
        ]);

        $kegiatan = new kegiatan();
        $kegiatan->mahasiswa_id = Auth::user()->mahasiswa->id;
        $kegiatan->kategori_kegiatan_id = $request->kategori_kegiatan_id;
        $kegiatan->nama = $request->nama;
        $kegiatan->nama_en = $request->nama_en;
        $kegiatan->tingkat = $request->tingkat;
        $kegiatan->tgl_mulai = $request->tgl_mulai;
        $kegiatan->tgl_selesai = $request->tgl_selesai;
        $kegiatan->penyelenggara = $request->penyelenggara;
        $kegiatan->deskripsi = $request->deskripsi;
        $kegiatan->pencapaian = $request->pencapaian;

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

        $kegiatan = Kegiatan::with('kategoriKegiatan')->find($id);

        return  view('mahasiswa.pages.kegiatan.edit', [
            'kategori' => $kategori,
            'kegiatan' => $kegiatan
        ]);
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'kategori_kegiatan_id' => 'required|exists:kategori_kegiatan,id',
            'nama' => 'required',
            'nama_en' => 'required',
            'tingkat' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'penyelenggara' => 'required',
            'deskripsi' => 'required',
            'pencapaian' => 'required',
            'file_sertifikat' => 'required_if:sertifikat_option,file|nullable|file|mimes:pdf,jpg,jpeg,png|max:1024',
        ], [
            'kategori_kegiatan_id.required' => 'Kategori Kegiatan Wajib Dipilih',
            'nama.required' => 'Nama kegiatan harus diisi',
            'nama_en.required' => 'Nama kegiatan harus diisi',
            'tingkat.required' => 'Tingkat kegiatan harus diisi',
            'tgl_mulai.required' => 'Tanggal Mulai kegiatan harus diisi',
            'tgl_selesai.required' => 'Tanggal Selesai kegiatan harus diisi',
            'penyelenggara.required' => 'Penyelenggara kegiatan harus diisi',
            'deskripsi.required' => 'deskripsi kegiatan harus diisi',
            'pencapaian.required' => 'pencapaian harus diisi',
            'file_sertifikat.required_if' => 'File sertifikat kegiatan harus diisi jika opsi \'file\' dipilih',
            'file_sertifikat.file' => 'File sertifikat kegiatan tidak valid',
            'file_sertifikat.mimes' => 'File sertifikat kegiatan harus berupa file PDF, JPG, JPEG, PNG',
            'file_sertifikat.max' => 'File sertifikat kegiatan maksimal 1 MB (1024 KB)',
        ]);

        $kegiatan->kategori_kegiatan_id = $request->kategori_kegiatan_id;
        $kegiatan->nama = $request->nama;
        $kegiatan->nama_en = $request->nama_en;
        $kegiatan->tingkat = $request->tingkat;
        $kegiatan->tgl_mulai = $request->tgl_mulai;
        $kegiatan->tgl_selesai = $request->tgl_selesai;
        $kegiatan->penyelenggara = $request->penyelenggara;
        $kegiatan->deskripsi = $request->deskripsi;
        $kegiatan->pencapaian = $request->pencapaian;

        // Mengelola upload file sertifikat jika ada file baru
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
        // find kegiatan
        $kegiatan = Kegiatan::findOrFail($id);

        // menghapus file
        $file = $kegiatan->file_sertifikat;

        if ($file && $file != '') {
            if (Storage::exists('public/' . $file)) {
                Storage::delete('public/' . $file);
            }
        }

        // menghapus kegiatan
        $kegiatan->delete();

        return redirect()->route('mahasiswa.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus');
    }
}
