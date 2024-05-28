@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('main')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12 col-md-8 col-sm-12 ">
                <div class="row">

                    <!-- Mahasiswa Card -->
                    <div class="col-xl-4 col-md-6">
                        <a href="{{ url('mahasiswa') }}"></a>
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Mahasiswa</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>16</h6>
                                        <span class="text-muted pt-2 ps-1">Mahasiswa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Mahasiswa Card -->

                    <!-- Dosen Card -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Dosen</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>18</h6>
                                        <span class="text-muted pt-2 ps-1">Dosen</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Dosen Card -->

                    <!-- Prodi Card -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Prodi</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-bookmarks"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>5</h6>
                                        <span class="text-muted pt-2 ps-1">Program Studi</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Prodi Card -->

                    <!-- kategori Card -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Kategori kegiatan</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-journals"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>5</h6>
                                        <span class="text-muted pt-2 ps-1">Kategori</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Kategori Card -->

                    <!-- Data Kegiatan Card -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Data Kegiatan</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-journal-text"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>81</h6>
                                        <span class="text-muted pt-2 ps-1">Data Kegiatan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Kegiatan Card -->
                </div>
            </div>
        </div>
    </section>

@endsection
