@extends('admin.layout.app')
@section('title', 'Tambah Mahasiswa ')

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item">Mahasiswa</li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <div class="card overflow-auto">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between">
                            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-sm btn-outline-primary"><i
                                    class="bi bi-arrow-left"></i> Kembali</a>
                            <span class="text-danger small">Bertanda *) wajib diisi</span>
                        </div>

                        <form class="row g-1" action="{{ route('admin.mahasiswa.store') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="program_studi_id" class="form-label">Program Studi</label>
                                <select name="program_studi_id" id="program_studi_id"
                                    class="form-select @error('program_studi_id') is-invalid @enderror">
                                    <option value="">-- Pilih Program Studi --</option>
                                    @foreach ($prodi as $prodi)
                                        <option value="{{ $prodi->id }}"
                                            {{ old('program_studi_id') == $prodi->id ? 'selected' : '' }}>
                                            {{ $prodi->nama }}</option>
                                    @endforeach
                                </select>
                                @error('program_studi_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM Mahasiswa</label>
                                <input type="number" name="nim" id="nim"
                                    class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim') }}">
                                @error('nim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Mahasiswa</label>
                                <input type="text" name="nama" id="nama"
                                    class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir"
                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    value="{{ old('tempat_lahir') }}">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" id="tgl_lahir"
                                    class="form-control @error('tgl_lahir') is-invalid @enderror"
                                    value="{{ old('tgl_lahir') }}">
                                @error('tgl_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin"
                                    class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="md-3">
                                <label for="jenis_pendaftaran" class="form-label">Jenis Pendaftaran</label>
                                <div class="input-group md-3 @error('jenis_pendaftaran') is-invalid @enderror">
                                    <span class="input-group-text">&nbsp;ID</span>
                                    <input type="text" name="jenis_pendaftaran" class="form-control" aria-describedby="jenis_pendaftaran-addon"
                                        class="form-control" value="{{ old('jenis_pendaftaran') }}" autofocus
                                        placeholder="Jenis Pendaftaran">
                                </div>
                                @error('jenis_pendaftaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="input-group md-3 @error('jenis_pendaftaran_en') is-invalid @enderror">
                                    <span class="input-group-text">EN</span>
                                    <input type="text" name="jenis_pendaftaran_en" class="form-control"
                                        aria-describedby="jenis_pendaftaran_en-addon" class="form-control" value="{{ old('jenis_pendaftaran_en') }}"
                                        autofocus placeholder="Jenis Pendaftaran (english)">
                                </div>
                                @error('jenis_pendaftaran_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
                                <input type="date" name="tgl_masuk" id="tgl_masuk"
                                    class="form-control @error('tgl_masuk') is-invalid @enderror"
                                    value="{{ old('tgl_masuk') }}">
                                @error('tgl_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tgl_lulus" class="form-label">Tanggal Lulus</label>
                                <input type="date" name="tgl_lulus" id="tgl_lulus"
                                    class="form-control @error('tgl_lulus') is-invalid @enderror"
                                    value="{{ old('tgl_lulus') }}">
                                @error('tgl_lulus')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
