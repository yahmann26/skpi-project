<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pt = Pt::get();
        return view('admin.pages.pt.index', [
            "title" => "Pendidikan Tinggi",
        ])->with('pt', $pt);
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
        Session::flash('sistem_pt', $request->sistem_pt);
        Session::flash('kkni', $request->kkni);

        $request->validate([
            'sistem_pt' => 'required',
            'kkni' => 'required',
        ], [
            'sistem_pt.required' => 'Sistem Peguruan TInggi wajib diisi',
            'kkni.required' => 'kkni wajib diisi',
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
        //
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
        //
    }
}
