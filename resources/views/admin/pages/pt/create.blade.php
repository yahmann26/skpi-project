@extends('admin.layout.app')
@section('title', 'Tambah Pendidikan Tinggi ')

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item">Data Master</li>
                <li class="breadcrumb-item">Pendidikan Tinggi</li>
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
                            <a href="{{ route('admin.pt.index') }}" class="btn btn-sm btn-outline-primary"><i
                                    class="bi bi-arrow-left"></i> Kembali</a>
                            <span class="text-danger small">Bertanda *) wajib diisi</span>
                        </div>

                        <form action="{{ route('admin.pt.store') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sistem_pendidikan">Sistem Pendidikan <span
                                                class="text-danger">*</span></label>
                                        <textarea name="sistem_pendidikan" id="sistem_pendidikan" rows="4" placeholder="Sistem Pendidikan di Indonesia"
                                            class="form-control @error('sistem_pendidikan') is-invalid @enderror">{{ old('sistem_pendidikan') }}</textarea>
                                        @error('sistem_pendidikan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sistem_pendidikan_en">Sistem Pendidikan English <span
                                                class="text-danger">*</span></label>
                                        <textarea name="sistem_pendidikan_en" id="sistem_pendidikan_en" rows="4" placeholder="Higher Education System in Indonesia"
                                            class="form-control @error('sistem_pendidikan_en') is-invalid @enderror">{{ old('sistem_pendidikan_en') }}</textarea>
                                        @error('sistem_pendidikan_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kkni">Kerangka Kualifikasi Nasional Indonesia <span
                                                class="text-danger">*</span></label>
                                        <textarea name="kkni" id="kkni" rows="4" placeholder="Kerangka Kulaifikasi Nasional Indonesia"
                                            class="form-control @error('kkni') is-invalid @enderror">{{ old('kkni') }}</textarea>
                                        @error('kkni')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kkni_en">Kerangka Kualifikasi Nasional Indonesia
                                            English <span class="text-danger">*</span></label>
                                            <textarea name="kkni_en" id="kkni_en" rows="4" placeholder="The Indonesian National Qualifications Framework"
                                            class="form-control @error('kkni_en') is-invalid @enderror">{{ old('kkni_en') }}</textarea>
                                        @error('kkni_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
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
