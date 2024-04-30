<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::orderBy('id', 'desc')->get();

        return view('admin.pages.kategori.index', [
            "title" => "Kategori Kegiatan"
        ])->with('kategori', $kategori);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.kategori.create', [
            "title" => "Tambah Kategori",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nama_kategori', $request->nama_kategori);

        $request->validate ([
            'nama_kategori' => 'required|unique:kategori,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama Kategori wajib diisi',
            'nama_kategori.unique' => 'Nama Kategori sudah ada',
        ]);

        $kategori= [
            'nama_kategori' => $request->nama_kategori,
        ];

        Kategori::create($kategori);
        return redirect()->to('admin/kategori')->with('success', 'Berhasil Menambahkan Data');
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
        $kategori = Kategori::findOrFail($id);
        return view('admin.pages.kategori.edit')->with('kategori', $kategori);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Session::flash('nama_kategori', $request->nama_kategori);

        $request->validate ([
            'nama_kategori' => 'required|unique:kategori,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama Kategori wajib diisi',
            'nama_kategori.unique' => 'Nama Kategori sudah ada',
        ]);

        $kategori= [
            'nama_kategori' => $request->nama_kategori,
        ];

        Kategori::where('id', $id)->update($kategori);
        return redirect()->to('admin/kategori')->with('success', 'Berhasil Mengupdate Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kategori::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Melakukan Delete Data');
    }
}
