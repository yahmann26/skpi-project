<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = User::query()->where('role', 'admin')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return '';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.admin.edit', $row->id);
                    $deleteUrl = route('admin.admin.destroy', $row->id);
                    $resetPasswordUrl = route('admin.admin.reset-password', $row->id);
                    return '
                    <a href="#" class="btn btn-info btn-sm" onclick="confirmResetPassword(\'' . $resetPasswordUrl . '\')"><i class="bi bi-lock"></i></a>
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
        return view('admin.pages.admin.index');
    }

    public function create()
    {
        return view('admin.pages.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'uid' => 'required|unique:users,uid',
            'email' => 'required|email',
        ], [
            'uid.required' => 'Username Wajib Diisi',
            'uid.unique' => 'Username sudah ada',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
        ]);

        // dd($request);

        DB::transaction(function () use ($request) {


            User::create([
                'uid' => $request->uid,
                'email' => $request->email,
                'password' => Hash::make($request->uid),
                'role' => 'admin',
            ]);
        });

        return redirect()->route('admin.admin.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function edit(string $id)
    {

        $admin = User::find($id);

        return  view('admin.pages.admin.edit', [
            'admin' => $admin,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'uid' => 'required|unique:users,uid',
            'email' => 'required|email',

        ], [
            'uid.required' => 'Username Wajib Diisi',
            'uid.unique' => 'Username sudah ada',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
        ]);


        $admin = User::findOrFail($id);

        $admin->update([
            'uid' => $request->uid,
            'email' => $request->email,
        ]);

        // dd($user);

        return redirect()->route('admin.admin.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function resetPassword($id)
    {
        $admin = User::findOrFail($id);
        $admin->password = bcrypt($admin->uid);
        $admin->save();

        return redirect()->route('admin.admin.index')->with('success', 'Password telah berhasil direset');
    }
}
