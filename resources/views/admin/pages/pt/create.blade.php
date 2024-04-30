@extends('admin.layouts.app')

@section('title', 'Tambah PT')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>Pendidikan Tinggi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Admin</a></li>
                <li class="breadcrumb-item active">PT</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="pb-3">
        <a href='{{ url('admin/pt') }}' class="btn btn-danger">Kembali</a>
    </div>

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah Pendidikan Tinggi</h5>

                    <form class="row g-3" action="{{ url('admin/kategori') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Sistem PT</label>
                            <div class="col-sm-9" >
                                <textarea class="form-control @error('sistem_pt') is-invalid @enderror" name="sistem_pt"
                                    id="sistem_pt" style="height: 100px">
                            </textarea>
                                @error('sistem_pt')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">KKNI</label>
                            <div class="col-sm-9" >
                                <textarea class="form-control @error('kkni') is-invalid @enderror" name="kkni"
                                    id="kkni" style="height: 100px">
                            </textarea>
                                @error('kkni')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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
