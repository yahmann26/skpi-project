<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pt;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class PtController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pt::query()->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.pt.edit', $row->id);
                    return '
                    <a href="' . $editUrl . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.pt.index');
    }

    public function create()
    {
        return view('admin.pages.pt.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sistem_pendidikan' => 'required',
            'sistem_pendidikan_en' => 'required',
            'kkni' => 'required',
            'kkni_en' => 'required',
        ], [
            'sistem_pendidikan.required' => 'Sistem Pendidikan harus diisi',
            'sistem_pendidikan_en.required' => 'Sistem Pendidikan English harus diisi',
            'kkni.required' => 'KKNI harus diisi',
            'kkni_en.required' => 'KKNI English harus diisi',
        ]);

        // dd($request);

        // insert data
        Pt::create([
            'sistem_pendidikan' => $request->sistem_pendidikan,
            'sistem_pendidikan_en' => $request->sistem_pendidikan_en,
            'kkni' => $request->kkni,
            'kkni_en' => $request->kkni_en,
        ]);

        // dd($request);

        // redirect back
        return redirect()->route('admin.pt.index')->with('success', 'Pendidikan Tinggi berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $pt = Pt::findOrFail($id);

        return view('admin.pages.pt.edit', [
            'pt' => $pt
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate request
        $request->validate([
            'sistem_pendidikan' => 'required',
            'sistem_pendidikan_en' => 'required',
            'kkni' => 'required',
            'kkni_en' => 'required',
        ], [
            'sistem_pendidikan.required' => 'Sistem Pendidikan harus diisi',
            'sistem_pendidikan_en.required' => 'Sistem Pendidikan English harus diisi',
            'kkni.required' => 'KKNI harus diisi',
            'kkni_en.required' => 'KKNI English harus diisi',
        ]);

        // update data
        Pt::where('id', $id)->update([
           'sistem_pendidikan' => $request->sistem_pendidikan,
            'sistem_pendidikan_en' => $request->sistem_pendidikan_en,
            'kkni' => $request->kkni,
            'kkni_en' => $request->kkni_en,
        ]);

        // dd($request);

        // redirect back
        return redirect()->route('admin.pt.index')->with('success', 'Pendidikan Tinggi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete data
        Pt::destroy($id);

        // redirect back
        return redirect()->back()->with('success', 'Pendidikan Tinggi berhasil dihapus');
    }
}
