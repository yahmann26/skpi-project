@extends('admin.layout.app')

@section('title', 'Edit Mahasiswa')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item">Mahasiswa</li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="cold-md-12">
                <div class="card overflow-auto">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between">
                            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-sm btn-outline-primary"><i
                                    class="bi bi-arrow-left"></i> Kembali</a>
                        </div>

                        <!-- General Form Elements -->
                        <form action="{{ route('admin.mahasiswa.update', ['id' => $mahasiswa->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- page nim dan email mahasiswa --}}
                            <div class="row mb-3">
                                <label for="nim" class="col-sm-2 col-form-label" style="font-weight: bold">NIM</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control @error('nim') is-invalid @enderror"
                                        name="nim" value="{{ $mahasiswa->nim }}" id="nim">
                                    @error('nim')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <label for="email" class="col-sm-2 col-form-label" style="font-weight: bold">Email
                                    Mahasiswa</label>
                                <div class="col-sm-4">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $mahasiswa->user->email }}" id="email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- page nama mahasiswa --}}
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label" style="font-weight: bold">Nama
                                    Mahasiswa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        name="nama" value="{{ $mahasiswa->nama }}" id="nama">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- page prodi --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" style="font-weight: bold">Prodi</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="program_studi_id" id="program_studi_id">
                                        @foreach ($prodi as $prodi)
                                            <option value="{{ $prodi->id }}"
                                                {{ $mahasiswa->program_studi_id == $prodi->id ? 'selected' : '' }}>
                                                {{ $prodi->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- page tempat lahir --}}
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label" style="font-weight: bold">Tempat
                                    Lahir</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                        name="tempat_lahir" value="{{ $mahasiswa->tempat_lahir }}" id="tempat_lahir">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <label for="inputDate" class="col-sm-2 col-form-label" style="font-weight: bold">Tanggal
                                    Lahir</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                        name="tgl_lahir" id="tgl_lahir" value="{{ $mahasiswa->tgl_lahir }}">
                                    @error('tgl_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label" style="font-weight: bold">Jenis
                                    Kelamin</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="L" {{ $mahasiswa->jenis_kelamin === 'L' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="P" {{ $mahasiswa->jenis_kelamin === 'P' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>

                                <label for="inputDate" class="col-sm-2 col-form-label" style="font-weight: bold">Tanggal
                                    Masuk</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror"
                                        name="tgl_masuk" id="tgl_masuk" value="{{ $mahasiswa->tgl_masuk }}">
                                    @error('tgl_masuk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- page jenis Pendaftaran --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" style="font-weight: bold">Jenis Pendaftaran</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="jenis_pendaftaran_id" id="jenis_pendaftaran_id">
                                        @foreach ($jenisPendaftaran as $jp)
                                            <option value="{{ $jp->id }}"
                                                {{ $mahasiswa->jenis_pendaftaran_id == $jp->id ? 'selected' : '' }}>
                                                {{ $jp->nama }}
                                            </option>
                                        @endforeach
                                    </select>
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
        </div>
    </section>

@endsection
