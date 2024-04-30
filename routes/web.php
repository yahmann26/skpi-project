<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CpController;
use App\Http\Controllers\Admin\DosenController as AdminDosenController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Admin\PtController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dosen\DosenController;
use App\Http\Controllers\Mahasiswa\KegiatanController;
use App\Http\Controllers\Mahasiswa\MahasiswaController as MahasiswaMahasiswaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/ckeditor', function() {
    return view('ckeditor');
});

// admin
Route::get('/login-admin', [AdminController::class, 'login']);
Route::post('/login-admin', [AdminController::class, 'loginPost']);
Route::get('/logout-admin', [AdminController::class, 'logout']);

Route::prefix('admin')->middleware(['AdminMiddleware'])->group(function(){
    Route::resource('dashboard', AdminController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('prodi', ProdiController::class);
    Route::resource('dosen', AdminDosenController::class);
    Route::resource('cp', CpController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('kegiatan', AdminKegiatanController::class);
    Route::resource('pt', PtController::class);
});


// Mahasiswa
Route::get('/login-mahasiswa', [MahasiswaMahasiswaController::class, 'login']);
Route::get('/logout-mahasiswa', [MahasiswaMahasiswaController::class, 'logout']);
Route::post('/login-mahasiswa', [MahasiswaMahasiswaController::class, 'loginPost']);
Route::get('/verifikasi-mahasiswa', [MahasiswaMahasiswaController::class, 'verifikasi']);
Route::post('/verifikasi-mahasiswa', [MahasiswaMahasiswaController::class, 'verifikasiPost']);

Route::prefix('mahasiswa')->middleware(['MahasiswaMiddleware'])->group(function(){
    Route::get('dashboard', [MahasiswaMahasiswaController::class, 'index']);
    Route::resource('kegiatan', KegiatanController::class);
});


// dosen

Route::get('/login-dosen', [DosenController::class, 'login']);
Route::get('/logout-dosen', [DosenController::class, 'logout']);
Route::post('/login-dosen', [DosenController::class, 'loginPost']);
Route::get('/verifikasi-dosen', [DosenController::class, 'verifikasi']);
Route::post('/verifikasi-dosen', [DosenController::class, 'verifikasiPost']);
