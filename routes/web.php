<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Dosen\DosenController;
use App\Http\Controllers\Mahasiswa\KegiatanController as MahasiswaKegiatanController;
use App\Http\Controllers\Mahasiswa\PengajuanController as MahasiswaPengajuanController;
use App\Http\Controllers\Mahasiswa\MahasiswaController;
use App\Http\Controllers\Admin\CpController as AdminCpCOntroller;
use App\Http\Controllers\Admin\PtController as AdminPtController;
use App\Http\Controllers\Admin\DosenController as AdminDosenController;
use App\Http\Controllers\Admin\ProdiController as AdminProdiController;
use App\Http\Controllers\Admin\KategoriController as AdminKategoriController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\MahasiswaController as AdminMahasiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome', [
        "title" => "SKPI FASTIKOM UNSIQ"
    ]);
});

// admin
Route::get('/login-admin', [AdminController::class, 'login']);
Route::post('/login-admin', [AdminController::class, 'loginPost']);
Route::get('/logout-admin', [AdminController::class, 'logout']);

Route::prefix('admin')->middleware(['AdminMiddleware'])->group(function(){
    Route::resource('dashboard', AdminController::class);
    Route::resource('mahasiswa', AdminMahasiswaController::class);
    Route::resource('prodi', AdminProdiController::class);
    Route::resource('dosen', AdminDosenController::class);
    Route::resource('cp', AdminCpController::class);
    Route::resource('kategori', AdminKategoriController::class);
    Route::resource('kegiatan', AdminKegiatanController::class);
    Route::resource('pt', AdminPtController::class);
});


// Mahasiswa
Route::get('/login-mahasiswa', [MahasiswaController::class, 'login']);
Route::get('/logout-mahasiswa', [MahasiswaController::class, 'logout']);
Route::post('/login-mahasiswa', [MahasiswaController::class, 'loginPost']);
Route::get('/verifikasi-mahasiswa', [MahasiswaController::class, 'verifikasi']);
Route::post('/verifikasi-mahasiswa', [MahasiswaController::class, 'verifikasiPost']);

Route::prefix('mahasiswa')->middleware(['MahasiswaMiddleware'])->group(function(){
    Route::get('dashboard', [MahasiswaController::class, 'index']);
    // Route::resource('kegiatan', MahasiswaKegiatanController::class);
    Route::resource('pengajuan', MahasiswaPengajuanController::class);
});


// dosen
Route::get('/login-dosen', [DosenController::class, 'login']);
Route::get('/logout-dosen', [DosenController::class, 'logout']);
Route::post('/login-dosen', [DosenController::class, 'loginPost']);
Route::get('/verifikasi-dosen', [DosenController::class, 'verifikasi']);
Route::post('/verifikasi-dosen', [DosenController::class, 'verifikasiPost']);

