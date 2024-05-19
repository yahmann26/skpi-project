<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pt;
use Illuminate\Http\Request;
use App\DataTables\PtDataTable;
use App\Http\Controllers\Controller;

class PtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PtDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.pt.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.pt.create', [
            "title" => "Tambah PT"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Session::flash('sistem_pt', $request->sistem_pt);
        // Session::flash('kkni', $request->kkni);

        $request->validate([
            'sistem_pt' => 'required',
            'kkni' => 'required',
        ]);

        $pt = [
            'sistem_pt' => $request->sistem_pt,
            'kkni' => $request->kkni,
        ];

        Pt::create($pt);
        return redirect()->to('admin/pt')->with('success', 'Berhasil Menambahkan Data');
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
        return view('admin.pages.pt.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pt::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Melakukan Delete Data');
    }
}
