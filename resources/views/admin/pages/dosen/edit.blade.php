@extends('admin.layout.app')

@section('title', 'Edit Dosen')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item">Dosen</li>
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
                            <a href="{{ route('admin.dosen.index') }}" class="btn btn-sm btn-outline-primary"><i
                                    class="bi bi-arrow-left"></i> Kembali</a>
                        </div>

                        <!-- General Form Elements -->
                        <form action="{{ route('admin.dosen.update', ['id' => $dosen->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- page kode_dosen --}}
                            <div class="row mb-3">
                                <label for="kode_dosen" class="col-sm-2 col-form-label">Kode Dosen</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" disabled name="kode_dosen"
                                        value="{{ $dosen->kode_dosen }}" id="kode_dosen">
                                </div>
                            </div>

                            {{-- page nama dosen --}}
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama Dosen</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        name="nama" value="{{ $dosen->nama }}" id="nama">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- page emial dosen --}}
                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email Dosen</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $dosen->user->email }}" id="email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- page prodi --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Prodi</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="program_studi_id" id="program_studi_id">
                                        @foreach ($prodi as $p)
                                            <option value="{{ $p->id }}"
                                                {{ $dosen->program_studi_id == $p->id ? 'selected' : '' }}>
                                                {{ $p->nama }}
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