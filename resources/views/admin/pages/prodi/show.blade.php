@extends('admin.layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>Program Studi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Admin</a></li>
                <li class="breadcrumb-item active">Prodi</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="pb-3">
        <a href='{{ url('admin/prodi') }}' class="btn btn-danger"><--Kembali</a>
    </div>

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Program Studi</h5>

                    <!-- General Form Elements -->
                    <form >

                        {{-- page kode prodi --}}
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Kode Prodi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled
                                name="kode_prodi" value="{{ $prodi->kode_prodi }}" id="kode_prodi">
                            </div>
                        </div>

                        {{-- page Nama prodi --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama Prodi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled
                                name="nama_prodi" value="{{ $prodi->nama_prodi }}" id="nama_prodi">
                            </div>
                        </div>

                        {{-- page Bahasa Pengantar Kuliah --}}
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Bahasa Pengantar Kuliah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled
                                name="bahasa_pengantar_kuliah" value="{{ $prodi->bahasa_pengantar_kuliah }}" id="bahasa_pengantar_kuliah">
                            </div>
                        </div>

                        {{-- page Akreditasi --}}
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Akreditasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled
                                name="akreditasi" value="{{ $prodi->akreditasi }}" id="akreditasi">
                            </div>
                        </div>

                        {{-- page SK Akreditasi --}}
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">SK Akreditasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled
                                name="sk_akreditasi" value="{{ $prodi->sk_akreditasi }}" id="sk_akreditasi">
                            </div>
                        </div>

                        {{-- page Sistem Penilaian --}}
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Sistem Penilaian</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled
                                name="sistem_penilaian" value="{{ $prodi->sistem_penilaian }}" id="sistem_penilaian">
                            </div>
                        </div>

                        {{-- page Gelar --}}
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Gelar</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled
                                name="gelar" value="{{ $prodi->gelar }}" id="gelar">
                            </div>
                        </div>

                        {{-- page Jenis program pendidikan --}}
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Jenis Program Pendidikan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled
                                name="jenis_program_pendidikan" value="{{ $prodi->jenis_program_pendidikan }}" id="jenis_program_pendidikan">
                            </div>
                        </div>

                        {{-- page Jenjang lanjutan --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Jenjang Lanjutan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled
                                name="jenjang_lanjutan" value="{{ $prodi->jenjang_lanjutan }}" id="jenjang_lanjutan">
                            </div>
                        </div>

                        {{-- page Kualifikasi KKNI --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kualifikasi KKNI</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled
                                name="kualifikasi_kkni" value="{{ $prodi->kualifikasi_kkni }}" id="kualifikasi_kkni">
                            </div>
                        </div>





                    </form>
                    <!-- End General Form Elements -->

                </div>
            </div>
        </div>
    </section>

@endsection
