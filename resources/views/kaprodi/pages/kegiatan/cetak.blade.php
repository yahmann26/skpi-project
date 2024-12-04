@extends('kaprodi.layout.app')

@section('title', 'Cetak Kegiatan')

@push('style')
    <link href="{{ asset('assets/vendor/simple-datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
@endpush

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('kaprodi.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item ">Kegiatan</li>
                <li class="breadcrumb-item active">Cetak</li>
            </ol>
        </nav>
    </div>


    <section class="section dashboard">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cetak Kegiatan Semester</h5>

                        <!-- General Form Elements -->
                        <form action="{{ route('kaprodi.kegiatan.cetakSemester') }}" method="post" target="_blank">
                            @csrf

                            <div class="row mb-3">
                                <label for="nim" class="col-sm-3 col-form-label">Masukkan NIM</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nim" id="nim"  class="form-control" placeholder="ex: 2021160019" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tahun_akademik" class="col-sm-3 col-form-label">Pilih Tahun</label>
                                <div class="col-sm-9">
                                    <input type="text" name="tahun_akademik" id="tahun_akademik"  class="form-control" placeholder="ex: 2021" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="_id" class="col-sm-3 col-form-label" >Pilih Semester</label>
                                <div class="col-sm-9">
                                    <select id="semester_id" name="semester_id" class="form-select">
                                        <option value="">Pilih Semester</option>
                                        @foreach ($semester as $s)
                                            <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary">Cetak PDF</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transkip Kegiatan</h5>
                        <form action="{{ route('kaprodi.kegiatan.cetakTranskip') }}" method="post" target="_blank">
                            @csrf

                            Cetak Transkip Kegiatan Sementara <br><br>

                            <div class="row mb-3">
                                <label for="nim" class="col-sm-3 col-form-label">Masukkan NIM</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nim" id="nim"  class="form-control" placeholder="ex: 2021160019" required>
                                </div>
                            </div>

                            <div class="row mb-3 mt-3">
                                <label class="col-sm-0 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary">Cetak PDF</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
