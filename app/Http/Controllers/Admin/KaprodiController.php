<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Kaprodi;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class KaprodiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kaprodi::query()->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->addColumn('prodi', function (Kaprodi $kaprodi) {
                    return $kaprodi->prodi->nama;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.kaprodi.edit', $row->id);
                    $deleteUrl = route('admin.kaprodi.destroy', $row->id);
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
        return view('admin.pages.kaprodi.index');
    }

    public function create()
    {
        $prodi = ProgramStudi::all();

        return view('admin.pages.kaprodi.create', [
            'prodi' => $prodi
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_dosen' => 'required|numeric|unique:kaprodi,kode_dosen',
            'nama' => 'required',
            'program_studi_id' => 'required',
            'email' => 'required|email',
            'nip' => 'required',
        ], [
            'kode_dosen.required' => 'Kode Dosen wajib diisi',
            'kode_dosen.numeric' => 'Kode Dosen hanya boleh angka',
            'kode_dosen.unique' => 'Kode Dosen sudah ada',
            'nama.required' => 'Nama Kaprodi wajib diisi',
            'program_studi_id.required' => 'Prodi wajib dipilih',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
        ]);



        DB::transaction(function () use ($request) {
            $kode_dosen = $request->kode_dosen;


            $user = User::create([
                'uid' => $kode_dosen,
                'email' => $request->email,
                'password' => Hash::make($kode_dosen),
                'role' => 'kaprodi',
            ]);

            Kaprodi::create([
                'kode_dosen' => $kode_dosen,
                'nama' => $request->nama,
                'nip' => $request->nip,
                'program_studi_id' => $request->program_studi_id,
                'user_id' => $user->id,
            ]);
        });

        return redirect()->route('admin.kaprodi.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function edit(string $id)
    {

        $prodi = ProgramStudi::all();

        $kaprodi = Kaprodi::with('prodi')->find($id);

        return  view('admin.pages.kaprodi.edit', [
            'kaprodi' => $kaprodi,
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
            'kode_dosen' => 'required',
            'nip' => 'required',
            'program_studi_id' => 'required',
            'email' => 'required|email|max:255',

        ], [
            'nama.required' => 'Nama dosen wajib diisi',
            'kode_dosen.required' => 'Kode Dosen dosen wajib diisi',
            'nip.required' => 'NIP dosen wajib diisi',
            'program_studi_id.required' => 'Prodi Wajib Dipilih',
            'email.required' => 'email wajib diisi',
        ]);


        $kaprodi = Kaprodi::findOrFail($id);
        $kaprodi->update([
            'nama' => $request->nama,
            'kode_dosen' => $request->kode_dosen,
            'nip' => $request->nip,
            'program_studi_id' => $request->program_studi_id,
        ]);


        $user = User::findOrFail($kaprodi->user_id);

        $user->update([
            'uid' => $request->kode_dosen,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.kaprodi.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $kaprodi = Kaprodi::findOrFail($id);
        $user = User::findOrFail($kaprodi->user_id);
        $kaprodi->delete();
        $user->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
