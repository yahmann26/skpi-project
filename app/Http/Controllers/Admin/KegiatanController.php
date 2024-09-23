<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\KategoriKegiatan;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kegiatan::query()->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->addColumn('kategori', function (Kegiatan $kegiatan) {
                    return $kegiatan->kategoriKegiatan->nama;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.kegiatan.edit', $row->id);
                    $deleteUrl = route('admin.kegiatan.destroy', $row->id);
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
        return view('admin.pages.kegiatan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriKegiatan::all();

        return view('admin.pages.kegiatan.create', [
            'kategori' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_kegiatan_id' => 'required',
            'nama' => 'required',
            'tingkat' => 'required',
            'jabatan' => 'required',
            'bobot' => 'required',
        ], [
            'kategori_kegiatan_id.required' => 'Kategori Wajib Dipilih',
            'nama.required' => 'Nama kegiatan wajib diisi',
            'tingkat.required' => 'Tingkat kegiatan wajib diisi',
            'jabatan.required' => 'Jabatan wajib diisi',
            'bobot.required' => 'Bobot wajib diisi',

        ]);

        $kegiatan = [
            'kategori_kegiatan_id' => $request->kategori_kegiatan_id,
            'nama' => $request->nama,
            'tingkat' => $request->tingkat,
            'jabatan' => $request->jabatan,
            'bobot' => $request->bobot,

        ];

        Kegiatan::create($kegiatan);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Berhasil Menambahkan Data');
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
        // get kategori Kegiatan
        $kategori = KategoriKegiatan::all();

        $kegiatan = Kegiatan::with('kategoriKegiatan')->find($id);

        return  view('admin.pages.kegiatan.edit', [
            'kategori' => $kategori,
            'kegiatan' => $kegiatan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kegiatan = Kegiatan::with('kategoriKegiatan')->find($id);

        $request->validate([
            'nama' => 'required',
            'tingkat' => 'required',
            'jabatan' => 'required',
            'bobot' => 'required',
        ], [
            'nama.required' => 'Nama Kegiatan wajib diisi',
            'tingkat.required' => 'Tingkat Kegiatan wajib diisi',
            'jabatan.required' => 'TJabatan wajib diisi',
            'bobot.required' => 'Bobot Masuk wajib diisi',
        ]);

        $kegiatan = [
            'nama' => $request->nama,
            'tingkat' => $request->tingkat,
            'jabatan' => $request->jabatan,
            'bobot' => $request->bobot,
        ];

        kegiatan::where('id', $id)->update($kegiatan);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Berhasil Mengupdate Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kegiatan::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
