<?php

namespace App\Http\Controllers\Kaprodi;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\JenjangPendidikan;
use Illuminate\Support\Facades\Auth;

class ProdiController extends Controller
{
    public function index(Request $request)
    {

        $kaprodi = Auth::user()->kaprodi;
        $prodi = $kaprodi->program_studi_id;

        if ($request->ajax()) {
            $data = ProgramStudi::query()->where('id', $prodi)->get();

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
                    $editUrl = route('kaprodi.prodi.edit', $row->id);
                    $editCpl = route('kaprodi.prodi.edit-cpl', $row->id);
                    return '
                        <a title="Ubah CPL" href="' . $editCpl . '" class="edit btn btn-light text-success fw-bold"><i class="bi bi-pencil-square"></i> CPL</a>
                        <a title="Ubah" href="' . $editUrl . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>';
                })
                ->rawColumns(['nama', 'gelar', 'jenjang_lanjutan', 'jenjang', 'action'])
                ->make(true);
        }

        return view('kaprodi.pages.prodi.index');
    }

    public function edit($id)
    {
        // get jenjang pendidikan data
        $jenjangPendidikan = JenjangPendidikan::all();

        // get detail data
        $detailData = ProgramStudi::findOrFail($id);

        return view('kaprodi.pages.prodi.edit', [
            'jenjangPendidikan' => $jenjangPendidikan,
            'detailData' => $detailData
        ]);
    }

    public function update(Request $request, $id)
    {
        // validate request
        $request->validate([
            'jenjang_pendidikan_id' => 'required|exists:jenjang_pendidikan,id',
            'nama' => 'required|unique:program_studi,nama,' . $id,
            'nama_en' => 'required|unique:program_studi,nama_en,' . $id,
            'akreditasi' => 'required',
            'gelar' => 'required',
            'gelar_en' => 'required'
        ], [
            'jenjang_pendidikan_id.required' => 'Jenjang pendidikan harus dipilih',
            'nama.required' => 'Nama program studi harus diisi',
            'nama.unique' => 'Nama program studi sudah terdaftar',
            'nama_en.required' => 'Nama program studi (English) harus diisi',
            'nama_en.unique' => 'Nama program studi (English) sudah terdaftar',
            'akreditasi.required' => 'Akreditasi harus diisi',
            'gelar.required' => 'Gelar harus diisi',
            'gelar_en.required' => 'Gelar (English) harus diisi'
        ]);

        // update data
        ProgramStudi::where('id', $id)->update([
            'jenjang_pendidikan_id' => $request->jenjang_pendidikan_id,
            'nama' => $request->nama,
            'nama_en' => $request->nama_en,
            'bhs_pengantar_kuliah' => $request->bhs_pengantar_kuliah,
            'bhs_pengantar_kuliah_en' => $request->bhs_pengantar_kuliah_en,
            'akreditasi' => $request->akreditasi,
            'sistem_penilaian' => $request->sistem_penilaian,
            'sistem_penilaian_en' => $request->sistem_penilaian_en,
            'gelar' => $request->gelar,
            'gelar_en' => $request->gelar_en
        ]);

        // redirect back
        return redirect()->route('kaprodi.prodi.index')->with('success', 'Program studi berhasil diperbarui');
    }

    public function editCpl(Request $request, $prodiId)
    {
        // get detail data
        $detailData = ProgramStudi::findOrFail($prodiId);

        return view('kaprodi.pages.prodi.cpl', [
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
            return redirect()->route('kaprodi.prodi.index')->with('success', 'Data Prodi dan CPL-nya berhasil disimpan');
        }

        // redirect back
        return redirect()->route('kaprodi.prodi.index')->with('success', 'CPL berhasil diperbarui');
    }
}
