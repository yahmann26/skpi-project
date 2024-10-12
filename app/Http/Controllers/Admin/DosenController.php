<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Dosen;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Dosen::query()->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->addColumn('prodi', function (Dosen $dosen) {
                    return $dosen->prodi->nama;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.dosen.edit', $row->id);
                    $deleteUrl = route('admin.dosen.destroy', $row->id);
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
        return view('admin.pages.dosen.index');
    }


    public function create()
    {
        $prodi = ProgramStudi::all();

        return view('admin.pages.dosen.create', [
            'prodi' => $prodi
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_dosen' => 'required|numeric|unique:dosen,kode_dosen',
            'nama' => 'required',
            'program_studi_id' => 'required',
            'email' => 'required|email',
        ], [
            'kode_dosen.required' => 'Kode Dosen wajib diisi',
            'kode_dosen.numeric' => 'Kode Dosen hanya boleh angka',
            'kode_dosen.unique' => 'Kode Dosen sudah ada',
            'nama.required' => 'Nama Dosen wajib diisi',
            'program_studi_id.required' => 'Prodi wajib dipilih',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
        ]);

        // dd($request->all());


        DB::transaction(function () use ($request) {
            $kode_dosen = $request->kode_dosen;

            // Buat pengguna baru
            $user = User::create([
                'uid' => $kode_dosen,
                'email' => $request->email,
                'password' => Hash::make($kode_dosen), // Password sama dengan kode_dosen
                'role' => 'dosen', // Atur role langsung ke 'dosen'
            ]);

            // dd($user);

            // Buat entri dosen baru
            Dosen::create([
                'kode_dosen' => $kode_dosen,
                'nama' => $request->nama,
                'program_studi_id' => $request->program_studi_id,
                'user_id' => $user->id,
            ]);
        });

        return redirect()->route('admin.dosen.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function edit(string $id)
    {
        // get prodi
        $prodi = ProgramStudi::all();

        $dosen = Dosen::with('prodi')->find($id);

        return  view('admin.pages.dosen.edit', [
            'dosen' => $dosen,
            'prodi' => $prodi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'program_studi_id' => 'required',
            'email' => 'required|email|max:255',

        ], [
            'nama.required' => 'Nama dosen wajib diisi',
            'program_studi_id.required' => 'Prodi Wajib Dipilih',
            'email.required' => 'email wajib diisi',
        ]);

        // update data dosen
        $dosen = Dosen::findOrFail($id);
        $dosen->update([
            'nama' => $request->nama,
            'program_studi_id' => $request->program_studi_id,
        ]);

        //update data user
        $user = User::findOrFail($dosen->user_id);

        $user->update([
            'email' => $request->email,
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data mahasiswa berdasarkan ID
        $dosen = Dosen::findOrFail($id);

        // Cari data user terkait berdasarkan user_id di tabel dosen
        $user = User::findOrFail($dosen->user_id);

        // Hapus data dosen
        $dosen->delete();

        // Hapus data user terkait
        $user->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
