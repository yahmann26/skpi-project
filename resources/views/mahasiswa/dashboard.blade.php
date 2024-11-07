@extends('mahasiswa.layout.app')

@section('title', 'Dashboard')

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}"><i class="bi bi-house-door"></i></a>
                </li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            {{-- <h1>Welcome {{ Auth::user()->mahasiswa->nama }} !!!</h1> --}}

            <div class="col-lg-12 col-md-8 col-sm-12 ">
                <div class="row">
                    @include('mahasiswa.components.card', [
                        'title' => 'Total Kegiatan',
                        'icon' => 'bi bi-journals',
                        'count' => $jmlKegiatan,
                        'subtitle' => 'Kegiatan',
                    ])
                    @include('mahasiswa.components.card', [
                        'title' => 'Total Kegiatan Divalidasi',
                        'icon' => 'bi bi-journal-text',
                        'count' => $jmlKegiatanValidasi,
                        'subtitle' => 'Data Kegiatan',
                    ])
                    @include('mahasiswa.components.card', [
                        'title' => 'Total Kegiatan Ditolak',
                        'icon' => 'bi bi-journal-x',
                        'count' => $jmlKegiatanTolak,
                        'subtitle' => 'Data Kegiatan',
                    ])
                </div>
            </div>
        </div>
    </section>

@endsection
