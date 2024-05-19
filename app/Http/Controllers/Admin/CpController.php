<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CapaianPembelajaran;
use App\Models\Prodi;
use App\DataTables\CpDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CpDataTable $dataTable)
    {

        return $dataTable->render('admin.pages.cp.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::all();
        return view('admin.pages.cp.create', [
            "title" => "Tambah Capaian Pembelajaran",
        ], compact('prodi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('prodi_id', $request->prodi_id);

        $request->validate([
            'penguasaan_pengetahuan' => 'required',
            'keterampilan' => 'required',
            'kemampuan_kerja' => 'required',
            'sikap' => 'required',
            'prodi_id' => 'required',
        ]);

        $cp = [
            'penguasaan_pengetahuan' => $request->penguasaan_pengetahuan,
            'keterampilan' => $request->keterampilan,
            'kemampuan_kerja' => $request->kemampuan_kerja,
            'sikap' => $request->sikap,
            'prodi_id' => $request->prodi_id,
        ];

        CapaianPembelajaran::create($cp);
        return redirect()->to('admin/cp')->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prodi = Prodi::all();
        $cp = CapaianPembelajaran::with('prodi')->find($id)->where('id', $id)->first();
        return view('admin.pages.cp.show', compact('cp', 'prodi'))->with('cp', $cp);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $prodi = Prodi::all();
        $cp = CapaianPembelajaran::with('prodi')->find($id);
        return view('admin.pages.cp.edit', compact('cp', 'prodi'))->with('cp', $cp);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cp = CapaianPembelajaran::with('prodi')->find($id);
        $request->validate ([
            'penguasaan_pengetahuan' => 'required',
            'keterampilan' => 'required',
            'kemampuan_kerja' => 'required',
            'sikap' => 'required',
        ]);

        $cp= [
            'penguasaan_pengetahuan' => $request->penguasaan_pengetahuan,
            'keterampilan' => $request->keterampilan,
            'kemampuan_kerja' => $request->kemampuan_kerja,
            'sikap' => $request->sikap,
        ];

        CapaianPembelajaran::where('id', $id)->update($cp);
        return redirect()->to('admin/cp')->with('success', 'Berhasil Mengupdate Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CapaianPembelajaran::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Melakukan Delete Data');
    }
}
