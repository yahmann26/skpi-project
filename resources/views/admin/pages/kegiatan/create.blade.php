@extends('admin.layout.app')
@section('title', 'Tambah Kegiatan ')

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item">Kegiatan</li>
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
                            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-sm btn-outline-primary"><i
                                    class="bi bi-arrow-left"></i> Kembali</a>
                            <span class="text-danger small">Bertanda *) wajib diisi</span>
                        </div>

                        <form action="{{ route('admin.kegiatan.store') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="kategori_kegiatan_id" class="form-label">Kategori Kegiatan</label>
                                <select name="kategori_kegiatan_id" id="kategori_kegiatan_id"
                                    class="form-select @error('kategori_kegiatan_id') is-invalid @enderror">
                                    <option value="">-- Pilih Kategori Kegiatan --</option>
                                    @foreach ($kategori as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ old('kategori_kegiatan_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_kegiatan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Kegiatan</label>
                                <input type="text" name="nama" id="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tingkat" class="form-label">Tingkat</label>
                                <input type="text" name="tingkat" id="tingkat"
                                    class="form-control @error('tingkat') is-invalid @enderror"
                                    value="{{ old('tingkat') }}">
                                @error('tingkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pencapaian" class="form-label">pencapaian</label>
                                <input type="text" name="pencapaian" id="pencapaian"
                                    class="form-control @error('pencapaian') is-invalid @enderror"
                                    value="{{ old('pencapaian') }}">
                                @error('pencapaian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bobot" class="form-label">Bobot</label>
                                <input type="text" name="bobot" id="bobot"
                                    class="form-control @error('bobot') is-invalid @enderror"
                                    value="{{ old('bobot') }}">
                                @error('bobot')
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
