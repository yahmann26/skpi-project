@extends('admin.layout.app')

@section('title', 'Cetak Kegiatan')

@push('style')
    <link href="{{ asset('assets/vendor/simple-datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
@endpush

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
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
                        <h5 class="card-title">Cetak Kegiatan Mahasiswa</h5>

                        <form action="{{ route('admin.kegiatan.cetakSemester') }}" method="post" target="_blank">
                            @csrf

                            <div class="row mb-3">
                                <label for="nim" class="col-sm-3 col-form-label">Masukkan NIM</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nim" id="nim" class="form-control"
                                        placeholder="ex: 2021160019" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="semester" class="col-sm-3 col-form-label">Pilih
                                    Semester</label>
                                <div class="col-sm-9">
                                    <select name="semester_id" id="semester" class="form-select">
                                        <option value="">-- Pilih Semester --</option>
                                        @foreach ($semester as $s)
                                            <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 d-none" id="tahunAkademikWrapper">
                                <label for="tahun_akademik" class="col-sm-3 col-form-label">Tahun</label>
                                <div class="col-sm-9">
                                    <select name="tahun_akademik_id" id="tahun_akademik" class="form-select">
                                        <option value="">Pilih Tahun Akademik</option>
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

            <div class="col-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transkip Kegiatan</h5>
                        <form action="{{ route('admin.kegiatan.cetakTranskip') }}" method="post" target="_blank">
                            @csrf

                            Cetak Transkip Kegiatan Mahasiswa <br><br>

                            <div class="row mb-3">
                                <label for="nim" class="col-sm-3 col-form-label">Masukkan NIM</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nim" id="nim" class="form-control"
                                        placeholder="ex: 2021160019" required>
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

@push('style')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#semester').change(function() {
                let semesterId = $(this).val();
                let tahunAkademikWrapper = $('#tahunAkademikWrapper');
                let tahunAkademikSelect = $('#tahun_akademik');

                if (semesterId) {
                    tahunAkademikWrapper.removeClass('d-none'); // Tampilkan wrapper
                    $.ajax({
                        url: '/admin/tahun-akademik/' + semesterId,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function() {
                            tahunAkademikSelect.html('<option value="">Memuat...</option>');
                        },
                        success: function(data) {
                            tahunAkademikSelect.html(
                                '<option value="">Pilih Tahun Akademik</option>');
                            if (data.length > 0) {
                                $.each(data, function(index, item) {
                                    tahunAkademikSelect.append('<option value="' + item
                                        .id + '">' + item.nama + '</option>');
                                });
                            } else {
                                tahunAkademikSelect.html(
                                    '<option value="">Tidak ada data</option>');
                            }
                        },
                        error: function(xhr) {
                            console.error("Kesalahan AJAX:", xhr.responseText);
                            tahunAkademikSelect.html(
                                '<option value="">Gagal memuat Tahun Akademik</option>');
                        },
                    });
                } else {
                    tahunAkademikWrapper.addClass('d-none'); // Sembunyikan wrapper
                    tahunAkademikSelect.html('<option value="">Pilih Tahun Akademik</option>');
                }
            });
        });
    </script>
@endpush
