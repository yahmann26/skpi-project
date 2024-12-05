@extends('mahasiswa.layout.app')
@section('title', 'Edit Kegiatan ')

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}"><i class="bi bi-house-door"></i></a>
                </li>
                <li class="breadcrumb-item ">Kegiatan</li>
                <li class="breadcrumb-item active">Edit</li>
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

                        <form class="row g-1" action="{{ route('mahasiswa.kegiatan.update', ['id' => $kegiatan->id]) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="semester" class="form-label" style="font-weight: bold;">Semester<span
                                        class="text-danger">*</span></label>
                                <select id="semester" class="form-select">
                                    <option value="">Pilih Semester</option>
                                    @foreach ($semester as $s)
                                        <option value="{{ $s->id }}"
                                            {{ $kegiatan->tahunAkademik->semester->id == $s->id ? 'selected' : '' }}>
                                            {{ $s->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pilih Tahun Akademik -->
                            <div class="mb-3" id="tahunAkademikWrapper" style="display: none;">
                                <label for="tahun_akademik" class="form-label" style="font-weight: bold;">Tahun
                                    Akademik<span class="text-danger">*</span></label>
                                <select name="tahun_akademik_id" id="tahun_akademik" class="form-select">
                                    <option value="{{ $kegiatan->tahunAkademik->id }}" selected>
                                        {{ $kegiatan->tahunAkademik->nama }}</option>
                                </select>
                            </div>

                            {{-- Kategori Kegiatan --}}
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: bold;">Kategori Kegiatan</label>
                                <select class="form-select" name="kategori_kegiatan_id" id="kategori_kegiatan_id">
                                    @foreach ($kategori as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ $kegiatan->kategori_kegiatan_id == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Nama Kegiatan --}}
                            <div class="mb-3">
                                <label for="nama" class="form-label" style="font-weight: bold;">Nama Kegiatan <span
                                        class="text-danger">*</span></label>
                                <div class="input-group @error('nama') is-invalid @enderror">
                                    <span class="input-group-text">&nbsp;ID</span>
                                    <input type="text" name="nama" class="form-control" aria-describedby="nama-addon"
                                        class="form-control" value="{{ $kegiatan->nama }}" autofocus
                                        placeholder="Nama Kegiatan">
                                </div>
                                <small class="text-danger">Contoh: HMTI sebagai Ketua, Lomba UI/UX di ITB sebagai Juara 1</small>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="input-group mt-3 @error('nama_en') is-invalid @enderror">
                                    <span class="input-group-text">EN</span>
                                    <input type="text" name="nama_en" class="form-control"
                                        aria-describedby="nama_en-addon" class="form-control"
                                        value="{{ $kegiatan->nama_en }}" autofocus placeholder="Nama Kegiatan (english)">
                                </div>
                                <small class="text-danger">Example: HMTI as the President, UI/UX Competition at ITB as 1st Place Winner</small>
                                @error('nama_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="penyelenggara" class="form-label" style="font-weight: bold;">Penyelenggara
                                    Kegiatan <span class="text-danger">*</span></label>
                                <input type="text" name="penyelenggara" id="penyelenggara"
                                    class="form-control @error('penyelenggara') is-invalid @enderror"
                                    value="{{ $kegiatan->penyelenggara }}"
                                    placeholder="Misal: fakultas, kementrian, pemda dsb">
                                @error('penyelenggara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label" style="font-weight: bold;">Deskripsi<span
                                        class="text-danger">*</span></label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="file_sertifikat" class="col-sm-4 col-form-label"
                                    style="font-weight: bold;">Bukti Sertifikat</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="file" id="file_sertifikat"
                                        name="file_sertifikat">
                                    @if ($kegiatan->file_sertifikat)
                                        <small class="form-text text-muted">
                                            File Saat Ini: {{ basename($kegiatan->file_sertifikat) }}
                                        </small>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-6">
                                <label for="tgl_mulai" class="form-label" style="font-weight: bold;">Tanggal Mulai<span
                                        class="text-danger">*</span></label>
                                <input type="date" name="tgl_mulai" id="tgl_mulai"
                                    class="form-control @error('tgl_mulai') is-invalid @enderror"
                                    value="{{ $kegiatan->tgl_mulai }}">
                                @error('tgl_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tgl_selesai" class="form-label" style="font-weight: bold;">Tanggal
                                    Selesai<span class="text-danger">*</span></label>
                                <input type="date" name="tgl_selesai" id="tgl_selesai"
                                    class="form-control @error('tgl_selesai') is-invalid @enderror"
                                    value="{{ $kegiatan->tgl_selesai }}">
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
    <script>
        $(function() {
            $(document).ready(function() {

                var message = $('.success__msg');
                $('#fileUploadForm').ajaxForm({
                    beforeSend: function() {
                        var percentage = '0';
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('.progress .progress-bar').css("width", percentage + '%', function() {
                            return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
                    complete: function(xhr) {
                        console.log('File has uploaded');
                        message.fadeIn().removeClass('alert-danger').addClass('alert-success');
                        message.text("Uploaded File successfully.");
                        setTimeout(function() {
                            message.fadeOut();
                        }, 2000);
                        form.find('input:not([type="submit"]), textarea').val('');
                        var percentage = '0';
                    }
                });
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const semesterSelect = $('#semester');
            const tahunAkademikWrapper = $('#tahunAkademikWrapper');
            const tahunAkademikSelect = $('#tahun_akademik');

            // Menampilkan Tahun Akademik saat halaman dimuat jika Semester sudah terisi
            if (semesterSelect.val()) {
                loadTahunAkademik(semesterSelect.val(), {{ $kegiatan->tahun_akademik_id ?? 'null' }});
            }

            // Event ketika Semester diubah
            semesterSelect.change(function() {
                const semesterId = $(this).val();
                if (semesterId) {
                    loadTahunAkademik(semesterId, null);
                } else {
                    tahunAkademikWrapper.hide();
                    tahunAkademikSelect.html('<option value="">Pilih Tahun Akademik</option>');
                }
            });

            // Fungsi untuk memuat Tahun Akademik berdasarkan Semester
            function loadTahunAkademik(semesterId, selectedTahunAkademik = null) {
                tahunAkademikWrapper.show();
                $.ajax({
                    url: '/mahasiswa/tahun-akademik/' + semesterId, // Prefix ditambahkan
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        tahunAkademikSelect.html('<option value="">Memuat...</option>');
                    },
                    success: function(data) {
                        console.log("Data Tahun Akademik diterima:", data);
                        tahunAkademikSelect.html('<option value="">Pilih Tahun Akademik</option>');
                        $.each(data, function(index, item) {
                            tahunAkademikSelect.append('<option value="' + item.id + '"' +
                                (item.id == selectedTahunAkademik ? ' selected' : '') +
                                '>' + item.nama + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Kesalahan AJAX:", xhr.responseText);
                        tahunAkademikSelect.html(
                            '<option value="">Gagal memuat Tahun Akademik</option>');
                    }
                });
            }
        });
    </script>
@endpush
