@extends('admin.layout.app')
@section('title', 'Ubah Program Studi - ')

@section('main')
<div class="pagetitle">
    <h1>Program Studi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Prodi</li>
            <li class="breadcrumb-item active">Ubah</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <div class="card overflow-auto">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between">
                        <a href="{{ route('admin.prodi.index') }}" class="btn btn-sm btn-outline-primary"><i
                                class="bi bi-arrow-left"></i> Kembali</a>
                        <span class="text-danger small">Bertanda *) wajib diisi</span>
                    </div>

                    <form action="{{ route('admin.prodi.update', ['id' => $detailData->id]) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="jenjang_pendidikan_id" class="form-label">Jenjang Pendidikan</label>
                            <select name="jenjang_pendidikan_id" id="jenjang_pendidikan_id"
                                class="form-select @error('jenjang_pendidikan_id') is-invalid @enderror">
                                <option value="">-- Pilih Jenjang Pendidikan --</option>
                                @foreach ($jenjangPendidikan as $jp)
                                <option value="{{ $jp->id }}" {{ $detailData->jenjang_pendidikan_id == $jp->id ? 'selected' : ''
                                    }}>
                                    {{ $jp->nama }}</option>
                                @endforeach
                            </select>
                            @error('jenjang_pendidikan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Program Studi <span
                                    class="text-danger">*</span></label>
                            <div class="input-group mb-3 @error('nama') is-invalid @enderror">
                                <span class="input-group-text">&nbsp;ID</span>
                                <input type="text" name="nama" class="form-control"
                                    aria-describedby="nama-addon" class="form-control"
                                    value="{{ $detailData->nama }}" autofocus placeholder="Nama program studi">
                            </div>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="input-group mb-3 @error('nama_en') is-invalid @enderror">
                                <span class="input-group-text">EN</span>
                                <input type="text" name="nama_en" class="form-control"
                                    aria-describedby="nama_en-addon" class="form-control"
                                    value="{{ $detailData->nama_en }}" autofocus placeholder="Nama program studi">
                            </div>
                            @error('nama_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="akreditasi" class="form-label">Akreditasi</label>
                            <input type="text" name="akreditasi" id="akreditasi"
                                class="form-control @error('akreditasi') is-invalid @enderror"
                                value="{{ $detailData->akreditasi }}" placeholder="Misal: A, B, dsb">
                            @error('akreditasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gelar" class="form-label">Gelar <span
                                    class="text-danger">*</span></label>
                            <div class="input-group mb-3 @error('gelar') is-invalid @enderror">
                                <span class="input-group-text">&nbsp;ID</span>
                                <input type="text" name="gelar" class="form-control"
                                    aria-describedby="gelar-addon" class="form-control"
                                    value="{{ $detailData->gelar }}" autofocus placeholder="Gelar">
                            </div>
                            @error('gelar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="input-group mb-3 @error('gelar_en') is-invalid @enderror">
                                <span class="input-group-text">EN</span>
                                <input type="text" name="gelar_en" class="form-control"
                                    aria-describedby="gelar_en-addon" class="form-control"
                                    value="{{ $detailData->gelar_en }}" autofocus placeholder="Gelar (english)">
                            </div>
                            @error('gelar_en')
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
