<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skpi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\ProgramStudi;
use App\Models\Pt;

class SkpiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Mengambil data mahasiswa dengan relasi ke skpi, program studi, dan jenjang pendidikan
            $data = Mahasiswa::with(['skpi', 'prodi.jenjangPendidikan'])->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->addColumn('prodi', function (Mahasiswa $mahasiswa) {
                    return $mahasiswa->prodi->nama;
                })
                ->addColumn('jenjang_pendidikan', function (Mahasiswa $mahasiswa) {
                    return $mahasiswa->prodi->jenjangPendidikan->nama ?? 'Tidak ada';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.skpi.edit', $row->id);
                    $deleteUrl = route('admin.mahasiswa.destroy', $row->id);
                    $cetakSkpi = route('admin.skpi.cetak', $row->id);
                    return '
                    <a href="' . $cetakSkpi . '" class="edit btn btn-light btn-sm"><i class="bi bi-printer"></i></a>
                    <a href="' . $editUrl . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <form id="deleteForm-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $row->id . ')"><i class="bi bi-trash"></i></button>
                    </form>';
                })
                ->rawColumns(['action', 'prodi'])
                ->make(true);
        }

        return view('admin.pages.skpi.index');
    }

    public function create()
    {
        return view('admin.pages.skpi.create');
    }

    public function show($id)
    {
        // Ambil data skpi berdasarkan id
        $skpi = Skpi::with(['mahasiswa.prodi.jenjangPendidikan'])->find($id);

        // dd($skpi);

        if (!$skpi) {
            return response()->json(['message' => 'SKPI not found'], 404);
        }

        // Ambil jenjang pendidikan dari program studi
        $jenjangPendidikan = $skpi->mahasiswa->prodi->jenjangPendidikan->nama ?? 'Jenjang pendidikan tidak ditemukan';

        return response()->json([
            'jenjang_pendidikan' => $jenjangPendidikan,
            'mahasiswa' => $skpi->mahasiswa->nama,
            'program_studi' => $skpi->mahasiswa->prodi->nama,
        ]);
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

        // dd($cpl[0]['subs']);

        $jenjangPendidikan = $prodi->jenjangPendidikan;
        $kegiatan = $skpi->mahasiswa->kegiatan;

        return view('admin.pages.skpi.show', compact('skpi', 'mahasiswa', 'prodi', 'jenjangPendidikan', 'kegiatan', 'pt', 'cpl'));
    }

    // public function show($id)
    // {


    //     // $kegiatan = Kegiatan::leftJoin('mahasiswa', 'kegiatan.mahasiswa_id', '=', 'mahasiswa.id')
    //     //     ->leftJoin('program_studi', 'mahasiswa.program_studi_id', '=', 'program_studi.id')
    //     //     ->where('kegiatan.id', $id) // Filter by id_kegiatan
    //     //     ->select('kegiatan.*', 'mahasiswa.*', 'program_studi.*') // Select the desired columns
    //     //     ->orderBy('kegiatan.created_at', 'desc')
    //     //     ->get();

    //     // // dd($kegiatan[0]->mahasiswa_id); // This will now work


    //     // // Check if the collection is not empty before accessing kualifikasi_cpl
    //     // if ($kegiatan->isNotEmpty()) {
    //     //     // Ambil nama mahasiswa dan nama program studi
    //     //     $namaMhs = $kegiatan[0]->mahasiswa->nama ?? 'Nama tidak ditemukan';
    //     //     $jenisPendaftaran = $kegiatan[0]->mahasiswa->jenis_pendaftaran ?? 'Nama tidak ditemukan';
    //     //     $jenisPendaftaranEN = $kegiatan[0]->mahasiswa->jenis_pendaftaran_en ?? 'Nama tidak ditemukan';
    //     //     $tempatLahir = $kegiatan[0]->mahasiswa->tempat_lahir ?? 'Nama tidak ditemukan';
    //     //     $tglLahir = $kegiatan[0]->mahasiswa->tgl_lahir ?? 'Nama tidak ditemukan';
    //     //     $jenisPendaftaranEN = $kegiatan[0]->mahasiswa->jenis_pendaftaran_en ?? 'Nama tidak ditemukan';
    //     //     $noIjazah = $kegiatan[0]->mahasiswa->no_ijazah ?? 'Nama tidak ditemukan';
    //     //     $nim = $kegiatan[0]->mahasiswa->nim ?? 'Nama tidak ditemukan';
    //     //     $tglMasukMhs = $kegiatan[0]->mahasiswa->tgl_masuk ?? 'Nama tidak ditemukan';
    //     //     $tglLulusMhs = $kegiatan[0]->mahasiswa->tgl_lulus ?? 'Nama tidak ditemukan';
    //     //     $gelar = ProgramStudi::where('id', $kegiatan[0]->mahasiswa->program_studi_id)
    //     //     ->pluck('gelar') // Ambil hanya kolom 'name'
    //     //     ->first();
    //     //     $gelarEN = ProgramStudi::where('id', $kegiatan[0]->mahasiswa->program_studi_id)
    //     //     ->pluck('gelar_en') // Ambil hanya kolom 'name'
    //     //     ->first();

    //     //     // Decode the kualifikasi_cpl JSON
    //     //     $kualifikasiCpl = json_decode($kegiatan[0]->kualifikasi_cpl, true);

    //     //     // Access the judul directly
    //     //     $judul = $kualifikasiCpl[0]['judul'] ?? null; // Use null coalescing to avoid errors if it doesn't exist


    //     //     // Output the judul
    //     //     // dd($judul, $namaMhs);
    //     // } else {
    //     //     // dd('No kegiatan found');
    //     // }
    //     // $allKegiatan = Kegiatan::where('mahasiswa_id', $kegiatan[0]->mahasiswa_id)->get();

    //     // return view('admin.pages.skpi.show', [
    //     //     'judul' => $judul,
    //     //     'allKegiatan' => $allKegiatan,
    //     //     'gelar' => $gelar,
    //     //     'namaMhs' => $namaMhs,
    //     //     'jenisPendaftaran' => $jenisPendaftaran,
    //     //     'jenisPendaftaranEN' => $jenisPendaftaranEN,
    //     //     'tempatLahir' => $tempatLahir,
    //     //     'tglLahir' => $tglLahir,
    //     //     'noIjazah' => $noIjazah,
    //     //     'nim' => $nim,
    //     //     'gelar' => $gelar,
    //     //     'gelarEN' => $gelarEN,
    //     //     'jenisPendaftaranEN' => $jenisPendaftaranEN,
    //     //     'tglMasukMhs' => $tglMasukMhs,
    //     //     'tglLulusMhs' => $tglLulusMhs,
    //     // ]);
    // }
}
