<?php

namespace App\Http\Middleware;

use App\Models\Mahasiswa;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
	{
		$kuki = $request->cookie("mahasiswa");
		if (!$kuki) return redirect("/login-mahasiswa");
		$db = Mahasiswa::where(["token" => $kuki])->first();
		if (!$db) return redirect("/login-mahasiswa")->withoutCookie("mahasiswa");
		return $next($request->merge(['authM' => $db->toArray()]));
	}
}
