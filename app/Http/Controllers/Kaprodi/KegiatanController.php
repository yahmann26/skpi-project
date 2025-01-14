<?php

namespace App\Http\Controllers\Kaprodi;

use App\Models\Kegiatan;
use App\Models\Semester;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Models\KategoriKegiatan;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
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
        // Jika request adalah AJAX (untuk datatables)
        if ($request->ajax()) {
            $kegiatan = Kegiatan::with(['kategoriKegiatan', 'mahasiswa'])->select('kegiatan.*')->orderBy('created_at', 'desc')->get();


            return DataTables::of($kegiatan)
                ->addIndexColumn()
                ->addColumn('nim', fn($row) => $row->mahasiswa->nim)
                ->addColumn('mahasiswa', fn($row) => $row->mahasiswa->nama)
                ->addColumn('kategori', fn($row) => $row->kategoriKegiatan->nama)
                ->addColumn('status', fn($row) => getStatusColor($row->status))
                ->addColumn('prodi', fn($row) => ($row->mahasiswa->prodi->nama))
                ->addColumn('pencapaian', function ($row) {
                    return '<div>' . $row->pencapaian . '</div><div class="small fst-italic text-muted">tingkat: ' . $row->tingkat . '</div>';
                })
                ->addColumn('nama', function ($row) {
                    return '<div>' . $row->nama . '</div><div class="small fst-italic text-muted">' . $row->nama_en . '</div>';
                })
                ->addColumn('tgl', function ($row) {
                    $tglSelesaiFormatted = \Carbon\Carbon::parse($row->tgl_selesai)->format('d-m-Y');

                    return '<div>' . $tglSelesaiFormatted . '</div>';
                })
                ->addColumn('aksi', function ($row) {
                    $editUrl = route('kaprodi.kegiatan.edit', $row->id);
                    $showUrl = route('kaprodi.kegiatan.show', $row->id);
                    $deleteUrl = route('kaprodi.kegiatan.destroy', $row->id);

                    // Check the validation status
                    if ($row->status === 'diproses') {
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
                ->rawColumns(['aksi', 'sertifikat', 'pencapaian', 'nim', 'status', 'nama', 'tgl'])
                ->make(true);
        }

        // Render view halaman kaprodi untuk pengajuan kegiatan mahasiswa
        return view('kaprodi.pages.kegiatan.index');
    }

    public function getTahunAkademikBySemester($semesterId)
    {
        $tahunAkademik = TahunAkademik::where('semester_id', $semesterId)->get(['id', 'nama']);
        return response()->json($tahunAkademik);
    }

    public function show(string $id)
    {
        $kategori = KategoriKegiatan::all();
        $tahunAkademik = TahunAkademik::all();

        $kegiatan = Kegiatan::with('kategoriKegiatan')->findOrFail($id);

        // dd($kegiatan);

        return view('kaprodi.pages.kegiatan.show', [
            'kategori' => $kategori,
            'kegiatan' => $kegiatan,
            'tahunAkademik' => $tahunAkademik,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = KategoriKegiatan::all();
        $semester = Semester::all();

        $kegiatan = Kegiatan::with('tahunAkademik.semester', 'kategoriKegiatan')->find($id);

        return  view('kaprodi.pages.kegiatan.edit', [
            'kategori' => $kategori,
            'kegiatan' => $kegiatan,
            'semester' => $semester,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tahun_akademik_id' => 'required',
            'kategori_kegiatan_id' => 'required',
            'nama' => 'required',
            'nama_en' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'file_sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $kegiatan = Kegiatan::find($id);

        if (!$kegiatan) {
            return redirect()->route('kaprodi.kegiatan.index')->with('error', 'Kegiatan tidak ditemukan');
        }

        $kegiatan->tahun_akademik_id = $request->tahun_akademik_id;
        $kegiatan->kategori_kegiatan_id = $request->kategori_kegiatan_id;
        $kegiatan->nama = $request->nama;
        $kegiatan->nama_en = $request->nama_en;
        $kegiatan->tgl_mulai = $request->tgl_mulai;
        $kegiatan->tgl_selesai = $request->tgl_selesai;
        $kegiatan->penyelenggara = $request->penyelenggara;
        $kegiatan->deskripsi = $request->deskripsi;
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

        return redirect()->route('kaprodi.kegiatan.index')->with('success', 'Berhasil Mengupdate Data');
    }

    public function destroy(string $id)
    {
        Kegiatan::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:validasi,tolak',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->tahun_akademik_id = $request->tahun_akademik_id;
        $kegiatan->kategori_kegiatan_id = $request->kategori_kegiatan_id;
        $kegiatan->nama = $request->nama;
        $kegiatan->nama_en = $request->nama_en;
        $kegiatan->tgl_mulai = $request->tgl_mulai;
        $kegiatan->tgl_selesai = $request->tgl_selesai;
        $kegiatan->penyelenggara = $request->penyelenggara;
        $kegiatan->catatan_status = $request->catatan_status;
        $kegiatan->status = $request->status;

        // dd($kegiatan);

        $kegiatan->save();

        // Cek status dan redirect sesuai kebutuhan
        if ($request->status === 'validasi') {
            return redirect()->route('kaprodi.kegiatan.index', $kegiatan->id)->with('success', 'Status kegiatan berhasil diperbarui!');
        } elseif ($request->status === 'tolak') {
            return redirect()->route('kaprodi.kegiatan.index')->with('success', 'Kegiatan telah ditolak.');
        }
    }

    public function cetak()
    {
        $semester = Semester::all();
        return view('kaprodi.pages.kegiatan.cetak', compact('semester'));
    }

    public function cetakSemester(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string|exists:mahasiswa,nim',
            'semester_id' => 'required|exists:semester,id',
            'tahun_akademik_id' => 'required|exists:tahun_akademik,id',
        ]);

        $mahasiswa = Mahasiswa::where('nim', $validated['nim'])->firstOrFail();

        $semester = Semester::findOrFail($validated['semester_id']);
        $tahunAkademik = TahunAkademik::findOrFail($validated['tahun_akademik_id']);

        $kegiatans = Kegiatan::with('kategoriKegiatan')
            ->where('tahun_akademik_id', $tahunAkademik->id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'validasi')
            ->get();

        $prodi = $mahasiswa->prodi;
        $kaprodi = $prodi ? $prodi->kaprodi : null;
        $kategori = $kegiatans->groupBy('kategoriKegiatan.nama')
            ->sortBy(fn($kegiatan, $key) => $kegiatan->first()->kategoriKegiatan->id);

        $imagePath = public_path('images/unsiq.png');
        $logoUniv = file_exists($imagePath) ? base64_encode(file_get_contents($imagePath)) : null;
        if (!$logoUniv) {
            return back()->withErrors(['logo' => 'Logo universitas tidak ditemukan.']);
        }

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
            'website' => $website,
            'fax' => $fax,
        ];

        // Buat PDF menggunakan mPDF
        $mpdf = new \Mpdf\Mpdf([
            'setAutoTopMargin' => 'stretch',
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
        ]);

        $html = view('kaprodi.pages.kegiatan.cetakSemester', $data)->render();
        $mpdf->WriteHTML($html);

        // Tampilkan PDF
        $mpdf->Output();
    }


    public function cetakTranskip(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string',
        ]);

        // Cari mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $validated['nim'])->first();

        // Ambil data kegiatan mahasiswa yang sudah divalidasi
        $kegiatans = Kegiatan::where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'validasi')
            ->get();

        $tahunAkademik = $kegiatans->groupBy('tahunAkademik.nama');
        $semester = $kegiatans->groupBy('tahunAkademik.semester.nama');
        $kategori = $kegiatans->groupBy('kategoriKegiatan.nama')
            ->sortBy(function ($kegiatan, $key) {
                return $kegiatan->first()->kategoriKegiatan->id;
            });

        // Ambil data prodi dan kaprodi
        $prodi = $mahasiswa->prodi;
        $kaprodi = $prodi ? $prodi->kaprodi : null;

        $imagePath = public_path('images/unsiq.png');
        if (!file_exists($imagePath)) {
            return back()->withErrors(['logo' => 'Logo universitas tidak ditemukan.']);
        }
        $logoUniv = base64_encode(file_get_contents($imagePath));

        $alamat = HelperSkpi::getSettingByName('alamat_universitas');
        $telp = HelperSkpi::getSettingByName('telepon_universitas');
        $email = HelperSkpi::getSettingByName('email_universitas');
        $website = HelperSkpi::getSettingByName('website');
        $fax = HelperSKPi::getSettingByName('fax');

        // Siapkan data untuk dikirim ke view
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
            'website' => $website,
            'fax' => $fax,
        ];

        $mpdf = new \Mpdf\Mpdf([
            'setAutoTopMargin' => 'stretch',
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
        ]);

        $html = view('kaprodi.pages.kegiatan.cetakTranskip', $data)->render();
        $mpdf->WriteHTML($html);

        $mpdf->Output();
    }
}
