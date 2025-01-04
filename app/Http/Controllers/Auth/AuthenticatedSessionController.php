<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View|RedirectResponse
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'kaprodi') {
                return redirect()->route('kaprodi.dashboard');
            } elseif ($user->role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            }
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->validate([
            'uid' => ['required'],
            'password' => ['required'],
        ]);

        // Cek apakah user dengan UID ada
        $user = User::where('uid', $request->uid)->first();

        // Jika user tidak ada
        if (!$user) {
            return back()->withErrors([
                'uid' => 'Username salah',
            ]);
        }

        // Coba login menggunakan Auth::attempt dan cek password
        if (Auth::attempt(['uid' => $request->uid, 'password' => $request->password])) {
            $request->session()->regenerate();

            // Redirect berdasarkan role user
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'kaprodi') {
                return redirect()->route('kaprodi.dashboard');
            } elseif ($user->role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            }
        }

        // Jika password salah
        return back()->withErrors([
            'password' => 'Password salah',
        ]);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
