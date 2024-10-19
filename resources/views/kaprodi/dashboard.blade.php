@extends('kaprodi.layout.app')

@section('title', 'Dashboard')

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('kaprodi.dashboard') }}"><i class="bi bi-house-door"></i></a>
                </li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <h1>Selamat Datang {{ Auth::user()->kaprodi->nama }} !!!</h1>
            {{-- <div class="col-lg-12 col-md-8 col-sm-12 ">
                <div class="row">
                    @include('admin.components.card', [
                        'title' => 'Total dosen',
                        'icon' => 'bi bi-person-fill',
                        'count' => $jmlMahasiswa,
                        'subtitle' => 'Mahasiswa',
                    ])
                    @include('admin.components.card', [
                        'title' => 'Total Dosen',
                        'icon' => 'bi bi-person',
                        'count' => $jmlDosen,
                        'subtitle' => 'Dosen',
                    ])
                    @include('admin.components.card', [
                        'title' => 'Total Prodi',
                        'icon' => 'bi bi-bookmarks',
                        'count' => $jmlProdi,
                        'subtitle' => 'Program Studi',
                    ])
                    @include('admin.components.card', [
                        'title' => 'Total Kategori kegiatan',
                        'icon' => 'bi bi-journals',
                        'count' => $jmlKategori,
                        'subtitle' => 'Kategori',
                    ])
                    @include('admin.components.card', [
                        'title' => 'Total Data Kegiatan',
                        'icon' => 'bi bi-journal-text',
                        'count' => $jmlKegiatan,
                        'subtitle' => 'Data Kegiatan',
                    ])
                </div>
            </div> --}}
        </div>
    </section>

@endsection
