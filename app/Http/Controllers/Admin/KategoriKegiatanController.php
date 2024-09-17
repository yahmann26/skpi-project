<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKegiatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KategoriKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = KategoriKegiatan::query()->latest();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', fn($row) => '')
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.kategoriKegiatan.edit', $row->id);
                $deleteUrl = route('admin.kategoriKegiatan.destroy', $row->id);
                return '
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

        return view('admin.pages.kategoriKegiatan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.kategoriKegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:kategori_kegiatan,nama',
        ], [
            'nama.required' => 'Nama Kategori harus diisi',
        ]);

        // insert data
        KategoriKegiatan::create([
            'nama' => $request->nama,
        ]);

        // redirect back
        return redirect()->route('admin.kategoriKegiatan.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // get detail data
        $detailData = KategoriKegiatan::findOrFail($id);

        return view('admin.pages.kategoriKegiatan.edit', [
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
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama Kategori harus diisi',
        ]);

        // update data
        KategoriKegiatan::where('id', $id)->update([
            'nama' => $request->nama,
        ]);

        // redirect back
        return redirect()->route('admin.kategoriKegiatan.index')->with('success', 'Kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KategoriKegiatan::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Melakukan Delete Data');
    }
}
