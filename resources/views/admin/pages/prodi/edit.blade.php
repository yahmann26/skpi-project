@extends('admin.layouts.app')

@section('title', 'Tambah Prodi')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>Program Studi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
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
                    <h5 class="card-title">Form Edit Prodi</h5>
                    <form class="row g-3" action="{{ url('admin/prodi/'.$prodi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="inputText" class="form-label">Kode Prodi</label>
                            <input type="text" class="form-control  @error('kode_prodi') is-invalid @enderror"
                                name="kode_prodi" value="{{ $prodi->kode_prodi }}" id="kode_prodi">
                            @error('kode_prodi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="inputText" class="form-label">Nama Prodi</label>
                            <input type="text" class="form-control @error('nama_prodi') is-invalid @enderror"
                                name="nama_prodi" value="{{ $prodi->nama_prodi }}" id="nama_prodi">
                            @error('nama_prodi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="inputText" class="form-label">Bahasa Pengantar Kuliah</label>
                            <input type="text"
                                class="form-control @error('bahasa_pengantar_kuliah') is-invalid @enderror"
                                name="bahasa_pengantar_kuliah" value="{{ $prodi->bahasa_pengantar_kuliah }}"
                                id="bahasa_pengantar_kuliah">
                            @error('bahasa_pengantar_kuliah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="inputText" class="form-label">Sistem Penilaian</label>
                            <input type="text" class="form-control @error('sistem_penilaian') is-invalid @enderror"
                                name="sistem_penilaian" value="{{ $prodi->sistem_penilaian }}"
                                id="sistem_penilaian">
                            @error('sistem_penilaian')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="inputText" class="form-label">Akreditasi</label>
                            <input type="text" class="form-control @error('akreditasi') is-invalid @enderror"
                                name="akreditasi" value="{{ $prodi->akreditasi }}" id="akreditasi">
                            @error('akreditasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="inputText" class="form-label">SK Akreditasi</label>
                            <input type="text" class="form-control @error('sk_akreditasi') is-invalid @enderror"
                                name="sk_akreditasi" value="{{ $prodi->sk_akreditasi }}" id="sk_akreditasi">
                            @error('sk_akreditasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="inputText" class="form-label">Gelar</label>
                            <input type="text" class="form-control @error('gelar') is-invalid @enderror" name="gelar"
                                value="{{ $prodi->gelar }}" id="gelar">
                            @error('gelar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="inputText" class="form-label">Jenis & Program Pendidikan</label>
                            <input type="text"
                                class="form-control @error('jenis_program_pendidikan') is-invalid @enderror"
                                name="jenis_program_pendidikan" value="{{ $prodi->jenis_program_pendidikan }}"
                                id="jenis_program_pendidikan">
                            @error('jenis_program_pendidikan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="inputText" class="form-label">Jenis & Jenjang lanjutan</label>
                            <input type="text" class="form-control @error('jenjang_lanjutan') is-invalid @enderror"
                                name="jenjang_lanjutan" value="{{ $prodi->jenjang_lanjutan }}"
                                id="jenjang_lanjutan">
                            @error('jenjang_lanjutan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="inputText" class="form-label">Kualifikasi KKNI</label>
                            <input type="text" class="form-control @error('kualifikasi_kkni') is-invalid @enderror"
                                name="kualifikasi_kkni" value="{{ $prodi->kualifikasi_kkni }}"
                                id="kualifikasi_kkni">
                            @error('kualifikasi_kkni')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
