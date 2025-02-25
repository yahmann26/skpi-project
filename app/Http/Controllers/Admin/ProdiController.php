<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\JenjangPendidikan;
use App\Models\Pengaturan;

class ProdiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProgramStudi::query()->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', fn($row) => '')
                ->addColumn(
                    'nama',
                    fn($row) =>
                    '<div>' . $row->nama . '</div><div class="fst-italic small text-secondary">' . $row->nama_en . '</div>'
                )
                ->addColumn(
                    'gelar',
                    fn($row) =>
                    '<div>' . $row->gelar . '</div><div class="fst-italic small text-secondary">' . $row->gelar_en . '</div>'
                )
                ->addColumn('jenjang', fn($row) => '<div>' . $row->jenjangPendidikan->nama . '</div>
                    <div class="fst-italic small text-secondary">' . $row->jenjangPendidikan->nama_en . '</div>')
                ->addColumn(
                    'jenjang_lanjutan',
                    fn($row) => '<div>' . $row->jenjangPendidikan->jenjang_lanjutan . '</div>
                    <div class="fst-italic small text-secondary">' . $row->jenjangPendidikan->jenjang_lanjutan_en . '</div>'
                )
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.prodi.edit', $row->id);
                    $editKegiatan = route('admin.prodi.edit-kegiatan', $row->id);
                    $editCpl = route('admin.prodi.edit-cpl', $row->id);
                    $deleteUrl = route('admin.prodi.destroy', $row->id);
                    return '
                        <a title="Ubah Kegiatan Default" href="' . $editKegiatan . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                        <a title="Ubah CPL" href="' . $editCpl . '" class="edit btn btn-light text-success fw-bold"><i class="bi bi-pencil-square"></i> CPL</a>
                        <a href="' . $editUrl . '" class="edit btn btn-info btn-sm"><i class="bi bi-pencil-square"></i></a>
                        <form id="deleteForm-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $row->id . ')"><i class="bi bi-trash"></i></button>
                        </form>';
                })
                ->rawColumns(['nama', 'gelar', 'jenjang', 'jenjang_lanjutan', 'action'])
                ->make(true);
        }
        return view('admin.pages.prodi.index');
    }

    public function create()
    {
        $jenjang = JenjangPendidikan::all();

        return view('admin.pages.prodi.create', [
            'jenjang' => $jenjang
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenjang_pendidikan_id' => 'required|exists:jenjang_pendidikan,id',
            'kode_prodi' => 'required|unique:program_studi,kode_prodi',
            'nama' => 'required|unique:program_studi,nama',
            'nama_en' => 'required|unique:program_studi,nama_en',
            'singkatan' => 'required|unique:program_studi,singkatan',
            'bhs_pengantar_kuliah' => 'required',
            'bhs_pengantar_kuliah_en' => 'required',
            'sistem_penilaian' => 'required',
            'sistem_penilaian_en' => 'required',
            'akreditasi' => 'required',
            'sk_akreditasi' => 'required',
            'gelar' => 'required',
            'gelar_en' => 'required',
            'gelar_singkat' => 'required',
        ], [
            'jenjang_pendidikan_id.required' => 'Jenjang Pendidikan Wajib Dipilih',
            'kode_prodi.required' => 'Kode Prodi Harus Diisi',
            'nama.required' => 'Nama Prodi Harus Diisi',
            'nama.unique' => 'Nama Prodi Sudah Ada',
            'nama_en.required' => 'Nama Prodi Harus Diisi',
            'nama_en.unique' => 'Nama Prodi Sudah Ada',
            'bhs_pengantar_kuliah.required' => 'Bahasa Pengantar Kuliah Harus Diisi',
            'bhs_pengantar_kuliah_en.required' => 'Bahasa Pengantar Kuliah Harus Diisi',
            'bhs_pengantar_kuliah.required' => 'Sistem Penilaian Harus Diisi',
            'bhs_pengantar_kuliah_en.required' => 'Sistem Penilaian Harus Diisi',
            'akreditasi.required' => 'Akreditasi Harus Diisi',
            'sk_akreditasi.required' => 'SK Akreditasi Harus Diisi',
            'gelar.required' => 'Gelar Harus Diisi',
            'gelar_en.required' => 'Gelar Harus Diisi',
            'gelar_singkat.required' => 'Gelar Singkat Harus Diisi',
            'singkatan.required' => 'Singkatan Harus Diisi',
        ]);

        // dd($request);

        // insert data prodi
        $newProdi = ProgramStudi::create([
            'jenjang_pendidikan_id' => $request->jenjang_pendidikan_id,
            'kode_prodi' => $request->kode_prodi,
            'nama' => $request->nama,
            'nama_en' => $request->nama_en,
            'singkatan' => $request->singkatan,
            'bhs_pengantar_kuliah' => $request->bhs_pengantar_kuliah,
            'bhs_pengantar_kuliah_en' => $request->bhs_pengantar_kuliah_en,
            'sistem_penilaian' => $request->sistem_penilaian,
            'sistem_penilaian_en' => $request->sistem_penilaian_en,
            'akreditasi' => $request->akreditasi,
            'sk_akreditasi' => $request->sk_akreditasi,
            'gelar' => $request->gelar,
            'gelar_en' => $request->gelar_en,
            'gelar_singkat' => $request->gelar_singkat,
        ]);

        // dd($newProdi);

        // isi capaian pembelajaran
        $pengaturan = Pengaturan::where('nama', 'informasi_kualifikasi_dan_hasil_capaian')->first();
        $newProdi->kualifikasi_cpl = $pengaturan ? $pengaturan->nilai : json_encode([]);

        $pengaturan = Pengaturan::where('nama', 'kegiatan_default')->first();
        $newProdi->kegiatan_default = $pengaturan ? $pengaturan->nilai : json_encode([]);
        $newProdi->save();

        // redirect to cpl page
        return redirect()->route('admin.prodi.edit-cpl', ['id' => $newProdi->id, 'from' => 'add-prodi'])->with('success', 'Program studi berhasil ditambahkan. Silahkan sesuaikan data CPL-nya.');
    }

    public function edit($id)
    {
        // get jenjang pendidikan data
        $jenjangPendidikan = JenjangPendidikan::all();

        // get detail data
        $detailData = ProgramStudi::findOrFail($id);

        return view('admin.pages.prodi.edit', [
            'jenjangPendidikan' => $jenjangPendidikan,
            'detailData' => $detailData
        ]);
    }

    public function update(Request $request, $id)
    {
        // validate request
        $request->validate([
            'jenjang_pendidikan_id' => 'required|exists:jenjang_pendidikan,id',
            'kode_prodi' => 'required|unique:program_studi,kode_prodi,' . $id,
            'nama' => 'required|unique:program_studi,nama,' . $id,
            'nama_en' => 'required|unique:program_studi,nama_en,' . $id,
            'singkatan' => 'required|unique:program_studi,singkatan,' . $id,
            'akreditasi' => 'required',
            'gelar' => 'required',
            'gelar_en' => 'required',
            'gelar_singkat' => 'required',
        ], [
            'jenjang_pendidikan_id.required' => 'Jenjang pendidikan harus dipilih',
            'kode_prodi.required' => 'Kode program studi harus diisi',
            'nama.required' => 'Nama program studi harus diisi',
            'nama.unique' => 'Nama program studi sudah terdaftar',
            'nama_en.required' => 'Nama program studi (English) harus diisi',
            'nama_en.unique' => 'Nama program studi (English) sudah terdaftar',
            'akreditasi.required' => 'Akreditasi harus diisi',
            'sk_akreditasi.required' => 'SK Akreditasi harus diisi',
            'gelar.required' => 'Gelar harus diisi',
            'gelar_en.required' => 'Gelar (English) harus diisi',
            'gelar_singkat.required' => 'Gelar harus diisi',
        ]);

        // update data
        ProgramStudi::where('id', $id)->update([
            'jenjang_pendidikan_id' => $request->jenjang_pendidikan_id,
            'kode_prodi' => $request->kode_prodi,
            'nama' => $request->nama,
            'nama_en' => $request->nama_en,
            'singkatan' => $request->singkatan,
            'bhs_pengantar_kuliah' => $request->bhs_pengantar_kuliah,
            'bhs_pengantar_kuliah_en' => $request->bhs_pengantar_kuliah_en,
            'akreditasi' => $request->akreditasi,
            'sk_akreditasi' => $request->sk_akreditasi,
            'sistem_penilaian' => $request->sistem_penilaian,
            'sistem_penilaian_en' => $request->sistem_penilaian_en,
            'gelar' => $request->gelar,
            'gelar_en' => $request->gelar_en,
            'gelar_singkat' => $request->gelar_singkat,
        ]);

        // redirect back
        return redirect()->route('admin.prodi.index')->with('success', 'Program studi berhasil diperbarui');
    }

    public function destroy($id)
    {
        // delete data
        ProgramStudi::destroy($id);

        // redirect back
        return redirect()->back()->with('success', 'Program studi berhasil dihapus');
    }

    /* CPL (capaian pembelajaran) */

    public function editCpl(Request $request, $prodiId)
    {
        // get detail data
        $detailData = ProgramStudi::findOrFail($prodiId);

        // dd($detailData->kualifikasi_cpl);

        return view('admin.pages.prodi.cpl', [
            'detailData' => $detailData,
        ]);
    }

    public function updateCpl(Request $request, $id)
    {
        // update data
        ProgramStudi::where('id', $id)->update([
            'kualifikasi_cpl' => $request->cpl
        ]);

        if ($request->from == 'add-prodi') {
            return redirect()->route('admin.prodi.index')->with('success', 'Data Prodi dan CPL-nya berhasil disimpan');
        }

        // redirect back
        return redirect()->route('admin.prodi.index')->with('success', 'CPL berhasil diperbarui');
    }

    public function editKegiatan(Request $request, $prodiId)
    {
        // get detail data
        $detailData = ProgramStudi::findOrFail($prodiId);

        // dd($detailData->kegiatan_default);

        return view('admin.pages.prodi.editKegiatan', [
            'detailData' => $detailData,
        ]);
    }

    public function updateKegiatan(Request $request, $id)
    {
        // update data
        ProgramStudi::where('id', $id)->update([
            'kegiatan_default' => $request->kegiatan_default
        ]);

        // redirect back
        return redirect()->route('admin.prodi.index')->with('success', 'Kegiatan berhasil diperbarui');
    }
}
