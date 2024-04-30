@extends('admin.layouts.app')

@section('title', 'Edit Dosen')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>User Dosen</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Admin</a></li>
                <li class="breadcrumb-item"><a>User</a></li>
                <li class="breadcrumb-item active">Dosen</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="pb-3">
        <a href='{{ url('admin/dosen') }}' class="btn btn-danger">Kembali</a>
    </div>

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Edit Dosen</h5>

                    <!-- General Form Elements -->
                    <form action="{{ url('admin/dosen/'.$dosen->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Kode Dosen</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control @error('kode_dosen') is-invalid @enderror" name="kode_dosen"
                                    value="{{$dosen->kode_dosen}}" id="kode_dosen">
                                @error('kode_dosen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Nama Dosen</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama_dosen') is-invalid @enderror"
                                    name="nama_dosen" value="{{ $dosen->nama_dosen }}" id="nama_dosen">
                                @error('nama_dosen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="jabatan" id="jabatan" required>
                                    <option value="Kaprodi" {{ $dosen->jabatan === 'Kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                                    <option value="Dosen Wali" {{ $dosen->jabatan === 'Dosen Wali' ? 'selected' : '' }}>Dosen Wali</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Prodi</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="prodi_id" id="prodi_id">
                                    @foreach ($prodi as $prodi)
                                        <option value="{{ $prodi->id }}"
                                            {{ $dosen->prodi_id == $prodi->id ? 'selected' : '' }}>
                                            {{ $prodi->nama_prodi }}
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
    </section>

@endsection
