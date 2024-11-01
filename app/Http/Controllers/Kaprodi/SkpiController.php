<?php

namespace App\Http\Controllers\Kaprodi;

use App\Models\Pt;
use App\Models\Skpi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

            $prodi_kaprodi = Auth::user()->kaprodi->program_studi_id;

            $skpi = Skpi::with(['mahasiswa.kegiatan', 'mahasiswa.prodi.jenjangPendidikan'])
                ->whereHas('mahasiswa.prodi', function ($query) use ($prodi_kaprodi) {
                    $query->where('id', $prodi_kaprodi);
                })
                ->latest()
                ->get();

            return DataTables::of($skpi)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->addColumn('nim', function (Skpi $skpi) {
                    return $skpi->mahasiswa->nim ?? 'Tidak ada';
                })
                ->addColumn('nama', function (Skpi $skpi) {
                    return $skpi->mahasiswa->nama ?? 'Tidak ada';
                })
                ->addColumn('no_ijazah', function (Skpi $skpi) {
                    return $skpi->mahasiswa->no_ijazah;
                })
                ->addColumn('status', fn($row) => getStatusColor($row->status))
                ->addColumn('action', function ($row) {
                    $editUrl = route('kaprodi.skpi.edit', $row->id);
                    $cetakSkpi = route('kaprodi.skpi.cetak', $row->id);
                    $showSkpi = route('kaprodi.skpi.show', $row->id); // Adjust this route as needed

                    // Check the validation status
                    if ($row->status === 'validasi') {
                        $actionButtons = '
                            <a href="' . $cetakSkpi . '" class="edit btn btn-light btn-sm"><i class="bi bi-printer"></i></a>
                        ';
                    } else {
                        $actionButtons = '
                            <a href="' . $showSkpi . '" class="edit btn btn-light btn-sm"><i class="bi bi-search"></i></a>
                        ';
                    }

                    return '
                        ' . $actionButtons . '
                        <a href="' . $editUrl . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>';
                })


                ->rawColumns(['action', 'no_ijazah', 'nama', 'nim', 'status'])
                ->make(true);
        }

        return view('kaprodi.pages.skpi.index');
    }

    public function show(Request $request, string $id)
    {
        $mahasiswa = Mahasiswa::all();
        $skpi = Skpi::with('mahasiswa.prodi.jenjangPendidikan')->findOrFail($id);

        // dd($skpi);

        if ($request->ajax()) {
            $kegiatan = $skpi->mahasiswa->kegiatan()->with('kategoriKegiatan')
                ->where('status', 'validasi')
                ->get();

            return DataTables::of($kegiatan)
                ->addIndexColumn()
                ->addColumn('kategori', fn($row) => $row->kategoriKegiatan->nama ?? 'N/A') // Gunakan null coalescing untuk menghindari kesalahan
                ->addColumn('nama', function ($row) {
                    return '<div>' . $row->nama . '</div><div class="small fst-italic text-muted">' . $row->nama_en . '</div>';
                })
                ->addColumn('pencapaian', function ($row) {
                    return '<div>' . $row->pencapaian . '</div><div class="small fst-italic text-muted">tingkat: ' . $row->tingkat . '</div>';
                })
                ->rawColumns(['kategori', 'nama', 'pencapaian'])
                ->make(true);
        }

        return view('kaprodi.pages.skpi.show', compact('mahasiswa', 'skpi'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi input jika diperlukan (opsional)
        $request->validate([
            'status' => 'required|in:validasi,tolak',
        ]);

        // Ambil data skpi berdasarkan ID
        $skpi = Skpi::findOrFail($id);

        // Update status skpi
        $skpi->status = $request->status;

        // Jika status validasi, generate nomor otomatis
        if ($request->status === 'validasi') {
            $skpi->nomor = $this->generateNomor(); // Panggil fungsi untuk mengenerate nomor
        }

        $skpi->save();

        // Cek status dan redirect sesuai kebutuhan
        if ($request->status === 'validasi') {
            return redirect()->route('kaprodi.skpi.index', $skpi->id)->with('success', 'Status SKPI berhasil diperbarui!!! Nomor: ' . $skpi->nomor);
        } elseif ($request->status === 'tolak') {
            return redirect()->route('kaprodi.skpi.index')->with('success', 'SKPI ditolak !!!');
        }
    }

    private function generateNomor()
    {
        // Ambil nomor terakhir dari database
        $lastSkpi = Skpi::orderBy('nomor', 'desc')->first();

        // Ambil bagian nomor yang relevan untuk diincrement
        if ($lastSkpi) {
            // Mengambil bagian angka dari nomor
            preg_match('/\d+/', $lastSkpi->nomor, $matches);
            $nextNomor = isset($matches[0]) ? intval($matches[0]) + 1 : 1;
        } else {
            $nextNomor = 1; // Jika tidak ada, mulai dari 1
        }

        // Format nomor dengan padding 4 digit
        $formattedNomor = sprintf('%04d/SKPI', $nextNomor);

        // Cek apakah nomor sudah ada di database
        while (Skpi::where('nomor', $formattedNomor)->exists()) {
            $nextNomor++;
            $formattedNomor = sprintf('%04d/SKPI', $nextNomor);
        }

        return $formattedNomor; // Kembalikan nomor baru
    }

    public function cetak($id)
    {
        $pt = Pt::where('id', 1)->first();

        // dd($pt);

        // Ambil data SKPI berdasarkan ID
        $skpi = Skpi::with([
            'mahasiswa.prodi.jenjangPendidikan',
            'mahasiswa.kegiatan' => function ($query) {
                $query->where('status', 'validasi');
            }
        ])->find($id);

        if (!$skpi) {
            return redirect()->back()->with('error', 'SKPI not found');
        }

        // dd($skpi);

        // Ambil data yang diperlukan
        $mahasiswa = $skpi->mahasiswa;
        $prodi = $mahasiswa->prodi;
        $cpl = json_decode($prodi->kualifikasi_cpl, true);
        $jenjangPendidikan = $prodi->jenjangPendidikan;
        $kegiatan = $skpi->mahasiswa->kegiatan;

        // dd($cpl);

        return view('kaprodi.pages.skpi.cetak', compact('skpi', 'mahasiswa', 'prodi', 'jenjangPendidikan', 'kegiatan', 'pt', 'cpl'));
    }
}
