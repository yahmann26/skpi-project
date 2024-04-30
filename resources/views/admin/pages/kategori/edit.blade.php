@extends('admin.layouts.app')

@section('title', 'Edit Kategori')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>Kategori Kegiatan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Admin</a></li>
                <li class="breadcrumb-item active">Kategori</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    <div class="pb-3">
        <a href='{{ url('admin/kategori') }}' class="btn btn-danger">Kembali</a>
    </div>

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Edit Kategori</h5>
                    <form class="row g-3" action="{{ url('admin/kategori/'.$kategori->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="inputText" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                                name="nama_kategori" value="{{ $kategori->nama_kategori }}" id="nama_kategori">
                            @error('nama_kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
