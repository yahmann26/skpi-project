@extends('admin.layout.app')

@section('title', 'Cetak Kegiatan')

@push('style')
    <link href="{{ asset('assets/vendor/simple-datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
@endpush

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item ">Kegiatan</li>
                <li class="breadcrumb-item active">Cetak</li>
            </ol>
        </nav>
    </div>


    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card overflow-auto">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-title">Cetak Kegiatan</div>
                        </div>

                        Halaman cetak kegiatan

                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
