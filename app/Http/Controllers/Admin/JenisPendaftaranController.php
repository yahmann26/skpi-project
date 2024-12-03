<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\JenisPendaftaran;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class JenisPendaftaranController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JenisPendaftaran::query()->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.jenisPendaftaran.edit', $row->id);
                    $deleteUrl = route('admin.jenisPendaftaran.destroy', $row->id);
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
        return view('admin.pages.jenisPendaftaran.index');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'nama_en' => 'required',
            ],
            [
                'nama.required' => 'Nama harus diisi',
                'nama_en.required' => 'Nama harus diisi',
            ],
        );

        JenisPendaftaran::create([
            'nama' => $request->nama,
            'nama_en' => $request->nama_en,
        ]);

        return redirect()->route('admin.jenisPendaftaran.index')->with('success', 'Jenis Pendaftaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jenisPendaftaran = JenisPendaftaran::find($id);
        return view('admin.pages.jenisPendaftaran.edit', compact('jenisPendaftaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nama_en' => 'required',
        ], [
            'nama.required' => 'Nama Jenis Pendaftaran harus diisi',
            'nama_en.required' => 'Nama Jenis Pendaftaran harus diisi',
        ]);

        // update data
        JenisPendaftaran::where('id', $id)->update([
            'nama' => $request->nama,
            'nama_en' => $request->nama_en,
        ]);

        // redirect back
        return redirect()->route('admin.jenisPendaftaran.index')->with('success', 'Jenis Pendaftaran berhasil diubah');
    }

    public function destroy($id)
    {
        JenisPendaftaran::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
