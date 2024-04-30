@extends('mahasiswa.layouts.app')

@section('title', 'Dashboard')

@section('main')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('mahasiswa/dashboard')}}">Mahasiswa</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12 col-md-8 col-sm-12 ">
                <div class="row">

                    <!-- Pengajuan Card -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Pengajuan</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi bi-journals"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>
                                        <span class="text-muted pt-2 ps-1">Pengajuan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Pengajuan Card -->
                    <!-- Pengajuan Card -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Divalidasi</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi bi-journals"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>15</h6>
                                        <span class="text-muted pt-2 ps-1">Divalidasi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Pengajuan Card -->
                    <!-- Pengajuan Card -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Ditolak</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi bi-journals"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>
                                        <span class="text-muted pt-2 ps-1">Ditolak</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Pengajuan Card -->
                    <!-- Pengajuan Card -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Poin</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi bi-journals"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>
                                        <span class="text-muted pt-2 ps-1">Poin</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Pengajuan Card -->



                </div>
            </div>
        </div>
    </section>

@endsection
