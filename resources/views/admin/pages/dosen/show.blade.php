@extends('admin.layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>User Dosen</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Admin</a></li>
                <li class="breadcrumb-item"><a>User</a></li>
                <li class="breadcrumb-item active">Dosen</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="pb-3">
        <a href='{{ url('admin/dosen') }}' class="btn btn-danger">Kembali</a>
    </div>

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Dosen</h5>

                    <!-- General Form Elements -->
                    <form >

                        {{-- page nim --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kode Dosen</label>
                            <div class="col-sm-10">
                                <input class="form-control" disabled name="kode_dosen"
                                    value="{{ $dosen->kode_dosen }}" id="kode_dosen">
                            </div>
                        </div>

                        {{-- page nama dosen --}}
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Nama Dosen</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled
                                    name="nama_dosen" value="{{ $dosen->nama_dosen }}" id="nama_dosen">

                            </div>
                        </div>

                        {{-- page jabatan --}}
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled
                                    name="jabatan" value="{{ $dosen->jabatan }}" id="jabatan">
                            </div>
                        </div>


                        {{-- page prodi --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Prodi</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="prodi_id" id="prodi_id" disabled>
                                    @foreach ($prodi as $prodi)
                                        <option value="{{ $prodi->id }}"
                                            {{ $dosen->prodi_id == $prodi->id ? 'selected' : '' }}>
                                            {{ $prodi->nama_prodi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </form>
                    <!-- End General Form Elements -->

                </div>
            </div>
        </div>
    </section>

@endsection
