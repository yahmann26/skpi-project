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

            {{-- <h1>Selamat Datang {{ Auth::user()->kaprodi->nama }} !!!</h1> --}}
            <div class="col-lg-12 col-md-8 col-sm-12 ">
                <div class="row">
                    @include('kaprodi.components.card', [
                        'title' => 'Total Mahasiswa',
                        'icon' => 'bi bi-person-fill',
                        'count' => $jmlMhs,
                        'subtitle' => 'Mahasiswa',
                    ])
                    @include('kaprodi.components.card', [
                        'title' => 'Total Pengajuan Kegiatan',
                        'icon' => 'bi bi-journals',
                        'count' => $jmlKegiatan,
                        'subtitle' => 'Kegiatan',
                    ])

                    @include('kaprodi.components.card', [
                        'title' => 'Total Kegiatan Divalidasi',
                        'icon' => 'bi bi-journal-text',
                        'count' => $jmlKegiatanValidasi,
                        'subtitle' => 'Kegiatan',
                    ])
                    @include('kaprodi.components.card', [
                        'title' => 'Total Kegiatan Ditolak',
                        'icon' => 'bi bi-journal-x',
                        'count' => $jmlKegiatanTolak,
                        'subtitle' => ' Kegiatan',
                    ])
                </div>
            </div>
        </div>
    </section>

@endsection
