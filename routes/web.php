<?php

use App\Http\Controllers\Admin\DashboardController as AdminDasboardController;
use App\Http\Controllers\Admin\PengaturanController as AdminPengaturanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin

Route::middleware(['isAdmin', 'verified'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminDasboardController::class, 'index'])->name('admin.dashboard');

    // pengaturan
    Route::get('/pengaturan', [AdminPengaturanController::class, 'index'])->name('admin.pengaturan.index');
    Route::post('/pengaturan', [AdminPengaturanController::class, 'update'])->name('admin.pengaturan.update');

    // Route::get('user', [AdminDasboardController::class, 'getData'])->name('admin.user');
    // Route::get('mahasiswa', [AdminMahasiswaController::class, 'index'])->name('admin.mahasiswa');
    // Route::get('mahasiswa/{id}/lihat', [AdminMahasiswaController::class, 'show'])->name('admin.mahasiswa.show');
    // Route::get('pengaturan', [AdminPengaturanController::class, 'index'])->name('admin.pengaturan');
    // Route::post('pengaturan', [AdminPengaturanController::class, 'update'])->name('admin.pengaturan.update');

    // // jenjang
    // Route::get('jenjang', [AdminJenjangController::class, 'index'])->name('admin.jenjang.index');
    // Route::get('getjenjang', [AdminJenjangController::class, 'getJenjang'])->name('admin.jenjang');
    // Route::get('jenjang/tambah', [AdminJenjangController::class, 'create'])->name('admin.jenjang.create');
    // Route::post('jenjang', [AdminJenjangController::class, 'store'])->name('admin.jenjang.store');
    // Route::get('jenjang/{id}/ubah', [AdminJenjangController::class, 'edit'])->name('admin.jenjang.edit');
    // Route::get('jenjang/{id}/lihat', [AdminJenjangController::class, 'show'])->name('admin.jenjang.show');
    // Route::put('jenjang/{id}', [AdminJenjangController::class, 'update'])->name('admin.jenjang.update');
    // Route::delete('jenjang/{id}', [AdminJenjangController::class, 'destroy'])->name('admin.jenjang.destroy');

    // // prodi
    // Route::get('prodi', [AdminProdiController::class, 'index'])->name('admin.prodi.index');
    // Route::get('getProdi', [AdminProdiController::class, 'getProdi'])->name('admin.prodi');
    // Route::get('/prodi/tambah', [AdminProdiController::class, 'create'])->name('admin.prodi.create');
    // Route::post('/prodi', [AdminProdiController::class, 'store'])->name('admin.prodi.store');
    // Route::get('/prodi/{id}/ubah', [AdminProdiController::class, 'edit'])->name('admin.prodi.edit');
    // Route::get('/prodi/{id}/lihat', [AdminProdiController::class, 'show'])->name('admin.prodi.show');
    // Route::put('/prodi/{id}', [AdminProdiController::class, 'update'])->name('admin.prodi.update');
    // Route::delete('/prodi/{id}', [AdminProdiController::class, 'destroy'])->name('admin.prodi.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
