<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\KategoriKegiatan;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
                ->addColumn('nim', fn($row) => $row->mahasiswa->nim) // Tampilkan nim mahasiswa
                ->addColumn('mahasiswa', fn($row) => $row->mahasiswa->nama) // Tampilkan nama mahasiswa
                ->addColumn('kategori', fn($row) => $row->kategoriKegiatan->nama) // Tampilkan nama kategori kegiatan
                ->addColumn('status', fn($row) => getStatusColor($row->status)) // Panggil fungsi getStatusColor
                ->addColumn('prodi', fn($row) => ($row->mahasiswa->prodi->nama))
                ->addColumn('pencapaian', function ($row) {
                    return '<div>' . $row->pencapaian . '</div><div class="small fst-italic text-muted">tingkat: ' . $row->tingkat . '</div>';
                })
                ->addColumn('nama', function ($row) {
                    return '<div>' . $row->nama . '</div><div class="small fst-italic text-muted">' . $row->nama_en . '</div>';
                })
                ->addColumn('aksi', function ($row) {
                    $editUrl = route('admin.kegiatan.edit', $row->id);
                    $showUrl = route('admin.kegiatan.show', $row->id);
                    $deleteUrl = route('admin.kegiatan.destroy', $row->id);
                    return '
                    <a href="' . $showUrl . '" class="edit btn btn-light btn-sm"><i class="bi bi-search"></i></a>
                    <a href="' . $editUrl . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </form>';
                })
                ->rawColumns(['aksi', 'sertifikat', 'pencapaian', 'nim', 'status', 'nama']) // Merender HTML
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
        // $kategori = KategoriKegiatan::all();

        // return view('admin.pages.kegiatan.create', [
        //     'kategori' => $kategori
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'kategori_kegiatan_id' => 'required',
        //     'nama' => 'required',
        //     'tingkat' => 'required',
        //     'pencapaian' => 'required',
        //     'bobot' => 'required',
        // ], [
        //     'kategori_kegiatan_id.required' => 'Kategori Wajib Dipilih',
        //     'nama.required' => 'Nama kegiatan wajib diisi',
        //     'tingkat.required' => 'Tingkat kegiatan wajib diisi',
        //     'pencapaian.required' => 'pencapaian wajib diisi',
        //     'bobot.required' => 'Bobot wajib diisi',

        // ]);

        // $kegiatan = [
        //     'kategori_kegiatan_id' => $request->kategori_kegiatan_id,
        //     'nama' => $request->nama,
        //     'tingkat' => $request->tingkat,
        //     'pencapaian' => $request->pencapaian,
        //     'bobot' => $request->bobot,

        // ];

        // Kegiatan::create($kegiatan);

        // return redirect()->route('admin.kegiatan.index')->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = KategoriKegiatan::all();

        $kegiatan = Kegiatan::with('kategoriKegiatan')->findOrFail($id);

        // dd($kegiatan);

        return view('admin.pages.kegiatan.show', [
            'kategoriKegiatan' => $kategori,
            'kegiatan' => $kegiatan
        ]);
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
        // dd($request->all());

        $request->validate([
            'kategori_kegiatan_id' => 'required',
            'nama' => 'required',
            'nama_en' => 'required',
            'pencapaian' => 'required',
            'tingkat' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'file_sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $kegiatan = Kegiatan::find($id);

        if (!$kegiatan) {
            return redirect()->route('admin.kegiatan.index')->with('error', 'Kegiatan tidak ditemukan');
        }

        $kegiatan->kategori_kegiatan_id = $request->kategori_kegiatan_id;
        $kegiatan->nama = $request->nama;
        $kegiatan->nama_en = $request->nama_en;
        $kegiatan->tingkat = $request->tingkat;
        $kegiatan->tgl_mulai = $request->tgl_mulai;
        $kegiatan->tgl_selesai = $request->tgl_selesai;
        $kegiatan->penyelenggara = $request->penyelenggara;
        $kegiatan->deskripsi = $request->deskripsi;
        $kegiatan->pencapaian = $request->pencapaian;
        $kegiatan->catatan_status = $request->catatan_status;

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

        // dd($kegiatan);

        $kegiatan->save();

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

    public function updateStatus(Request $request, $id)
    {
        // Validasi input jika diperlukan (opsional)
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
        ]);

        // Ambil data kegiatan berdasarkan ID
        $kegiatan = Kegiatan::findOrFail($id);

        // Update status kegiatan
        $kegiatan->status = $request->status;

        // dd($kegiatan);

        $kegiatan->save();

        // Kirim pesan sukses dan redirect kembali
        return redirect()->route('admin.kegiatan.edit', $kegiatan->id)->with('success', 'Status kegiatan berhasil diperbarui!');
    }
}
