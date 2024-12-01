@extends('mahasiswa.layout.app')
@section('title', 'Edit Kegiatan - ')

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}"><i class="bi bi-house-door"></i></a>
                </li>
                <li class="breadcrumb-item">Kegiatan</li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-md-8">
                <div class="card overflow-auto">
                    <div class="card-body" style="min-height: 300px">
                        <div class="card-title d-flex justify-content-between">
                            <a href="{{ route('mahasiswa.kegiatan.index') }}" class="btn btn-sm btn-outline-primary"><i
                                    class="bi bi-arrow-left"></i> Kembali</a>
                            <span class="text-danger small">Bertanda *) wajib diisi</span>
                        </div>

                        <form class="row g-1" action="{{ route('mahasiswa.kegiatan.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="kategori_kegiatan_id" class="form-label" style="font-weight: bold;">Kategori Kegiatan</label>
                                <select name="kategori_kegiatan_id" id="kategori_kegiatan_id"
                                    class="form-select @error('kategori_kegiatan_id') is-invalid @enderror">
                                    <option value="">-- Pilih Kategori Kegiatan --</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}"
                                            {{ old('kategori_kegiatan_id') == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_kegiatan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label" style="font-weight: bold;">Nama Kegiatan <span
                                        class="text-danger">*</span></label>
                                <div class="input-group mb-3 @error('nama') is-invalid @enderror">
                                    <span class="input-group-text">&nbsp;ID</span>
                                    <input type="text" name="nama" class="form-control" aria-describedby="nama-addon"
                                        value="{{ old('nama') }}" autofocus placeholder="Nama Kegiatan">
                                </div>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="input-group mb-3 @error('nama_en') is-invalid @enderror">
                                    <span class="input-group-text">EN</span>
                                    <input type="text" name="nama_en" class="form-control"
                                        aria-describedby="nama_en-addon" value="{{ old('nama_en') }}" autofocus
                                        placeholder="Nama Kegiatan (english)">
                                </div>
                                @error('nama_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pencapaian" class="form-label" style="font-weight: bold;">Pencapaian <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="pencapaian" id="pencapaian"
                                    class="form-control @error('pencapaian') is-invalid @enderror"
                                    value="{{ old('pencapaian') }}" placeholder="Misal: Peserta, Ketua, Juara 2, dsb">
                                @error('pencapaian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tingkat" class="form-label" style="font-weight: bold;">Tingkat kegiatan <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="tingkat" id="tingkat"
                                    class="form-control @error('tingkat') is-invalid @enderror"
                                    value="{{ old('tingkat') }}" placeholder="Misal: himpunan, univ, kabupaten dsb">
                                @error('tingkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="penyelenggara" class="form-label" style="font-weight: bold;">Penyelenggara Kegiatan <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="penyelenggara" id="penyelenggara"
                                    class="form-control @error('penyelenggara') is-invalid @enderror"
                                    value="{{ old('penyelenggara') }}"
                                    placeholder="Misal: fakultas, kementrian, pemda dsb">
                                @error('penyelenggara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label" style="font-weight: bold;">Deskripsi<span
                                        class="text-danger">*</span></label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="file_sertifikat" class="col-sm-4 col-form-label" style="font-weight: bold;">Bukti Sertifikat</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="file" id="file_sertifikat"
                                        name="file_sertifikat">
                                        <small class="text-danger">Maksimal ukuran file: 3 MB</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="tgl_mulai" class="form-label" style="font-weight: bold;">Tanggal Mulai<span
                                        class="text-danger">*</span></label>
                                <input type="date" name="tgl_mulai" id="tgl_mulai"
                                    class="form-control @error('tgl_mulai') is-invalid @enderror"
                                    value="{{ old('tgl_mulai') }}">
                                @error('tgl_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tgl_selesai" class="form-label" style="font-weight: bold;">Tanggal Selesai<span
                                        class="text-danger">*</span></label>
                                <input type="date" name="tgl_selesai" id="tgl_selesai"
                                    class="form-control @error('tgl_selesai') is-invalid @enderror"
                                    value="{{ old('tgl_selesai') }}">
                                @error('tgl_selesai')
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

            <div class="col-md-4">
                <div class="card overflow-auto">
                    <div class="card-body" style="min-height: 300px">

                        <hr class="my-3">
                        <div class="alert alert-info">
                            <strong>Info!</strong>
                            <br>Pilih Kategori Kegiatan<br> Sesuaikan Nama Kegiatan Dengan Kategori Kegiatan !!<br><br>
                            <b>Hanya Kegiatan yang Lolos Validasi yang akan ditampilkan di SKPI</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script')
    <script>
        $(function() {
            $(document).ready(function() {
                // Any additional scripts for this page can go here
            });
        });
    </script>
@endpush
