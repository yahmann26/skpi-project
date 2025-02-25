@extends('admin.layout.app')
@section('title', 'Ubah Program Studi - ')

@section('main')
<div class="pagetitle">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Program Studi</li>
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
                            <label for="jenjang_pendidikan_id" class="form-label" style="font-weight: bold;">Jenjang Pendidikan</label>
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
                            <label for="kode_prodi" class="form-label" style="font-weight: bold;">Kode Program Studi<span
                                class="text-danger">*</span></label>
                            <input type="text" name="kode_prodi" id="kode_prodi"
                                class="form-control @error('kode_prodi') is-invalid @enderror"
                                value="{{ $detailData->kode_prodi }}">
                            @error('kode_prodi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label" style="font-weight: bold;">Nama Program Studi <span
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
                            <div class="input-group mb-3 @error('singkatan') is-invalid @enderror">
                                <span class="input-group-text">Singkat</span>
                                <input type="text" name="singkatan" class="form-control"
                                    aria-describedby="singkatan-addon" class="form-control"
                                    value="{{ $detailData->singkatan }}" autofocus placeholder="Nama program studi">
                            </div>
                            @error('singkatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bhs_pengantar_kuliah" class="form-label" style="font-weight: bold;">Bahasa Pengantar Kuliah <span
                                    class="text-danger">*</span></label>
                            <div class="input-group mb-3 @error('bhs_pengantar_kuliah') is-invalid @enderror">
                                <span class="input-group-text">&nbsp;ID</span>
                                <input type="text" name="bhs_pengantar_kuliah" class="form-control" aria-describedby="bhs_pengantar_kuliah-addon"
                                    class="form-control" value="{{ $detailData->bhs_pengantar_kuliah }}" autofocus
                                    placeholder="Bahasa Pengantar Kuliah">
                            </div>
                            @error('bhs_pengantar_kuliah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="input-group mb-3 @error('bhs_pengantar_kuliah_en') is-invalid @enderror">
                                <span class="input-group-text">EN</span>
                                <input type="text" name="bhs_pengantar_kuliah_en" class="form-control"
                                    aria-describedby="bhs_pengantar_kuliah_en-addon" class="form-control" value="{{ $detailData->bhs_pengantar_kuliah_en }}"
                                    autofocus placeholder="Bahasa Penagntar Kuliah (english)">
                            </div>
                            @error('bhs_pengantar_kuliah_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="akreditasi" class="form-label" style="font-weight: bold;">Akreditasi</label>
                            <input type="text" name="akreditasi" id="akreditasi"
                                class="form-control @error('akreditasi') is-invalid @enderror"
                                value="{{ $detailData->akreditasi }}" placeholder="Misal: A, B, dsb">
                            @error('akreditasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sk_akreditasi" class="form-label" style="font-weight: bold;">SK Akreditasi</label>
                            <input type="text" name="sk_akreditasi" id="sk_akreditasi"
                                class="form-control @error('akreditasi') is-invalid @enderror"
                                value="{{ $detailData->sk_akreditasi }}">
                            @error('sk_akreditasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sistem_penilaian" class="form-label" style="font-weight: bold;">Sistem Penilaian <span
                                    class="text-danger">*</span></label>
                            <div class="input-group mb-3 @error('sistem_penilaian') is-invalid @enderror">
                                <span class="input-group-text">&nbsp;ID</span>
                                <input type="text" name="sistem_penilaian" class="form-control" aria-describedby="sistem_penilaian-addon"
                                    class="form-control" value="{{ $detailData->sistem_penilaian }}" autofocus
                                    placeholder="Sistem Penilain">
                            </div>
                            @error('sistem_penilaian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="input-group mb-3 @error('sistem_penilaian_en') is-invalid @enderror">
                                <span class="input-group-text">EN</span>
                                <input type="text" name="sistem_penilaian_en" class="form-control"
                                    aria-describedby="sistem_penilaian_en-addon" class="form-control" value="{{ $detailData->sistem_penilaian_en }}"
                                    autofocus placeholder="Sistem Penilaian (english)">
                            </div>
                            @error('sistem_penilaian_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gelar" class="form-label" style="font-weight: bold;">Gelar <span
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
                            <div class="input-group mb-3 @error('gelar_singkat') is-invalid @enderror">
                                <span class="input-group-text">Singkat</span>
                                <input type="text" name="gelar_singkat" class="form-control"
                                    aria-describedby="gelar_singkat-addon" class="form-control"
                                    value="{{ $detailData->gelar_singkat }}" autofocus placeholder="Gelar (english)">
                            </div>
                            @error('gelar_singkat')
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
