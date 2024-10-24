<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skpi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class SkpiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Skpi::query()->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->addColumn('mahasiswa', function (Skpi $skpi) {
                    return $skpi->mahasiswa->nama;
                })
                ->addColumn('nim', function (Skpi $skpi) {
                    return $skpi->mahasiswa->nim;
                })
                ->addColumn('prodi', function (Skpi $skpi) {
                    return $skpi->mahasiswa->prodi->nama;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.skpi.edit', $row->id);
                    $deleteUrl = route('admin.skpi.destroy', $row->id);
                    return '
                    <a href="' . $editUrl . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <form id="deleteForm-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $row->id . ')"><i class="bi bi-trash"></i></button>
                    </form>';
                })
                ->rawColumns(['action', 'mahasiswa', 'nim',  'prodi'])
                ->make(true);
        }
        return view('admin.pages.skpi.index');
    }
}
