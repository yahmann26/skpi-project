@extends('admin.layouts.app')

@section('title', 'Tambah Prodi')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>Program Studi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Prodi</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    <div class="pb-3">
        <a href='{{ url('admin/prodi') }}' class="btn btn-danger">Kembali</a>
    </div>

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Prodi  {{ $prodi->nama_prodi}}</h5>
                    <div class="col-md-6">
                        <label for="text" class="form-label">Nama Prodi : {{ $prodi->nama_prodi}}</label>
                    </div>
                    <div class="col-md-6">
                        <label for="ext" class="form-label">Kode Prodi  : {{ $prodi->kode_prodi}}</label>
                    </div>
                    <div class="col-md-6">
                        <label for="text" class="form-label">Akreditasi : {{ $prodi->akreditasi}}</label>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
