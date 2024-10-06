@extends('admin.layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>User Mahasiswa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Admin</a></li>
                <li class="breadcrumb-item"><a>User</a></li>
                <li class="breadcrumb-item active">Mahasiswa</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="pb-3">
        <a href='{{ url('admin/mahasiswa') }}' class="btn btn-danger">Kembali</a>
    </div>

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Mahasiswa</h5>

                    <!-- General Form Elements -->
                    <form >

                        {{-- page nim --}}
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" disabled name="nim"
                                    value="{{ $mahasiswa->nim }}" id="nim">
                            </div>
                        </div>

                        {{-- page nama mahasiswa --}}
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled
                                    name="nama" value="{{ $mahasiswa->nama }}" id="nama">

                            </div>
                        </div>

                        {{-- page tempat lahir --}}
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled
                                    name="tempat_lahir" value="{{ $mahasiswa->tempat_lahir }}" id="tempat_lahir">
                            </div>
                        </div>

                        {{-- page tanggal lahir --}}
                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" disabled
                                    name="tgl_lahir" id="tgl_lahir" value="{{ $mahasiswa->tgl_lahir }}">
                            </div>
                        </div>

                        {{-- page jenis kelamin --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" disabled>
                                    <option value="L" {{ $mahasiswa->jenis_kelamin === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $mahasiswa->jenis_kelamin === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        {{-- page prodi --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Prodi</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="prodi_id" id="prodi_id" disabled>
                                    @foreach ($prodi as $prodi)
                                        <option value="{{ $prodi->id }}"
                                            {{ $mahasiswa->prodi_id == $prodi->id ? 'selected' : '' }}>
                                            {{ $prodi->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- page tanggal masuk --}}
                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" disabled
                                    name="tgl_masuk" id="tgl_masuk" value="{{ $mahasiswa->tgl_masuk }}">
                            </div>
                        </div>

                        {{-- page tanggal lulus --}}
                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Lulus</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" disabled
                                    name="tgl_lulus" id="tgl_lulus" value="{{ $mahasiswa->tgl_lulus }}">
                            </div>
                        </div>

                    </form>
                    <!-- End General Form Elements -->

                </div>
            </div>
        </div>
    </section>

@endsection
