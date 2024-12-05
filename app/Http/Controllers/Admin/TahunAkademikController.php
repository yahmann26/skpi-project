<?php

namespace App\Http\Controllers\Admin;

use App\Models\Semester;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class TahunAkademikController extends Controller
{
    public function index(Request $request)
    {
        $semester = Semester::all();
        if ($request->ajax()) {
            $data = TahunAkademik::with('semester')->orderBy('nama', 'desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->addColumn('semester', fn($row) => $row->semester->nama)
                ->addColumn('aksi', function ($row) {
                    $editUrl = route('admin.thnAkademik.edit', $row->id);
                    $deleteUrl = route('admin.thnAkademik.destroy', $row->id);
                    return '
                    <a href="' . $editUrl . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <form id="deleteForm-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $row->id . ')"><i class="bi bi-trash"></i></button>
                    </form>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.pages.thnAkademik.index', compact('semester'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'semester_id' => 'required',
                'nama' => 'required',
            ],
            [
                'semester_id.required' => 'Semester harus dipilih',
                'nama.required' => 'Nama harus diisi',
            ]
        );

        // Membuat Tahun Akademik baru
        TahunAkademik::create([
            'nama' => $request->nama,
            'semester_id' => $request->semester_id,
        ]);

        // Menggunakan session untuk menampilkan pesan sukses
        session()->flash('success', 'Tahun Akademik berhasil ditambahkan');

        // Redirect langsung setelah menyimpan data
        return redirect()->route('admin.thnAkademik.index');
    }

    public function edit($id)
    {
        $semester = Semester::all();
        $thnAkademik = TahunAkademik::find($id);
        return view('admin.pages.thnAkademik.edit', compact('thnAkademik', 'semester'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'semester_id' => 'required',
        ], [
            'nama.required' => 'Nama Tahun Akademik harus diisi',
            'semester_id.required' => 'Semester harus dipilih',
        ]);

        // update data
        TahunAkademik::where('id', $id)->update([
            'nama' => $request->nama,
            'semester_id' => $request->semester_id,
        ]);

        // redirect back
        return redirect()->route('admin.thnAkademik.index')->with('success', 'Tahun Akademik berhasil diubah');
    }

    public function destroy($id)
    {
        TahunAkademik::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
