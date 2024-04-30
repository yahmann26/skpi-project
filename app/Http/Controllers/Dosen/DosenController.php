<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DosenController extends Controller
{
    public function logout()
	{
		return redirect("/login-dosen")->withoutCookie("dosen");
	}

    public function login(Request $request)
    {
        $kuki = $request->cookie("dosen");
        if ($kuki) {
            $db = Dosen::where(["token" => $kuki])->first();
            if ($db) {
                return redirect("/dashboard");
            }
        }
        return view('dosen/login-dosen');
    }

	public function loginPost(Request $request)
	{
		//ngecek nim mahasiswa
		$dosen = Dosen::where(['kode_dosen' => $request->input("kode_dosen")])->first();
		if (!$dosen) return redirect("/login-dosen")->with('status', 'Kode Dosen atau Password Salah');

		// ngecek password
		$password = Hash::check($request->input("password"), $dosen->password);
		if (!$password) return redirect("/login-dosen")->with('status', 'Password Salah');

		// update token login
		$token = Str::random(10);
		$dosen->token = $token;
		return $dosen->save() ? redirect("/dashboard")->withCookie("dosen", $token, Carbon::tomorrow()->diffInMinutes(Carbon::now())) : redirect("/login-dosen")->with('status', 'gagal login');
	}

	public function verifikasi()
	{
		return view('dosen/verifikasi-dosen', [
			"title" => "Daftar Akun"

		]);
	}

	public function verifikasiPost(Request $request)
	{
		$validator = Validator::make(
			$request->only(["kode_dosen", "password", "password2",]),
			[
				"kode_dosen" => ["required", "numeric"],
				"password" => ["required"],
				"password2" => ["required", "same:password"]
			]
		);

		if ($validator->fails()) {
			return redirect()->back()->with('status', ["status" => false, "pesan" => "gagal validasi"]);
		}

		$kode_dosen = $request->input("kode_dosen");
		$password = $request->input("password");
		$dosen = Dosen::where(["kode_dosen" => $kode_dosen, "verified_at" => null])->first();
		if (!$dosen) {
			return redirect()->back()->with('status', ["status" => false, "pesan" => "kode dosen tidak terdaftar"]);
		}

		$dosen->password = bcrypt($password);
		$dosen->verified_at = Carbon::now();
		if ($dosen->save()) {
			// return redirect("/login-mahasiswa");
			return redirect()->back()->with("status", ["status" => true, "pesan" => "berhasil verifikasi"]);
		} else {
			return redirect()->back()->with("status", ["status" => false, "pesan" => "gagal daftar"]);
		}

	}

	public function index(Request $request)
	{
		return view('dosen.dashboard', [
			"title" => "Home",
			"dosen" => $request->authD
		]);
	}

}
