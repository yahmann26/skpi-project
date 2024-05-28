<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProdiDataTable;
use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ProdiRequest;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('AdminMiddleware');
    }

    public function index(ProdiDataTable $datatable)
    {
        return $datatable->render('admin.pages.prodi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.prodi.create', [
            "title" => "Tambah Prodi",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('kode_prodi', $request->kode_prodi);
        Session::flash('nama_prodi', $request->nama_prodi);
        Session::flash('bahasa_pengantar_kuliah', $request->bahasa_pengantar_kuliah);
        Session::flash('akreditasi', $request->akreditasi);
        Session::flash('sk_akreditasi', $request->sk_akreditasi);
        Session::flash('sistem_penilaian', $request->sistem_penilaian);
        Session::flash('gelar', $request->gelar);
        Session::flash('jenis_program_pendidikan', $request->jenis_program_pendidikan);
        Session::flash('jenjang_lanjutan', $request->jenjang_lanjutan);
        Session::flash('kualifikasi_kkni', $request->kualifikasi_kkni);

        $request->validate([
            'kode_prodi' => 'required|unique:prodi,kode_prodi',
            'nama_prodi' => 'required|unique:prodi,nama_prodi',
            'bahasa_pengantar_kuliah' => 'required',
            'akreditasi' => 'required',
            'sk_akreditasi' => 'required',
            'sistem_penilaian' => 'required',
            'gelar' => 'required',
            'jenis_program_pendidikan' => 'required',
            'jenjang_lanjutan' => 'required',
            'kualifikasi_kkni' => 'required',
        ], [
            'kode_prodi.required' => 'Kode Prodi wajib diisi',
            'kode_prodi.unique' => 'Kode Prodi sudah ada ',
            'nama_prodi.required' => 'Nama Prodi wajib diisi',
            'nama_prodi.unique' => 'Nama Prodi sudah ada',
            'bahasa_pengantar_kuliah.required' => 'Bahasa Pengantar Kuliah wajib diisi',
            'akreditasi.required' => 'Akreditasi wajib diisi',
            'sk_akreditasi.required' => 'SK Akreditasi wajib diisi',
            'sistem_penilaian.required' => 'Sistem Penilaian wajib diisi',
            'gelar.required' => 'Gelar wajib diisi',
            'jenis_program_pendidikan.required' => 'Jenis & Program Pendidikan wajib diisi',
            'jenjang_lanjutan.required' => 'Jenis & Jenjang Lanjutan wajib diisi',
            'kualifikasi_kkni.required' => 'Kualifikasi KKNI wajib diisi',
        ]);


        $prodi = [
            'kode_prodi' => $request->kode_prodi,
            'nama_prodi' => $request->nama_prodi,
            'bahasa_pengantar_kuliah' => $request->bahasa_pengantar_kuliah,
            'akreditasi' => $request->akreditasi,
            'sk_akreditasi' => $request->sk_akreditasi,
            'sistem_penilaian' => $request->sistem_penilaian,
            'gelar' => $request->gelar,
            'jenis_program_pendidikan' => $request->jenis_program_pendidikan,
            'jenjang_lanjutan' => $request->jenjang_lanjutan,
            'kualifikasi_kkni' => $request->kualifikasi_kkni,
        ];

        Prodi::create($prodi);
        return redirect()->to('admin/prodi')->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prodi = Prodi::where('id', $id)->first();
        return view('admin.pages.prodi.show')->with('prodi', $prodi);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $prodi = Prodi::findOrFail($id);
        return view('admin.pages.prodi.edit')->with('prodi', $prodi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_prodi' => 'required|unique:prodi,kode_prodi',
            'nama_prodi' => 'required|unique:prodi,nama_prodi',
            'bahasa_pengantar_kuliah' => 'required',
            'akreditasi' => 'required',
            'sk_akreditasi' => 'required',
            'sistem_penilaian' => 'required',
            'gelar' => 'required',
            'jenis_program_pendidikan' => 'required',
            'jenjang_lanjutan' => 'required',
            'kualifikasi_kkni' => 'required',
        ], [

            'kode_prodi.unique' => 'Kode Prodi sudah ada ',
            'nama_prodi.required' => 'Nama Prodi wajib diisi',
            'nama_prodi.unique' => 'Nama Prodi sudah ada',
            'bahasa_pengantar_kuliah.required' => 'Bahasa Pengantar Kuliah wajib diisi',
            'akreditasi.required' => 'Akreditasi wajib diisi',
            'sk_akreditasi.required' => 'SK Akreditasi wajib diisi',
            'sistem_penilaian.required' => 'Sistem Penilaian wajib diisi',
            'gelar.required' => 'Gelar wajib diisi',
            'jenis_program_pendidikan.required' => 'Jenis & Program Pendidikan wajib diisi',
            'jenjang_lanjutan.required' => 'Jenis & Jenjang Lanjutan wajib diisi',
            'kualifikasi_kkni.required' => 'Kualifikasi KKNI wajib diisi',

        ]);

        $prodi = [
            'kode_prodi' => $request->kode_prodi,
            'nama_prodi' => $request->nama_prodi,
            'bahasa_pengantar_kuliah' => $request->bahasa_pengantar_kuliah,
            'akreditasi' => $request->akreditasi,
            'sk_akreditasi' => $request->sk_akreditasi,
            'sistem_penilaian' => $request->sistem_penilaian,
            'gelar' => $request->gelar,
            'jenis_program_pendidikan' => $request->jenis_program_pendidikan,
            'jenjang_lanjutan' => $request->jenjang_lanjutan,
            'kualifikasi_kkni' => $request->kualifikasi_kkni,
        ];

        Prodi::where('id', $id)->update($prodi);
        return redirect()->to('admin/prodi')->with('success', 'Berhasil Update Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Prodi::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Melakukan Delete Data');
    }
}
