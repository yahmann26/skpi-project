@extends('admin.layout.app')
@section('title', 'Tambah Jenjang ')

@section('main')
<div class="pagetitle">
    <h1>Tambah Jenjang</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Jenjang Pendidikan</li>
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
                        <a href="{{ route('admin.jenjang.index') }}" class="btn btn-sm btn-outline-primary"><i
                                class="bi bi-arrow-left"></i> Kembali</a>
                        <span class="text-danger small">Bertanda *) wajib diisi</span>
                    </div>

                    <form action="{{ route('admin.jenjang.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Jenjang <span class="text-danger">*</span></label>
                            <div class="input-group mb-3 @error('nama') is-invalid @enderror">
                                <span class="input-group-text">&nbsp;ID</span>
                                <input type="text" name="nama" class="form-control" aria-describedby="nama-addon"
                                    class="form-control" value="{{ old('nama') }}" autofocus placeholder="Nama Jenjang">
                            </div>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="input-group mb-3 @error('nama_en') is-invalid @enderror">
                                <span class="input-group-text">EN</span>
                                <input type="text" name="nama_en" class="form-control" aria-describedby="nama_en-addon"
                                    class="form-control" value="{{ old('nama_en') }}" autofocus
                                    placeholder="Nama Jenjang EN">
                            </div>
                            @error('nama_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="singkatan" class="form-label">Singkatan</label>
                            <input type="text" name="singkatan" id="singkatan"
                                class="form-control @error('singkatan') is-invalid @enderror"
                                value="{{ old('singkatan') }}" placeholder="Misal: S1, S2, dsb">
                            @error('singkatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="level_kkni" class="form-label">Level KKNI</label>
                            <input type="number" name="level_kkni" id="level_kkni"
                                class="form-control @error('level_kkni') is-invalid @enderror"
                                value="{{ old('level_kkni') }}" placeholder="Level">
                            @error('level_kkni')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="syarat_masuk" class="form-label">Syarat Masuk</label>
                            <input type="text" name="syarat_masuk" id="syarat_masuk"
                                class="form-control @error('syarat_masuk') is-invalid @enderror"
                                value="{{ old('syarat_masuk') }}" autofocus placeholder="ID">
                            @error('syarat_masuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" name="syarat_masuk_en" id="syarat_masuk_en"
                                class="form-control @error('syarat_masuk_en') is-invalid @enderror"
                                value="{{ old('syarat_masuk_en') }}" placeholder="EN">
                            @error('syarat_masuk_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lama_studi_reguler" class="form-label">Lama Studi Reguler</label>
                            <input type="text" name="lama_studi_reguler" id="lama_studi_reguler"
                                class="form-control @error('lama_studi_reguler') is-invalid @enderror"
                                value="{{ old('lama_studi_reguler') }}" placeholder="Berapa Semeter">
                            @error('lama_studi_reguler')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenjang_lanjutan" class="form-label">Jenjang Lanjutan</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">&nbsp;ID</span>
                                <input type="text" name="jenjang_lanjutan" class="form-control" aria-describedby="jenjang_lanjutan-addon"
                                    class="form-control @error('jenjang_lanjutan') is-invalid @enderror"
                                    value="{{ old('jenjang_lanjutan') }}" autofocus placeholder="Jenjang lanjutan">
                            </div>
                            @error('jenjang_lanjutan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text">EN</span>
                                <input type="text" name="jenjang_lanjutan" class="form-control" aria-describedby="jenjang_lanjutan_en-addon"
                                    class="form-control @error('jenjang_lanjutan_en') is-invalid @enderror"
                                    value="{{ old('jenjang_lanjutan_en') }}" autofocus placeholder="Jenjang lanjutan">
                            </div>
                            @error('jenjang_lanjutan_en')
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
