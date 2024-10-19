<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

            $prodi_dosen = Auth::user()->dosen->program_studi_id;

            // Ambil data kegiatan semua mahasiswa dengan relasi kategoriKegiatan dan mahasiswa, filter berdasarkan prodi dosen
            $kegiatan = Kegiatan::with(['kategoriKegiatan', 'mahasiswa'])
                ->whereHas('mahasiswa', function ($query) use ($prodi_dosen) {
                    $query->whereHas('prodi', function ($query) use ($prodi_dosen) {
                        $query->where('id', $prodi_dosen);
                    });
                })
                ->select('kegiatan.*')
                ->orderBy('created_at', 'desc')
                ->get();


            return DataTables::of($kegiatan)
                ->addIndexColumn()
                ->addColumn('nim', fn($row) => $row->mahasiswa->nim) // Tampilkan nim mahasiswa
                ->addColumn('mahasiswa', fn($row) => $row->mahasiswa->nama) // Tampilkan nama mahasiswa
                ->addColumn('kategori', fn($row) => $row->kategoriKegiatan->nama) // Tampilkan nama kategori kegiatan
                ->addColumn('status', fn($row) => getStatusColor($row->status)) // Panggil fungsi getStatusColor
                ->addColumn('prodi', fn($row) => ($row->mahasiswa->prodi->nama))
                ->addColumn('pencapaian', function ($row) {
                    return '<div>' . $row->jabatan . '</div><div class="small fst-italic text-muted">tingkat: ' . $row->tingkat . '</div>';
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
        return view('dosen.pages.kegiatan.index');
    }
}
