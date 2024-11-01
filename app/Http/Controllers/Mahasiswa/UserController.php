<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = Auth::user();
        
        return view('mahasiswa.pages.user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                'unique:users,email,' . Auth::id(),
            ],
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah digunakan',
        ]);

        $user = Auth::user();

        User::find($user->id)->update([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => [
                'required',
                'string',
                'max:100',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:100',
                'confirmed',
            ],
        ], [
            'old_password.required' => 'Kata sandi lama tidak boleh kosong',
            'old_password.string' => 'Kata sandi lama harus berupa string',
            'old_password.min' => 'Kata sandi lama minimal :min karakter',
            'old_password.max' => 'Kata sandi lama maksimal :max karakter',
            'password.required' => 'Kata sandi baru tidak boleh kosong',
            'password.string' => 'Kata sandi baru harus berupa string',
            'password.min' => 'Kata sandi baru minimal :min karakter',
            'password.max' => 'Kata sandi baru maksimal :max karakter',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok',
        ]);

        $user = Auth::user();

        if (!password_verify($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'Kata sandi lama tidak cocok');
        }

        User::find($user->id)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui');
    }
}
