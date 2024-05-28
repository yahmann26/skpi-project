<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DosenDataTable;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DosenDataTable $datatable)
    {
        return $datatable->render('admin.pages.dosen.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::all();
        return view('admin.pages.dosen.create', [
            "title" => "Tambah Dosen",
        ], compact('prodi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('kode_dosen', $request->kode_dosen);
        Session::flash('nama_dosen', $request->nama_dosen);
        Session::flash('prodi_id', $request->prodi_id);
        Session::flash('jabatan', $request->jabatan);

        $request->validate([
            'kode_dosen' => 'required|numeric|unique:dosen,kode_dosen',
            'nama_dosen' => 'required',
            'jabatan' => 'required',
            'prodi_id' => 'required',
        ], [
            'kode_dosen.required' => 'Kode dosen wajib diisi',
            'kode_dosen.numeric' => 'kode dosen Hanya Angka',
            'kode_dosen.unique' => 'kode dosen sudah ada ',
            'nama_dosen.required' => 'Nama Dosen wajib diisi',
            'prodi_id.required' => 'Prodi Wajib Dipilih',
        ]);

        $dosen = [
            'kode_dosen' => $request->kode_dosen,
            'nama_dosen' => $request->nama_dosen,
            'jabatan' => $request->jabatan,
            'prodi_id' => $request->prodi_id,
        ];

        Dosen::create($dosen);
        return redirect()->to('admin/dosen')->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prodi = Prodi::all();
        $dosen = Dosen::with('prodi')->find($id);
        return view('admin.pages.dosen.show', compact('dosen', 'prodi'))->with('dosen', $dosen);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $prodi = Prodi::all();
        $dosen = Dosen::with('prodi')->find($id);
        return view('admin.pages.dosen.edit', compact('dosen', 'prodi'))->with('dosen', $dosen);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dosen = Dosen::with('prodi')->find($id);
        $request->validate([
            'nama_dosen' => 'required',
            'jabatan' => 'required',
        ], [
            'nama_dosen.required' => 'Nama dosen wajib diisi',
            'jabatan.required' => 'Jabatan Wajib diisi',
        ]);

        $dosen = [
            'nama_dosen' => $request->nama_dosen,
            'jabatan' => $request->jabatan,
            'prodi_id' => $request->prodi_id,
        ];

        Dosen::where('id', $id)->update($dosen);

        return redirect()->to('admin/dosen')->with('success', 'Berhasil Mengupdate Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Dosen::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Melakukan Delete Data');
    }
}
