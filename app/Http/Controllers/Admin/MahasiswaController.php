<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MahasiswaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MahasiswaDataTable $dataTable)
    {
        $jumlahMahasiswa = Mahasiswa::count();
        return $dataTable->render('admin.pages.mahasiswa.index', compact('jumlahMahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::all();
        return view('admin.pages.mahasiswa.create', [
            "title" => "Tambah Mahasiswa",
        ], compact('prodi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nim', $request->nim);
        Session::flash('nama_mahasiswa', $request->nama_mahasiswa);
        Session::flash('tempat_lahir', $request->tempat_lahir);
        Session::flash('tgl_lahir', $request->tgl_lahir);
        Session::flash('jenis_kelamin', $request->jenis_kelamin);
        Session::flash('prodi_id', $request->prodi_id);
        Session::flash('tgl_masuk', $request->tgl_masuk);
        Session::flash('tgl_lulus', $request->tgl_lulus);

        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa,nim',
            'nama_mahasiswa' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'prodi_id' => 'required',
            'tgl_masuk' => 'required|date',
            'tgl_lulus' => 'required|date',
        ], [
            'nim.required' => 'NIM wajib diisi',
            'nim.numeric' => 'NIM Hanya Angka',
            'nim.unique' => 'NIM sudah ada ',
            'nama_mahasiswa.required' => 'Nama Mahasiswa wajib diisi',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi',
            'tgl_lahir.required' => 'Tanggal Lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib Dipilih',
            'prodi_id.required' => 'Prodi Wajib Dipilih',
            'tgl_masuk.required' => 'Tanggal Masuk wajib diisi',
            'tgl_lulus.required' => 'Tanggal Lulus wajib diisi',
        ]);

        $mahasiswa = [
            'nim' => $request->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'prodi_id' => $request->prodi_id,
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_lulus' => $request->tgl_lulus,
        ];

        Mahasiswa::create($mahasiswa);
        return redirect()->to('admin/mahasiswa')->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mahasiswa = Mahasiswa::where('id', $id)->first();
        return view('admin.pages.mahasiswa.show')->with('mahasiswa', $mahasiswa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $prodi = Prodi::all();
        $mahasiswa = Mahasiswa::with('prodi')->find($id);
        return view('admin.pages.mahasiswa.edit', compact('mahasiswa', 'prodi'))->with('mahasiswa', $mahasiswa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mahasiswa = DB::table('mahasiswa')->orderBy('id')->cursorPaginate(1000);
        // $mahasiswa = DB::table('mahasiswa')->with('prodi')->find($id)->simplePaginate();
        // $mahasiswa = Mahasiswa::with('prodi')->find($id);
        $request->validate([
            'nama_mahasiswa' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'tgl_masuk' => 'required|date',
            'tgl_lulus' => 'required|date',
        ], [
            'nama_mahasiswa.required' => 'Nama Mahasiswa wajib diisi',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi',
            'tgl_lahir.required' => 'Tanggal Lahir wajib diisi',
            'tgl_masuk.required' => 'Tanggal Masuk wajib diisi',
            'tgl_lulus.required' => 'Tanggal Lulus wajib diisi',
        ]);

        $mahasiswa = [
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'tempat_lahir' => $request->tempat_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'prodi_id' => $request->prodi_id,
            'tgl_lahir' => $request->tgl_lahir,
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_lulus' => $request->tgl_lulus,
        ];

        Mahasiswa::where('id', $id)->update($mahasiswa);

        return redirect()->to('admin/mahasiswa')->with('success', 'Berhasil Mengupdate Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Mahasiswa::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Melakukan Delete Data');
    }
}
