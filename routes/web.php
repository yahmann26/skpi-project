<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController as AdminDasboardController;
use App\Http\Controllers\Admin\PengaturanController as AdminPengaturanController;
use App\Http\Controllers\Admin\JenjangController as AdminJenjangController;
use App\Http\Controllers\Admin\ProdiController as AdminProdiController;
use App\Http\Controllers\Admin\KategoriKegiatanController as AdminKategoriKegiatanController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\MahasiswaController as AdminMahasiswaController;
use App\Http\Controllers\Admin\KaprodiController as AdminKaprodiController;
use App\Http\Controllers\Admin\PtController;
use App\Http\Controllers\Admin\SkpiController as AdminSkpiController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\JenisPendaftaranController as AdminJenisPendaftaranController;
use App\Http\Controllers\Admin\TahunAkademikController as AdminTahunAkademikController;

use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\KegiatanController as MahasiswaKegiatanController;
use App\Http\Controllers\Mahasiswa\UserController as MahasiswaUserController;
use App\Http\Controllers\Mahasiswa\SkpiController as MahasiswaSkpiController;

use App\Http\Controllers\Kaprodi\DashboardController as KaprodiDashboardController;
use App\Http\Controllers\Kaprodi\ProfileController as KaprodiProfileController;
use App\Http\Controllers\Kaprodi\ProdiController as KaprodiProdiController;
use App\Http\Controllers\Kaprodi\KegiatanController as KaprodiKegiatanController;
use App\Http\Controllers\Kaprodi\SkpiController as KaprodiSkpiController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', ['title' => 'SKPI FASTIKOM UNSIQ']);
})->name('welcome');

// Admin

Route::middleware(['isAdmin', 'verified'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminDasboardController::class, 'index'])->name('admin.dashboard');

    // pengaturan
    Route::get('pengaturan', [AdminPengaturanController::class, 'index'])->name('admin.pengaturan.index');
    Route::post('pengaturan', [AdminPengaturanController::class, 'update'])->name('admin.pengaturan.update');

    // profile
    Route::get('user/profil', [AdminUserController::class, 'profile'])->name('admin.user.profile');
    Route::put('user/profil', [AdminUserController::class, 'updateProfile'])->name('admin.user.update-profile');
    Route::get('user/kata-sandi', [AdminUserController::class, 'password'])->name('admin.user.password');
    Route::put('user/kata-sandi', [AdminUserController::class, 'updatePassword'])->name('admin.user.update-password');

    // jenjang
    Route::get('jenjang', [AdminJenjangController::class, 'index'])->name('admin.jenjang.index');
    Route::get('jenjang/tambah', [AdminJenjangController::class, 'create'])->name('admin.jenjang.create');
    Route::post('jenjang', [AdminJenjangController::class, 'store'])->name('admin.jenjang.store');
    Route::get('jenjang/{id}/ubah', [AdminJenjangController::class, 'edit'])->name('admin.jenjang.edit');
    Route::put('jenjang/{id}', [AdminJenjangController::class, 'update'])->name('admin.jenjang.update');
    Route::delete('jenjang/{id}', [AdminJenjangController::class, 'destroy'])->name('admin.jenjang.destroy');

    // prodi
    Route::get('prodi', [AdminProdiController::class, 'index'])->name('admin.prodi.index');
    Route::get('prodi/tambah', [AdminProdiController::class, 'create'])->name('admin.prodi.create');
    Route::post('prodi', [AdminProdiController::class, 'store'])->name('admin.prodi.store');
    Route::get('prodi/{id}/ubah', [AdminProdiController::class, 'edit'])->name('admin.prodi.edit');
    Route::put('prodi/{id}', [AdminProdiController::class, 'update'])->name('admin.prodi.update');
    Route::delete('prodi/{id}', [AdminProdiController::class, 'destroy'])->name('admin.prodi.destroy');

    // prodi CPL (capaian pembelajaran)
    Route::get('prodi/{id}/edit-cpl', [AdminProdiController::class, 'editCpl'])->name('admin.prodi.edit-cpl');
    Route::put('prodi/{id}/cpl', [AdminProdiController::class, 'updateCpl'])->name('admin.prodi.update-cpl');

    //prodi kegiatan default
    Route::get('prodi/{id}/edit-kegiatan', [AdminProdiController::class, 'editKegiatan'])->name('admin.prodi.edit-kegiatan');
    Route::put('prodi/{id}/kegiatan', [AdminProdiController::class, 'updateKegiatan'])->name('admin.prodi.update-kegiatan');



    //kategori kegiatan
    Route::get('kategoriKegiatan', [AdminKategoriKegiatanController::class, 'index'])->name('admin.kategoriKegiatan.index');
    Route::get('kategoriKegiatan/tambah', [AdminKategoriKegiatanController::class, 'create'])->name('admin.kategoriKegiatan.create');
    Route::post('kategoriKegiatan', [AdminKategoriKegiatanController::class, 'store'])->name('admin.kategoriKegiatan.store');
    Route::get('kategoriKegiatan/{id}/ubah', [AdminKategoriKegiatanController::class, 'edit'])->name('admin.kategoriKegiatan.edit');
    Route::put('kategoriKegiatan/{id}', [AdminKategoriKegiatanController::class, 'update'])->name('admin.kategoriKegiatan.update');
    Route::delete('kategoriKegiatan/{id}', [AdminKategoriKegiatanController::class, 'destroy'])->name('admin.kategoriKegiatan.destroy');

    // Tahun Ajaran
    Route::get('thnAkademik', [AdminTahunAkademikController::class, 'index'])->name('admin.thnAkademik.index');
    Route::post('thnAkademik', [AdminTahunAkademikController::class, 'store'])->name('admin.thnAkademik.store');
    Route::get('thnAkademik/{id}/ubah', [AdminTahunAkademikController::class, 'edit'])->name('admin.thnAkademik.edit');
    Route::put('thnAkademik/{id}', [AdminTahunAkademikController::class, 'update'])->name('admin.thnAkademik.update');
    Route::delete('thnAkademik/{id}', [AdminTahunAkademikController::class, 'destroy'])->name('admin.thnAkademik.destroy');


    // kegiatan
    Route::get('kegiatan', [AdminKegiatanController::class, 'index'])->name('admin.kegiatan.index');
    Route::post('kegiatan', [AdminKegiatanController::class, 'store'])->name('admin.kegiatan.store');
    Route::get('kegiatan/{id}/ubah', [AdminKegiatanController::class, 'edit'])->name('admin.kegiatan.edit');
    Route::get('kegiatan/{id}/lihat', [AdminKegiatanController::class, 'show'])->name('admin.kegiatan.show');
    Route::put('kegiatan/{id}/status', [AdminKegiatanController::class, 'updateStatus'])->name('admin.kegiatan.update-status');
    Route::put('kegiatan/{id}', [AdminKegiatanController::class, 'update'])->name('admin.kegiatan.update');
    Route::delete('kegiatan/{id}', [AdminKegiatanController::class, 'destroy'])->name('admin.kegiatan.destroy');
    Route::get('kegiatan/cetak', [AdminKegiatanController::class, 'cetak'])->name('admin.kegiatan.cetak');
    Route::get('tahun-akademik/{semester_id}', [AdminKegiatanController::class, 'getTahunAkademikBySemester']);
    Route::post('kegiatan/cetakSemester', [AdminKegiatanController::class, 'cetakSemester'])->name('admin.kegiatan.cetakSemester');
    Route::post('kegiatan/cetakTranskip', [AdminKegiatanController::class, 'cetakTranskip'])->name('admin.kegiatan.cetakTranskip');



    // jenis pendaftaran
    Route::get('jenisPendaftaran', [AdminJenisPendaftaranController::class, 'index'])->name('admin.jenisPendaftaran.index');
    Route::post('jenisPendaftaran', [AdminJenisPendaftaranController::class, 'store'])->name('admin.jenisPendaftaran.store');
    Route::get('jenisPendaftaran/{id}/ubah', [AdminJenisPendaftaranController::class, 'edit'])->name('admin.jenisPendaftaran.edit');
    Route::put('jenisPendaftaran/{id}', [AdminJenisPendaftaranController::class, 'update'])->name('admin.jenisPendaftaran.update');
    Route::delete('/jenisPendaftaran/{id}', [AdminJenisPendaftaranController::class, 'destroy'])->name('admin.jenisPendaftaran.destroy');


    // Mahasiswa
    Route::get('mahasiswa', [AdminMahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
    Route::get('mahasiswa/tambah', [AdminMahasiswaController::class, 'create'])->name('admin.mahasiswa.create');
    Route::post('mahasiswa', [AdminMahasiswaController::class, 'store'])->name('admin.mahasiswa.store');
    Route::get('mahasiswa/{id}/ubah', [AdminMahasiswaController::class, 'edit'])->name('admin.mahasiswa.edit');
    Route::put('mahasiswa/{id}', [AdminMahasiswaController::class, 'update'])->name('admin.mahasiswa.update');
    Route::delete('mahasiswa/{id}', [AdminMahasiswaController::class, 'destroy'])->name('admin.mahasiswa.destroy');
    Route::get('mahasiswa/{id}/reset-password', [AdminMahasiswaController::class, 'resetPassword'])->name('admin.mahasiswa.reset-password');
    Route::get('mahasiswa/download', [AdminMahasiswaController::class, 'download'])->name('admin.mahasiswa.download');
    Route::post('mahasiswa/import', [AdminMahasiswaController::class, 'import'])->name('admin.mahasiswa.import');

    // Kaprodi
    Route::get('kaprodi', [AdminKaprodiController::class, 'index'])->name('admin.kaprodi.index');
    Route::get('kaprodi/tambah', [AdminKaprodiController::class, 'create'])->name('admin.kaprodi.create');
    Route::post('kaprodi', [AdminKaprodiController::class, 'store'])->name('admin.kaprodi.store');
    Route::get('kaprodi/{id}/ubah', [AdminKaprodiController::class, 'edit'])->name('admin.kaprodi.edit');
    Route::put('kaprodi/{id}', [AdminKaprodiController::class, 'update'])->name('admin.kaprodi.update');
    Route::delete('kaprodi/{id}', [AdminKaprodiController::class, 'destroy'])->name('admin.kaprodi.destroy');
    Route::get('kaprodi/{id}/reset-password', [AdminKaprodiController::class, 'resetPassword'])->name('admin.kaprodi.reset-password');

    //admin
    Route::get('admin', [AdminController::class, 'index'])->name('admin.admin.index');
    Route::get('admin/tambah', [AdminController::class, 'create'])->name('admin.admin.create');
    Route::post('admin', [AdminController::class, 'store'])->name('admin.admin.store');
    Route::get('admin/{id}/ubah', [AdminController::class, 'edit'])->name('admin.admin.edit');
    Route::put('admin/{id}', [AdminController::class, 'update'])->name('admin.admin.update');
    Route::delete('admin/{id}', [AdminController::class, 'destroy'])->name('admin.admin.destroy');
    Route::get('admin/{id}/reset-password', [AdminController::class, 'resetPassword'])->name('admin.admin.reset-password');

    // pt
    Route::get('pt', [PtController::class, 'index'])->name('admin.pt.index');
    Route::get('pt/tambah', [PtController::class, 'create'])->name('admin.pt.create');
    Route::post('pt', [PtController::class, 'store'])->name('admin.pt.store');
    Route::get('pt/{id}/ubah', [PtController::class, 'edit'])->name('admin.pt.edit');
    Route::put('pt/{id}', [PtController::class, 'update'])->name('admin.pt.update');
    Route::delete('pt/{id}', [PtController::class, 'destroy'])->name('admin.pt.destroy');

    // skpi
    Route::get('skpi', [AdminSkpiController::class, 'index'])->name('admin.skpi.index');
    Route::post('skpi/tambah/periode', [AdminSkpiController::class, 'store'])->name('admin.periode.store');
    Route::get('skpi/{id}/lihat', [AdminSkpiController::class, 'show'])->name('admin.skpi.show');
    Route::get('skpi/download', [AdminSkpiController::class, 'download'])->name('admin.skpi.download');
    Route::post('skpi/import{periodeId}', [AdminSkpiController::class, 'import'])->name('admin.skpi.import');
    Route::get('skpi/{id}/ubah', [AdminSkpiController::class, 'edit'])->name('admin.skpi.edit');
    Route::delete('skpi/{id}', [AdminSkpiController::class, 'destroy'])->name('admin.skpi.destroy');
    Route::get('skpi/cetak/{ids}', [AdminSkpiController::class, 'cetak'])->name('admin.skpi.cetak');
});

/* MAHASISWA */
Route::middleware(['isMahasiswa', 'verified'])->prefix('mahasiswa')->group(function () {
    Route::get('dashboard', [MahasiswaDashboardController::class, 'index'])->name('mahasiswa.dashboard');

    // user
    Route::get('profil', [MahasiswaUserController::class, 'profile'])->name('mahasiswa.user.profile');
    Route::put('profil', [MahasiswaUserController::class, 'updateProfile'])->name('mahasiswa.user.update-profile');
    Route::get('kata-sandi', [MahasiswaUserController::class, 'password'])->name('mahasiswa.user.password');
    Route::put('kata-sandi', [MahasiswaUserController::class, 'updatePassword'])->name('mahasiswa.user.update-password');

    // mahasiswa kegiatan
    Route::get('kegiatan', [MahasiswaKegiatanController::class, 'index'])->name('mahasiswa.kegiatan.index');
    Route::get('kegiatan/tambah', [MahasiswaKegiatanController::class, 'create'])->name('mahasiswa.kegiatan.create');
    Route::get('tahun-akademik/{semester_id}', [MahasiswaKegiatanController::class, 'getTahunAkademikBySemester']);
    Route::post('kegiatan', [MahasiswaKegiatanController::class, 'store'])->name('mahasiswa.kegiatan.store');
    Route::get('kegiatan/{id}/lihat', [MahasiswaKegiatanController::class, 'show'])->name('mahasiswa.kegiatan.show');
    Route::get('kegiatan/{id}/ubah', [MahasiswaKegiatanController::class, 'edit'])->name('mahasiswa.kegiatan.edit');
    Route::put('kegiatan/{id}', [MahasiswaKegiatanController::class, 'update'])->name('mahasiswa.kegiatan.update');
    Route::delete('kegiatan/{id}', [MahasiswaKegiatanController::class, 'destroy'])->name('mahasiswa.kegiatan.destroy');
    Route::get('kegiatan/cetak', [MahasiswaKegiatanController::class, 'cetak'])->name('mahasiswa.kegiatan.cetak');
    Route::post('kegiatan/cetakSemester', [MahasiswaKegiatanController::class, 'cetakSemester'])->name('mahasiswa.kegiatan.cetakSemester');
    Route::post('kegiatan/cetakTranskip', [MahasiswaKegiatanController::class, 'cetakTranskip'])->name('mahasiswa.kegiatan.cetakTranskip');



    // SKPI
    Route::get('skpi', [MahasiswaSkpiController::class, 'index'])->name('mahasiswa.skpi.index');
    Route::get('skpi/cetak', [MahasiswaSkpiController::class, 'cetak'])->name('mahasiswa.skpi.cetak');
});



/* Kaprodi */
Route::middleware(['isKaprodi', 'verified'])->prefix('kaprodi')->group(function () {
    Route::get('dashboard', [KaprodiDashboardController::class, 'index'])->name('kaprodi.dashboard');

    // Profile
    Route::get('profil', [KaprodiProfileController::class, 'profile'])->name('kaprodi.user.profile');
    Route::put('profil', [KaprodiProfileController::class, 'updateProfile'])->name('kaprodi.user.update-profile');
    Route::get('kata-sandi', [KaprodiProfileController::class, 'password'])->name('kaprodi.user.password');
    Route::put('kata-sandi', [KaprodiProfileController::class, 'updatePassword'])->name('kaprodi.user.update-password');

    // mahasiswa kegiatan
    Route::get('kegiatan', [KaprodiKegiatanController::class, 'index'])->name('kaprodi.kegiatan.index');
    Route::get('kegiatan/tambah', [KaprodiKegiatanController::class, 'create'])->name('kaprodi.kegiatan.create');
    Route::post('kegiatan', [KaprodiKegiatanController::class, 'store'])->name('kaprodi.kegiatan.store');
    Route::get('kegiatan/{id}/lihat', [KaprodiKegiatanController::class, 'show'])->name('kaprodi.kegiatan.show');
    Route::get('kegiatan/{id}/ubah', [KaprodiKegiatanController::class, 'edit'])->name('kaprodi.kegiatan.edit');
    Route::put('kegiatan/{id}/status', [KaprodiKegiatanController::class, 'updateStatus'])->name('kaprodi.kegiatan.update-status');
    Route::put('kegiatan/{id}', [KaprodiKegiatanController::class, 'update'])->name('kaprodi.kegiatan.update');
    Route::delete('kegiatan/{id}', [KaprodiKegiatanController::class, 'destroy'])->name('kaprodi.kegiatan.destroy');
    Route::get('tahun-akademik/{semester_id}', [KaprodiKegiatanController::class, 'getTahunAkademikBySemester']);
    Route::get('kegiatan/cetak', [KaprodiKegiatanController::class, 'cetak'])->name('kaprodi.kegiatan.cetak');
    Route::post('kegiatan/cetakSemester', [KaprodiKegiatanController::class, 'cetakSemester'])->name('kaprodi.kegiatan.cetakSemester');
    Route::post('kegiatan/cetakTranskip', [KaprodiKegiatanController::class, 'cetakTranskip'])->name('kaprodi.kegiatan.cetakTranskip');

    // prodi

    Route::get('prodi', [KaprodiProdiController::class, 'index'])->name('kaprodi.prodi.index');
    Route::get('/prodi/{id}/ubah', [KaprodiProdiController::class, 'edit'])->name('kaprodi.prodi.edit');
    Route::put('/prodi/{id}', [KaprodiProdiController::class, 'update'])->name('kaprodi.prodi.update');

    // prodi CPL (capaian pembelajaran)
    Route::get('/prodi/{id}/edit-cpl', [KaprodiProdiController::class, 'editCpl'])->name('kaprodi.prodi.edit-cpl');
    Route::put('/prodi/{id}/cpl', [KaprodiProdiController::class, 'updateCpl'])->name('kaprodi.prodi.update-cpl');

    //prodi kegiatan default
    Route::get('prodi/{id}/edit-kegiatan', [KaprodiProdiController::class, 'editKegiatan'])->name('kaprodi.prodi.edit-kegiatan');
    Route::put('prodi/{id}/kegiatan', [KaprodiProdiController::class, 'updateKegiatan'])->name('kaprodi.prodi.update-kegiatan');

    // SKPI
    Route::get('skpi', [KaprodiSkpiController::class, 'index'])->name('kaprodi.skpi.index');
    Route::get('skpi/{id}/lihat', [KaprodiSkpiController::class, 'show'])->name('kaprodi.skpi.show');
    Route::get('skpi/cetak/{ids}', [KaprodiSkpiController::class, 'cetak'])->name('kaprodi.skpi.cetak');
    Route::post('skpi/tambah/periode', [KaprodiSkpiController::class, 'store'])->name('kaprodi.periode.store');
    Route::get('skpi/download', [KaprodiSkpiController::class, 'download'])->name('kaprodi.skpi.download');
    Route::post('skpi/import{periodeId}', [KaprodiSkpiController::class, 'import'])->name('kaprodi.skpi.import');
    Route::delete('skpi/{id}', [KaprodiSkpiController::class, 'destroy'])->name('kaprodi.skpi.destroy');

});

require __DIR__ . '/auth.php';
