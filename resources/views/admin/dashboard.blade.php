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

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12 col-md-8 col-sm-12 ">
                <div class="row">
                    @include('admin.components.card', ['title' => 'Total Mahasiswa', 'icon' => 'bi bi-person-fill', 'count' => $jumlahMahasiswa, 'subtitle' => 'Mahasiswa'])
                    @include('admin.components.card', ['title' => 'Total Dosen', 'icon' => 'bi bi-person', 'count' => $jumlahDosen, 'subtitle' => 'Dosen'])
                    @include('admin.components.card', ['title' => 'Total Prodi', 'icon' => 'bi bi-bookmarks', 'count' => $jumlahProdi, 'subtitle' => 'Program Studi'])
                    @include('admin.components.card', ['title' => 'Total Kategori kegiatan', 'icon' => 'bi bi-journals', 'count' => $jumlahKategori, 'subtitle' => 'Kategori'])
                    @include('admin.components.card', ['title' => 'Total Data Kegiatan', 'icon' => 'bi bi-journal-text', 'count' => $jumlahKegiatan, 'subtitle' => 'Data Kegiatan'])
                </div>
            </div>
        </div>
    </section>

@endsection

