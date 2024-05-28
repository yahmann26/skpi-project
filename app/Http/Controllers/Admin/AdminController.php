<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Kategori;
use App\Models\Kegiatan;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    public function login(Request $request)
    {
        $kuki = $request->cookie("admin");
        if ($kuki) {
            $db = Admin::where(["token" => $kuki])->first();
            if ($db) {
                return redirect("admin/dashboard");
            }
        }
        return view('admin/login-admin');
    }

    public function logout()
    {
        return redirect("login-admin")->withoutCookie("admin");
    }

    public function loginPost(Request $request)
    {
        // ngecek username admin
        $admin = Admin::where(['username' => $request->input("username")])->first();
        if (!$admin) return redirect("/login-admin")->with('status', 'Username atau Password Salah');

        // ngecek password
        $password = Hash::check($request->input("password"), $admin->password);
        if (!$password) return redirect("/login-admin")->with('status', 'Password Salah');

        // update token login
        $token = Str::random(10);
        $admin->token = $token;
        return $admin->save() ? redirect("admin/dashboard")->withCookie("admin", $token, Carbon::tomorrow()->diffInMinutes(Carbon::now())) : redirect("login-admin")->with('status', 'gagal login');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahDosen = Dosen::count();
        $jumlahProdi = Prodi::count();
        $jumlahKegiatan = Kegiatan::count();
        $jumlahKategori = Kategori::count();
        // $this->middleware('auth');
        return view('admin.dashboard', compact('jumlahMahasiswa', 'jumlahDosen', 'jumlahProdi', 'jumlahKegiatan', 'jumlahKategori'), [
            "title" => "Dashboard",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
