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
                    <h5 class="card-title">Form Edit Mahasiswa</h5>

                    <!-- General Form Elements -->
                    <form action="{{ url('admin/mahasiswa/'.$mahasiswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')

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
                                <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror"
                                    name="nama_mahasiswa" value="{{ $mahasiswa->nama_mahasiswa }}" id="nama_mahasiswa">
                                @error('nama_mahasiswa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- page tempat lahir --}}
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    name="tempat_lahir" value="{{ $mahasiswa->tempat_lahir }}" id="tempat_lahir">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- page tanggal lahir --}}
                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                    name="tgl_lahir" id="tgl_lahir" value="{{ $mahasiswa->tgl_lahir }}">
                                @error('tgl_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- page jenis kelamin --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="L" {{ $mahasiswa->jenis_kelamin === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $mahasiswa->jenis_kelamin === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        {{-- page prodi --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Prodi</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="prodi_id" id="prodi_id">
                                    @foreach ($prodi as $prodi)
                                        <option value="{{ $prodi->id }}"
                                            {{ $mahasiswa->prodi_id == $prodi->id ? 'selected' : '' }}>
                                            {{ $prodi->nama_prodi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- page tanggal masuk --}}
                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror"
                                    name="tgl_masuk" id="tgl_masuk" value="{{ $mahasiswa->tgl_masuk }}">
                                @error('tgl_masuk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- page tanggal lulus --}}
                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Lulus</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control @error('tgl_lulus') is-invalid @enderror"
                                    name="tgl_lulus" id="tgl_lulus" value="{{ $mahasiswa->tgl_lulus }}">
                                @error('tgl_lulus')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>

                    </form>
                    <!-- End General Form Elements -->

                </div>
            </div>
        </div>
    </section>

@endsection
