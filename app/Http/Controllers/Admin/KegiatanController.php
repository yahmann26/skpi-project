<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatan = Kegiatan::orderBy('id', 'desc')->get();
        return view('admin.pages.kegiatan.index', [
            "title" => "Data Kegiatan"
        ])->with('kegiatan', $kegiatan);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.pages.kegiatan.create', [
            "title" => "Tambah Kegiatan",
        ], compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('kategori_id', $request->kategori_id);
        Session::flash('nama_kegiatan', $request->nama_kegiatan);
        Session::flash('tingkat_kegiatan', $request->tingkat_kegiatan);
        Session::flash('jabatan', $request->jabatan);
        Session::flash('bobot', $request->bobot);

        $request->validate([
            'kategori_id' => 'required',
            'nama_kegiatan' => 'required',
            'tingkat_kegiatan' => 'required',
            'jabatan' => 'required',
            'bobot' => 'required',
        ], [
            'kategori_id.required' => 'Kategori Wajib Dipilih',
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi',
            'tingkat_kegiatan.required' => 'Tingkat kegiatan wajib diisi',
            'jabatan.required' => 'Jabatan wajib diisi',
            'bobot.required' => 'Bobot wajib diisi',

        ]);

        $kegiatan = [
            'kategori_id' => $request->kategori_id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'tingkat_kegiatan' => $request->tingkat_kegiatan,
            'jabatan' => $request->jabatan,
            'bobot' => $request->bobot,

        ];

        Kegiatan::create($kegiatan);
        return redirect()->to('admin/kegiatan')->with('success', 'Berhasil Menambahkan Data');
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
        $kategori = Kategori::all();
        $kegiatan = Kegiatan::with('kategori')->find($id);
        return view('admin.pages.kegiatan.edit', compact('kegiatan', 'kategori'))->with('kegiatan', $kegiatan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kegiatan = Kegiatan::with('kategori')->find($id);

        $request->validate([
            'nama_kegiatan' => 'required',
            'tingkat_kegiatan' => 'required',
            'jabatan' => 'required',
            'bobot' => 'required',
        ], [
            'nama_kegiatan.required' => 'Nama Mahasiswa wajib diisi',
            'tingkat_kegiatan.required' => 'Tempat Lahir wajib diisi',
            'jabatan.required' => 'Tanggal Lahir wajib diisi',
            'bobot.required' => 'Tanggal Masuk wajib diisi',
        ]);

        $kegiatan = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'tingkat_kegiatan' => $request->tingkat_kegiatan,
            'jabatan' => $request->jabatan,
            'bobot' => $request->bobot,
        ];

        kegiatan::where('id', $id)->update($kegiatan);

        return redirect()->to('admin/kegiatan')->with('success', 'Berhasil Mengupdate Data');
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
