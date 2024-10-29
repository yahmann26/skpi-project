<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Skpi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class SkpiController extends Controller
{
    public function index(Request $request)
    {
        // Fungsi untuk mendapatkan warna status
        if (!function_exists('getStatusColor')) {
            function getStatusColor($status)
            {
                $status = strtolower($status);
                switch ($status) {
                    case 'pengajuan':
                        return '<span class="badge bg-warning">Pengajuan</span>';
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
            // Ambil data skpi untuk mahasiswa yang sedang login
            $skpi = Skpi::where('mahasiswa_id', Auth::user()->mahasiswa->id)
                ->select('skpi.*')
                ->get();

            return DataTables::of($skpi)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $editUrl = route('mahasiswa.kegiatan.edit', $row->id);
                    $deleteUrl = route('mahasiswa.kegiatan.destroy', $row->id);
                    return '
                        <a href="' . $editUrl . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                        <form id="deleteForm-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $row->id . ')"><i class="bi bi-trash"></i></button>
                        </form>';
                })
                ->addColumn('status', fn($row) => getStatusColor($row->status))
                ->addColumn('mhs', fn($row) => $row->mahasiswa->nama)
                ->rawColumns(['aksi', 'status'])
                ->make(true);
        }

        return view('mahasiswa.pages.skpi.index');
    }

    public function create() {

    }
}
