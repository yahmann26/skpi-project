<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\KategoriKegiatan;

class KegiatanController extends Controller
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
                    case 'diproses':
                        return '<span class="badge bg-warning">Diproses</span>';
                    case 'ditolak':
                        return '<span class="badge bg-danger">Ditolak</span>';
                    case 'diterima':
                        return '<span class="badge bg-success">Diterima</span>';
                    default:
                        return '<span class="badge bg-secondary">Tidak diketahui</span>';
                }
            }
        }

        // Jika request adalah AJAX (untuk datatables)
        if ($request->ajax()) {
            // Ambil data kegiatan semua mahasiswa dengan relasi kategoriKegiatan dan mahasiswa
            $kegiatan = Kegiatan::with(['kategoriKegiatan', 'mahasiswa'])->select('kegiatan.*')->orderBy('created_at', 'desc')->get();

            return DataTables::of($kegiatan)
                ->addIndexColumn()
                ->addColumn('mahasiswa', fn($row) => $row->mahasiswa->nama) // Tampilkan nama mahasiswa
                ->addColumn('kategori', fn($row) => $row->kategoriKegiatan->nama) // Tampilkan nama kategori kegiatan
                ->addColumn('aksi', function ($row) {
                    $editBtn = '<a href="' . route('admin.kegiatan.edit', $row->id) . '" class="btn btn-sm btn-light text-primary"><i class="bi bi-pencil"></i></a>';
                    $deleteBtn = '<button type="button" class="btn btn-sm btn-light text-danger" data-bs-toggle="modal" data-id="' . $row->id . '" data-bs-target="#hapusModal"><i class="bi bi-trash"></i></button>';

                    return $editBtn . ' ' . $deleteBtn;
                })
                ->addColumn('sertifikat', function ($row) {
                    return $row->file_sertifikat
                        ? '<button type="button" class="btn btn-sm btn-success preview-file" data-bs-toggle="modal" data-bs-target="#previewModal" data-url="' . $row->file_sertifikat_url . '" data-type="' . pathinfo($row->file_sertifikat_url, PATHINFO_EXTENSION) . '"><i class="bi bi-file-earmark"></i> Lihat</button>'
                        : '<span class="badge bg-secondary">Tidak ada</span>';
                })
                ->addColumn('status', fn($row) => getStatusColor($row->status)) // Panggil fungsi getStatusColor
                ->addColumn('prodi', fn($row) => ($row->mahasiswa->prodi->nama))
                ->addColumn('pencapaian', function ($row) {
                    return '<div>' . $row->jabatan . '</div><div class="small fst-italic text-muted">tingkat: ' . $row->tingkat . '</div>';
                })
                ->addColumn('nama', function ($row) {
                    return '<div>' . $row->nama . '</div><div class="small fst-italic text-muted">' . $row->nama_en . '</div>';
                })
                ->addColumn('penyelenggara', function ($row) {
                    return '<div>' . $row->penyelenggara . '</div><div class="small fst-italic text-muted">di: ' . $row->tingkat . '</div>';
                })
                ->rawColumns(['aksi', 'sertifikat', 'pencapaian', 'penyelenggara', 'status', 'nama']) // Merender HTML
                ->make(true);
        }

        // Render view halaman admin untuk pengajuan kegiatan mahasiswa
        return view('admin.pages.kegiatan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriKegiatan::all();

        return view('admin.pages.kegiatan.create', [
            'kategori' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_kegiatan_id' => 'required',
            'nama' => 'required',
            'tingkat' => 'required',
            'jabatan' => 'required',
            'bobot' => 'required',
        ], [
            'kategori_kegiatan_id.required' => 'Kategori Wajib Dipilih',
            'nama.required' => 'Nama kegiatan wajib diisi',
            'tingkat.required' => 'Tingkat kegiatan wajib diisi',
            'jabatan.required' => 'Jabatan wajib diisi',
            'bobot.required' => 'Bobot wajib diisi',

        ]);

        $kegiatan = [
            'kategori_kegiatan_id' => $request->kategori_kegiatan_id,
            'nama' => $request->nama,
            'tingkat' => $request->tingkat,
            'jabatan' => $request->jabatan,
            'bobot' => $request->bobot,

        ];

        Kegiatan::create($kegiatan);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Berhasil Menambahkan Data');
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
        // get kategori Kegiatan
        $kategori = KategoriKegiatan::all();

        $kegiatan = Kegiatan::with('kategoriKegiatan')->find($id);

        return  view('admin.pages.kegiatan.edit', [
            'kategori' => $kategori,
            'kegiatan' => $kegiatan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kegiatan = Kegiatan::with('kategoriKegiatan')->find($id);

        $request->validate([
            'nama' => 'required',
            'tingkat' => 'required',
            'jabatan' => 'required',
            'bobot' => 'required',
        ], [
            'nama.required' => 'Nama Kegiatan wajib diisi',
            'tingkat.required' => 'Tingkat Kegiatan wajib diisi',
            'jabatan.required' => 'TJabatan wajib diisi',
            'bobot.required' => 'Bobot Masuk wajib diisi',
        ]);

        $kegiatan = [
            'nama' => $request->nama,
            'tingkat' => $request->tingkat,
            'jabatan' => $request->jabatan,
            'bobot' => $request->bobot,
        ];

        kegiatan::where('id', $id)->update($kegiatan);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Berhasil Mengupdate Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kegiatan::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
