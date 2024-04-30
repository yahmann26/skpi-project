<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MahasiswaController extends Controller
{
    public function logout()
	{
		return redirect("/login-mahasiswa")->withoutCookie("mahasiswa");
	}

    public function login(Request $request)
    {
        $kuki = $request->cookie("mahasiswa");
        if ($kuki) {
            $db = Mahasiswa::where(["token" => $kuki])->first();
            if ($db) {
                return redirect("mahasiswa/dashboard");
            }
        }
        return view('mahasiswa/login-mahasiswa');
    }

	public function loginPost(Request $request)
	{
		//ngecek nim mahasiswa
		$mahasiswa = Mahasiswa::where(['nim' => $request->input("nim")])->first();
		if (!$mahasiswa) return redirect("/login-mahasiswa")->with('status', 'Username atau Password Salah');

		// ngecek password
		$password = Hash::check($request->input("password"), $mahasiswa->password);
		if (!$password) return redirect("/login-mahasiswa")->with('status', 'Password Salah');

		// update token login
		$token = Str::random(10);
		$mahasiswa->token = $token;
		return $mahasiswa->save() ? redirect("mahasiswa/dashboard")->withCookie("mahasiswa", $token, Carbon::tomorrow()->diffInMinutes(Carbon::now())) : redirect("/login-mahasiswa")->with('status', 'gagal login');
	}

	public function verifikasi()
	{
		return view('mahasiswa/verifikasi-mahasiswa', [
			"title" => "Daftar Akun"

		]);
	}

	public function verifikasiPost(Request $request)
	{
		$validator = Validator::make(
			$request->only(["nim", "password", "password2",]),
			[
				"nim" => ["required", "numeric"],
				"password" => ["required"],
				"password2" => ["required", "same:password"]
			]
		);

		if ($validator->fails()) {
			return redirect()->back()->with('status', ["status" => false, "pesan" => "gagal validasi"]);
		}

		$nim = $request->input("nim");
		$password = $request->input("password");
		$mahasiswa = Mahasiswa::where(["nim" => $nim, "verified_at" => null])->first();
		if (!$mahasiswa) {
			return redirect()->back()->with('status', ["status" => false, "pesan" => "nim tidak terdaftar"]);
		}

		$mahasiswa->password = bcrypt($password);
		$mahasiswa->verified_at = Carbon::now();
		if ($mahasiswa->save()) {
			// return redirect("/login-mahasiswa");
			return redirect()->back()->with("status", ["status" => true, "pesan" => "berhasil verifikasi"]);
		} else {
			return redirect()->back()->with("status", ["status" => false, "pesan" => "gagal daftar"]);
		}

	}

	public function index(Request $request)
	{
		return view('mahasiswa.dashboard', [
			"title" => "Dashboard",
			// "mhs" => $request->authM
		]);
	}

}
