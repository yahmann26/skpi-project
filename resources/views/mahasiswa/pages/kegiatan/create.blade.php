@extends('mahasiswa.layout.app')
@section('title', 'Tambah Kegiatan - ')

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}"><i class="bi bi-house-door"></i></a>
                </li>
                <li class="breadcrumb-item">Kegiatan</li>
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
                            <a href="{{ route('mahasiswa.kegiatan.index') }}" class="btn btn-sm btn-outline-primary"><i
                                    class="bi bi-arrow-left"></i> Kembali</a>
                            <span class="text-danger small">Bertanda *) wajib diisi</span>
                        </div>

                        <form class="row g-1" action="{{ route('mahasiswa.kegiatan.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="semester" class="form-label" style="font-weight: bold;">Semester<span
                                        class="text-danger">*</span></label>
                                <select id="semester" class="form-select">
                                    <option value="">Pilih Semester</option>
                                    @foreach ($semester as $s)
                                        <option value="{{ $s->id }}" {{ old('semester') == $s->id ? 'selected' : '' }}>{{ $s->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pilih Tahun Akademik -->
                            <div class="mb-3" id="tahunAkademikWrapper" style="display: none;">
                                <label for="tahun_akademik" class="form-label" style="font-weight: bold;">Tahun
                                    Akademik<span class="text-danger">*</span></label>
                                <select name="tahun_akademik_id" id="tahun_akademik" class="form-select">
                                    <option value="{{ old('tahun_akademik_id') }}">Pilih Tahun Akademik</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="kategori_kegiatan_id" class="form-label" style="font-weight: bold;">Kategori
                                    Kegiatan<span class="text-danger">*</span></label>
                                <select name="kategori_kegiatan_id" id="kategori_kegiatan_id"
                                    class="form-select @error('kategori_kegiatan_id') is-invalid @enderror">
                                    <option value="">-- Pilih Kategori Kegiatan --</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}"
                                            {{ old('kategori_kegiatan_id') == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_kegiatan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label" style="font-weight: bold;">Nama Kegiatan <span
                                        class="text-danger">*</span></label>
                                <div class="input-group @error('nama') is-invalid @enderror">
                                    <span class="input-group-text">&nbsp;ID</span>
                                    <input type="text" name="nama" class="form-control" aria-describedby="nama-addon"
                                        value="{{ old('nama') }}" autofocus placeholder="Nama Kegiatan">
                                </div>
                                <small style="font-style: italic;">Contoh: HMTI sebagai Ketua, Lomba UI/UX di ITB sebagai Juara 1</small>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="input-group mt-3 @error('nama_en') is-invalid @enderror">
                                    <span class="input-group-text">EN</span>
                                    <input type="text" name="nama_en" class="form-control"
                                        aria-describedby="nama_en-addon" value="{{ old('nama_en') }}" autofocus
                                        placeholder="Nama Kegiatan (english)">
                                </div>
                                <small style="font-style: italic;">Example: HMTI as the President, UI/UX Competition at ITB as 1st
                                    Place Winner</small>
                                @error('nama_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="penyelenggara" class="form-label" style="font-weight: bold;">Penyelenggara
                                    Kegiatan <span class="text-danger">*</span></label>
                                <input type="text" name="penyelenggara" id="penyelenggara"
                                    class="form-control @error('penyelenggara') is-invalid @enderror"
                                    value="{{ old('penyelenggara') }}"
                                    placeholder="Misal: fakultas, kementrian, pemda dsb">
                                @error('penyelenggara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label" style="font-weight: bold;">Deskripsi<span
                                        class="text-danger">*</span></label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="file_sertifikat" class="col-sm-3 col-form-label"
                                    style="font-weight: bold;">Bukti Sertifikat</label><small style="font-style: italic;">Maksimal ukuran file: 3 MB</small>
                                <div class="col-sm-12">
                                    <input type="file" id="file_sertifikat"
                                        name="file_sertifikat" class="form-control @error('file_sertifikat') is-invalid @enderror"
                                        value="{{ old('file_sertifikat') }}">
                                    @error('file_sertifikat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="tgl_mulai" class="form-label" style="font-weight: bold;">Tanggal Mulai<span class="text-danger">*</span></label>
                                <input type="date" name="tgl_mulai" id="tgl_mulai"
                                    class="form-control @error('tgl_mulai') is-invalid @enderror"
                                    value="{{ old('tgl_mulai') }}" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                @error('tgl_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tgl_selesai" class="form-label" style="font-weight: bold;">Tanggal Selesai<span class="text-danger">*</span></label>
                                <input type="date" name="tgl_selesai" id="tgl_selesai"
                                    class="form-control @error('tgl_selesai') is-invalid @enderror"
                                    value="{{ old('tgl_selesai') }}" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                @error('tgl_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card overflow-auto">
                    <div class="card-body" style="min-height: 300px">

                        <hr class="my-3">
                        <div class="alert alert-info">
                            <strong>Info!</strong>
                            <br>1. Pilih Semester
                            <br>2. Pilih Tahun Akademiknya
                            <br>3. Pilih Kategori Kegiatan
                            <br>4. Sesuaikan Nama Kegiatan Dengan Kategori Kegiatan !!
                            <br>5. Tuliskan nama kegiatan beserta penyelenggara & pencapaiannya <br>
                            <br><b>Hanya Kegiatan yang Lolos Validasi yang akan ditampilkan di SKPI</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#semester').change(function() {
                let semesterId = $(this).val();
                let tahunAkademikWrapper = $('#tahunAkademikWrapper');
                let tahunAkademikSelect = $('#tahun_akademik');

                console.log("Semester dipilih:", semesterId);

                if (semesterId) {
                    tahunAkademikWrapper.show();
                    $.ajax({
                        url: '/mahasiswa/tahun-akademik/' + semesterId,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function() {
                            tahunAkademikSelect.html('<option value="">Memuat...</option>');
                        },
                        success: function(data) {
                            console.log("Data Tahun Akademik diterima:", data);
                            tahunAkademikSelect.html(
                                '<option value="">Pilih Tahun Akademik</option>');
                            $.each(data, function(index, item) {
                                tahunAkademikSelect.append('<option value="' + item.id +
                                    '">' + item.nama + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("Kesalahan AJAX:", xhr.responseText);
                            tahunAkademikSelect.html(
                                '<option value="">Gagal memuat Tahun Akademik</option>');
                        }
                    });
                } else {
                    tahunAkademikWrapper.hide();
                    tahunAkademikSelect.html('<option value="">Pilih Tahun Akademik</option>');
                }
            });
        });
    </script>
@endpush
