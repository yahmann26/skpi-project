<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\JenjangPendidikan;
use App\Http\Controllers\Controller;

class JenjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JenjangPendidikan::query()->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->addColumn(
                    'nama',
                    fn($row) =>
                    '<div>' . $row->nama . '</div><div class="fst-italic small text-secondary">' . $row->nama_en . '</div>'
                )
                ->addColumn(
                    'jenjang_lanjutan',
                    fn($row) =>
                    '<div>' . $row->jenjang_lanjutan . '</div><div class="fst-italic small text-secondary">' . $row->jenjang_lanjutan_en . '</div>'
                )
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.jenjang.edit', $row->id);
                    $deleteUrl = route('admin.jenjang.destroy', $row->id);
                    return '
                    <a href="' . $editUrl . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <form id="deleteForm-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $row->id . ')"><i class="bi bi-trash"></i></button>
                    </form>';
                })
                ->rawColumns(['action', 'nama', 'jenjang_lanjutan'])
                ->make(true);
        }
        return view('admin.pages.jenjang.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.jenjang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $request->validate([
            'nama' => 'required|min:3|unique:jenjang_pendidikan,nama',
            'nama_en' => 'required|min:3|unique:jenjang_pendidikan,nama_en',
            'singkatan' => 'required',
            'kualifikasi_kkni' => 'required',
            'jenis_pendidikan' => 'nullable',
            'jenis_pendidikan_en' => 'nullable',
            'lama_studi_reguler' => 'nullable',
            'jenis_lanjutan' => 'nullable',
            'jenis_lanjutan_en' => 'nullable',
            'jenjang_lanjutan' => 'nullable',
            'jenjang_lanjutan_en' => 'nullable',
        ], [
            'nama.required' => 'Nama jenjang harus diisi',
            'nama.min' => 'Nama jenjang minimal 3 karakter',
            'nama_en.required' => 'Nama jenjang (English) harus diisi',
            'nama_en.min' => 'Nama jenjang (English) minimal 3 karakter',
            'singkatan.required' => 'Singkatan jenjang harus diisi',
            'kualifikasi_kkni.required' => 'Level KKNI harus diisi',
            'lama_studi_reguler.numeric' => 'Lama studi reguler harus berupa angka',
        ]);

        // insert data
        JenjangPendidikan::create([
            'nama' => $request->nama,
            'nama_en' => $request->nama_en,
            'singkatan' => $request->singkatan,
            'kualifikasi_kkni' => $request->kualifikasi_kkni,
            'jenis_pendidikan' => $request->jenis_pendidikan,
            'jenis_pendidikan_en' => $request->jenis_pendidikan_en,
            'lama_studi_reguler' => $request->lama_studi_reguler,
            'jenis_lanjutan' => $request->jenis_lanjutan,
            'jenis_lanjutan_en' => $request->jenis_lanjutan_en,
            'jenjang_lanjutan' => $request->jenjang_lanjutan,
            'jenjang_lanjutan_en' => $request->jenjang_lanjutan_en,
        ]);

        // redirect back
        return redirect()->route('admin.jenjang.index')->with('success', 'Jenjang Pendidikan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.pages.jenjang.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // get detail data
        $detailData = JenjangPendidikan::findOrFail($id);

        return view('admin.pages.jenjang.edit', [
            'detailData' => $detailData
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate request
        $request->validate([
            'nama' => 'required|min:3',
            'nama_en' => 'required|min:3',
            'singkatan' => 'required',
            'kualifikasi_kkni' => 'required',
            'jenis_pendidikan' => 'nullable',
            'jenis_pendidikan_en' => 'nullable',
            'lama_studi_reguler' => 'nullable',
            'jenjang_lanjutan' => 'nullable',
            'jenjang_lanjutan_en' => 'required',
        ], [
            'nama.required' => 'Nama jenjang harus diisi',
            'nama.min' => 'Nama jenjang minimal 3 karakter',
            'nama_en.required' => 'Nama jenjang (English) harus diisi',
            'nama_en.min' => 'Nama jenjang (English) minimal 3 karakter',
            'singkatan.required' => 'Singkatan jenjang harus diisi',
            'kualifikasi_kkni.required' => 'Level KKNI harus diisi',
            'jenjang_lanjutan_en.required' => 'Jenjang Wajib harus diisi',
        ]);

        // update data
        JenjangPendidikan::where('id', $id)->update([
            'nama' => $request->nama,
            'nama_en' => $request->nama_en,
            'singkatan' => $request->singkatan,
            'kualifikasi_kkni' => $request->kualifikasi_kkni,
            'jenis_pendidikan' => $request->jenis_pendidikan,
            'jenis_pendidikan_en' => $request->jenis_pendidikan_en,
            'lama_studi_reguler' => $request->lama_studi_reguler,
            'jenis_lanjutan' => $request->jenjang_lanjutan,
            'jenis_lanjutan_en' => $request->jenjang_lanjutan_en,
            'jenjang_lanjutan' => $request->jenjang_lanjutan,
            'jenjang_lanjutan_en' => $request->jenjang_lanjutan_en,
        ]);

        // redirect back
        return redirect()->route('admin.jenjang.index')->with('success', 'Jenjang Pendidikan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // check if jenjang id doesnt exist in program_studi table
        if (ProgramStudi::where('jenjang_pendidikan_id', $id)->exists()) {
            return redirect()->back()->with('error', 'Jenjang sudah tertaut dengan salah satu data Progam Studi');
        }

        // delete data
        JenjangPendidikan::destroy($id);

        // redirect back
        return redirect()->back()->with('success', 'Jenjang berhasil dihapus');
    }
}
