@extends('admin.layout.app')
@section('title', 'Ubah  Tahun Akademik ')

@section('main')
<div class="pagetitle">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Tahun Akademik</li>
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
                        <a href="{{ route('admin.thnAkademik.index') }}" class="btn btn-sm btn-outline-primary"><i
                                class="bi bi-arrow-left"></i> Kembali</a>
                        <span class="text-danger small">Bertanda *) wajib diisi</span>
                    </div>

                    <form action="{{ route('admin.thnAkademik.update', ['id' => $thnAkademik->id]) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama" class="form-label" style="font-weight: bold">Semester</label>
                            <select name="semester_id" id="semester_id"
                                    class="form-select @error('semester_id') is-invalid @enderror">
                                    @foreach ($semester as $s)
                                        <option value="{{ $s->id }}"
                                            {{ $thnAkademik->semester_id == $s->id ? 'selected' : '' }}>
                                            {{ $s->nama }}</option>
                                    @endforeach
                                </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label" style="font-weight: bold">Nama</label>
                            <input type="text" name="nama" id="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ $thnAkademik->nama }}">
                            @error('nama')
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
