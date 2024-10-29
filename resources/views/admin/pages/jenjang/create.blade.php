@extends('admin.layout.app')
@section('title', 'Tambah Jenjang ')

@section('main')
<div class="pagetitle">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Data Master</li>
            <li class="breadcrumb-item">Jenjang Pendidikan</li>
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
                        <a href="{{ route('admin.jenjang.index') }}" class="btn btn-sm btn-outline-primary"><i
                                class="bi bi-arrow-left"></i> Kembali</a>
                        <span class="text-danger small">Bertanda *) wajib diisi</span>
                    </div>

                    <form action="{{ route('admin.jenjang.store') }}" method="post">
                        @csrf

                        <div class="mb-3 row">
                            <label for="nama" class="form-label col-md-2" >Nama Jenjang <span class="text-danger">*</span></label>
                            <div class="col-md-5">
                                <div class="input-group mb-3 @error('nama') is-invalid @enderror">
                                    <span class="input-group-text">&nbsp;ID</span>
                                    <input type="text" name="nama" class="form-control" aria-describedby="nama-addon"
                                        value="{{ old('nama') }}" autofocus placeholder="Nama Jenjang">
                                </div>
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <div class="input-group @error('nama_en') is-invalid @enderror">
                                    <span class="input-group-text">EN</span>
                                    <input type="text" name="nama_en" class="form-control" aria-describedby="nama_en-addon"
                                        value="{{ old('nama_en') }}" autofocus placeholder="Nama Jenjang EN">
                                </div>
                                @error('nama_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="singkatan" class="form-label col-md-2">Singkatan</label>
                            <div class="col-md-5">
                                <input type="text" name="singkatan" id="singkatan"
                                    class="form-control @error('singkatan') is-invalid @enderror"
                                    value="{{ old('singkatan') }}" placeholder="Misal: S1, S2, dsb">
                                @error('singkatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="jenis_pendidikan" class="form-label col-md-2">Jenis Pendidikan <span class="text-danger">*</span></label>
                            <div class="col-md-5">
                                <div class="input-group mb-3 @error('jenis_pendidikan') is-invalid @enderror">
                                    <span class="input-group-text">&nbsp;ID</span>
                                    <input type="text" name="jenis_pendidikan" class="form-control" aria-describedby="jenis_pendidikan-addon"
                                        value="{{ old('jenis_pendidikan') }}" autofocus placeholder="Jenis Pendidikan">
                                </div>
                                @error('jenis_pendidikan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <div class="input-group mb-3 @error('jenis_pendidikan_en') is-invalid @enderror">
                                    <span class="input-group-text">EN</span>
                                    <input type="text" name="jenis_pendidikan_en" class="form-control" aria-describedby="jenis_pendidikan_en-addon"
                                        value="{{ old('jenis_pendidikan_en') }}" autofocus placeholder="Jenis Pendidikan EN">
                                </div>
                                @error('jenis_pendidikan_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="kualifikasi_kkni" class="form-label col-md-2">Kualifikasi Sesuai KKNI</label>
                            <div class="col-md-5">
                                <input type="text" name="kualifikasi_kkni" id="kualifikasi_kkni"
                                    class="form-control @error('kualifikasi_kkni') is-invalid @enderror"
                                    value="{{ old('kualifikasi_kkni') }}" placeholder="Misal: Level 6">
                                @error('kualifikasi_kkni')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="lama_studi_reguler" class="form-label col-md-2">Lama Studi Reguler</label>
                            <div class="col-md-5">
                                <input type="text" name="lama_studi_reguler" id="lama_studi_reguler"
                                    class="form-control @error('lama_studi_reguler') is-invalid @enderror"
                                    value="{{ old('lama_studi_reguler') }}" placeholder="Berapa Semester">
                                @error('lama_studi_reguler')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="jenis_lanjutan" class="form-label col-md-2">Jenis Lanjutan</label>
                            <div class="col-md-5">
                                <div class="input-group mb-3 @error('jenis_lanjutan') is-invalid @enderror">
                                    <span class="input-group-text">&nbsp;ID</span>
                                    <input type="text" name="jenis_lanjutan" class="form-control" aria-describedby="jenis_lanjutan-addon"
                                        value="{{ old('jenis_lanjutan') }}" autofocus placeholder="Jenis Lanjutan">
                                </div>
                                @error('jenis_lanjutan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <div class="input-group mb-3 @error('jenis_lanjutan_en') is-invalid @enderror">
                                    <span class="input-group-text">EN</span>
                                    <input type="text" name="jenis_lanjutan_en" class="form-control" aria-describedby="jenis_lanjutan_en-addon"
                                        value="{{ old('jenis_lanjutan_en') }}" autofocus placeholder="Jenis Lanjutan EN">
                                </div>
                                @error('jenis_lanjutan_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="jenjang_lanjutan" class="form-label col-md-2">Jenjang Lanjutan</label>
                            <div class="col-md-5">
                                <div class="input-group mb-3 @error('jenjang_lanjutan') is-invalid @enderror">
                                    <span class="input-group-text">&nbsp;ID</span>
                                    <input type="text" name="jenjang_lanjutan" class="form-control" aria-describedby="jenjang_lanjutan-addon"
                                        value="{{ old('jenjang_lanjutan') }}" autofocus placeholder="Jenjang Lanjutan">
                                </div>
                                @error('jenjang_lanjutan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <div class="input-group mb-3 @error('jenjang_lanjutan_en') is-invalid @enderror">
                                    <span class="input-group-text">EN</span>
                                    <input type="text" name="jenjang_lanjutan_en" class="form-control" aria-describedby="jenjang_lanjutan_en-addon"
                                        value="{{ old('jenjang_lanjutan_en') }}" autofocus placeholder="Jenjang Lanjutan EN">
                                </div>
                                @error('jenjang_lanjutan_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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
