@extends('admin.layout.app')
@section('title', 'Tambah Kaprodi ')

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item">Kaprodi</li>
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
                            <a href="{{ route('admin.kaprodi.index') }}" class="btn btn-sm btn-outline-primary"><i
                                    class="bi bi-arrow-left"></i> Kembali</a>
                            <span class="text-danger small">Bertanda *) wajib diisi</span>
                        </div>

                        <form action="{{ route('admin.kaprodi.store') }}" method="post">
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
                                <label for="kode_dosen" class="form-label">Kode Dosen</label>
                                <input type="number" name="kode_dosen" id="kode_dosen"
                                    class="form-control @error('kode_dosen') is-invalid @enderror" value="{{ old('kode_dosen') }}">
                                @error('kode_dosen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Kaprodi</label>
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

                            <div class="mb-3">
                                <label for="nip" class="form-label">NIDN</label>
                                <input type="nip" name="nip" id="nip"
                                    class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}">
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

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
