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
                ->addColumn('action', function ($row) {
                    $showUrl = route('admin.jenjang.show', $row->id);
                    $editUrl = route('admin.jenjang.edit', $row->id);
                    $deleteUrl = route('admin.jenjang.destroy', $row->id);
                    return '
                    <a href="' . $showUrl . '" class="edit btn btn-success btn-sm"><i class="bi bi-eye"></i></a>
                    <a href="' . $editUrl . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </form>';
                })
                ->rawColumns(['action'])
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
            'level_kkni' => 'nullable|numeric',
            'syarat_masuk' => 'nullable',
            'syarat_masuk_en' => 'nullable',
            // 'lama_studi_reguler' => 'nullable|numeric',
            'lama_studi_reguler' => 'nullable',
            'jenjang_lanjutan' => 'nullable',
            'jenjang_lanjutan_en' => 'nullable',
        ], [
            'nama.required' => 'Nama jenjang harus diisi',
            'nama.min' => 'Nama jenjang minimal 3 karakter',
            'nama_en.required' => 'Nama jenjang (English) harus diisi',
            'nama_en.min' => 'Nama jenjang (English) minimal 3 karakter',
            'singkatan.required' => 'Singkatan jenjang harus diisi',
            'level_kkni.numeric' => 'Level KKNI harus berupa angka',
            'lama_studi_reguler.numeric' => 'Lama studi reguler harus berupa angka',
        ]);

        // insert data
        JenjangPendidikan::create([
            'nama' => $request->nama,
            'nama_en' => $request->nama_en,
            'singkatan' => $request->singkatan,
            'level_kkni' => $request->level_kkni,
            'syarat_masuk' => $request->syarat_masuk,
            'syarat_masuk_en' => $request->syarat_masuk_en,
            'lama_studi_reguler' => $request->lama_studi_reguler,
            'jenjang_lanjutan' => $request->jenjang_lanjutan,
            'jenjang_lanjutan_en' => $request->jenjang_lanjutan_en,
        ]);

        // redirect back
        return redirect()->route('admin.jenjang.index')->with('success', 'Jenjang berhasil ditambahkan');
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
            'level_kkni' => 'nullable|numeric',
            'syarat_masuk' => 'nullable',
            'syarat_masuk_en' => 'nullable',
            // 'lama_studi_reguler' => 'nullable|numeric',
            'lama_studi_reguler' => 'nullable',
            'jenjang_lanjutan' => 'nullable',
            'jenjang_lanjutan_en' => 'nullable',
        ], [
            'nama.required' => 'Nama jenjang harus diisi',
            'nama.min' => 'Nama jenjang minimal 3 karakter',
            'nama_en.required' => 'Nama jenjang (English) harus diisi',
            'nama_en.min' => 'Nama jenjang (English) minimal 3 karakter',
            'singkatan.required' => 'Singkatan jenjang harus diisi',
            'level_kkni.numeric' => 'Level KKNI harus berupa angka',
            'lama_studi_reguler.numeric' => 'Lama studi reguler harus berupa angka',
        ]);

        // update data
        JenjangPendidikan::where('id', $id)->update([
            'nama' => $request->nama,
            'nama_en' => $request->nama_en,
            'singkatan' => $request->singkatan,
            'level_kkni' => $request->level_kkni,
            'syarat_masuk' => $request->syarat_masuk,
            'syarat_masuk_en' => $request->syarat_masuk_en,
            'lama_studi_reguler' => $request->lama_studi_reguler,
            'jenjang_lanjutan' => $request->jenjang_lanjutan,
            'jenjang_lanjutan_en' => $request->jenjang_lanjutan_en,
        ]);

        // redirect back
        return redirect()->route('admin.jenjang.index')->with('success', 'Jenjang berhasil diubah');
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
