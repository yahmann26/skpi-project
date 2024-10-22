<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Mahasiswa::query()->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->addColumn('prodi', function (Mahasiswa $mahasiswa) {
                    return $mahasiswa->prodi->nama;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.mahasiswa.edit', $row->id);
                    $deleteUrl = route('admin.mahasiswa.destroy', $row->id);
                    return '
                    <a href="' . $editUrl . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <form id="deleteForm-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $row->id . ')"><i class="bi bi-trash"></i></button>
                    </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.mahasiswa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = ProgramStudi::all();

        return view('admin.pages.mahasiswa.create', [
            'prodi' => $prodi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa,nim',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'program_studi_id' => 'required',
            'email' => 'required',
        ], [
            'nim.required' => 'NIM wajib diisi',
            'nim.numeric' => 'NIM Hanya Angka',
            'nim.unique' => 'NIM sudah ada ',
            'nama.required' => 'Nama Mahasiswa wajib diisi',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi',
            'tgl_lahir.required' => 'Tanggal Lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib Dipilih',
            'program_studi_id.required' => 'Prodi Wajib Dipilih',
            'email.required' => 'email wajib diisi',
        ]);

        DB::transaction(function () use ($request) {
            $nim = $request->nim;

            $user = User::create([
                'uid' => $nim,
                'email' => $request->email,
                'password' => Hash::make($nim) // mengatur password sama dengan nim
            ]);

            Mahasiswa::create([
                'nim' => $nim,
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'program_studi_id' => $request->program_studi_id,
                'jenis_pendaftaran' => $request->jenis_pendaftaran,
                'jenis_pendaftaran_en' => $request->jenis_pendaftaran_en,
                'tgl_masuk' => $request->tgl_masuk,
                'tgl_lulus' => $request->tgl_lulus,
                'user_id' => $user->id,
            ]);


        });

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data berhasil ditambahkan!');
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
        // get prodi
        $prodi = ProgramStudi::all();

        $mahasiswa = Mahasiswa::with('prodi')->find($id);

        return  view('admin.pages.mahasiswa.edit', [
            'mahasiswa' => $mahasiswa,
            'prodi' => $prodi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'program_studi_id' => 'required',
            'email' => 'required|email|max:255',

        ], [
            'nama.required' => 'Nama Mahasiswa wajib diisi',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi',
            'tgl_lahir.required' => 'Tanggal Lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib Dipilih',
            'program_studi_id.required' => 'Prodi Wajib Dipilih',
            'email.required' => 'email wajib diisi',
        ]);

        // update data mahasiswa
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'tempat_lahir' =>$request->tempat_lahir,
            'tgl_lahir' =>$request->tgl_lahir,
            'tgl_masuk' =>$request->tgl_masuk,
            'tgl_lulus' =>$request->tgl_lulus,
            'jenis_kelamin' =>$request->jenis_kelamin,
            'jenis_pendaftaran' =>$request->jenis_pendaftaran,
            'jenis_pendaftaran_en' =>$request->jenis_pendaftaran_en,
            'program_studi_id' =>$request->program_studi_id,
        ]);

        // dd($mahasiswa);

        //update data user
        $user = User::findOrFail($mahasiswa->user_id);

        // update password jika diisi
        // if($request->filled('password')) {
        //     $user->password = Hash::make($request->password);
        // }

        $user->update([
            'uid' => $request->nim,
            'email' => $request->email,
        ]);

        // dd($user);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Cari data user terkait berdasarkan user_id di tabel mahasiswa
        $user = User::findOrFail($mahasiswa->user_id);

        // Hapus data mahasiswa
        $mahasiswa->delete();

        // Hapus data user terkait
        $user->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
