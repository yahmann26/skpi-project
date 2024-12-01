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
                                <div class="input-group mb-3 @error('nama') is-invalid @enderror">
                                    <span class="input-group-text">&nbsp;ID</span>
                                    <input type="text" name="nama" class="form-control" aria-describedby="nama-addon"
                                        class="form-control" value="{{ $kegiatan->nama }}" autofocus
                                        placeholder="Nama Kegiatan">
                                </div>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="input-group mb-3 @error('nama_en') is-invalid @enderror">
                                    <span class="input-group-text">EN</span>
                                    <input type="text" name="nama_en" class="form-control"
                                        aria-describedby="nama_en-addon" class="form-control" value="{{ $kegiatan->nama_en }}"
                                        autofocus placeholder="Nama Kegiatan (english)">
                                </div>
                                @error('nama_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- pencapaian --}}
                            <div class="mb-3">
                                <label for="pencapaian" class="form-label" style="font-weight: bold;">Pencapaian <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="pencapaian" id="pencapaian"
                                    class="form-control @error('pencapaian') is-invalid @enderror"
                                    value="{{ $kegiatan->pencapaian }}" placeholder="Misal: Peserta, Ketua, Juara 2, dsb">
                                @error('pencapaian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tingkat" class="form-label" style="font-weight: bold;">Tingkat kegiatan <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="tingkat" id="tingkat"
                                    class="form-control @error('tingkat') is-invalid @enderror"
                                    value="{{ $kegiatan->tingkat }}" placeholder="Misal: himpunan, univ, kabupaten dsb">
                                @error('tingkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="penyelenggara" class="form-label" style="font-weight: bold;">Penyelenggara Kegiatan <span
                                        class="text-danger">*</span></label>
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
                                <label for="file_sertifikat" class="col-sm-4 col-form-label" style="font-weight: bold;">Bukti Sertifikat</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="file" id="file_sertifikat" name="file_sertifikat" >
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
                                <label for="tgl_selesai" class="form-label" style="font-weight: bold;">Tanggal Selesai<span
                                        class="text-danger">*</span></label>
                                <input type="date" name="tgl_selesai" id="tgl_selesai"
                                    class="form-control @error('tgl_selesai') is-invalid @enderror"
                                    value="{{ $kegiatan->tgl_selesai }}">
                                @error('tgl_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <div class="mb-3">
                                <div class="alert alert-info">
                                    <strong>Info!</strong> Jika Anda tidak memiliki sertifikat, silahkan unggah surat tugas
                                    atau
                                    dokumen lain yang dapat memvalidasi kegiatan Anda. <br>
                                    Tidak semua kegiatan akan ditampilkan pada SKPI, <b>hanya data yang lolos validasi</b>
                                    Admin yang akan ditampilkan.
                                </div>
                            </div>

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
                            <br>Jika Anda tidak memiliki sertifikat, silahkan unggah surat tugas
                            atau
                            dokumen lain yang dapat memvalidasi kegiatan Anda. <br>
                            Tidak semua kegiatan akan ditampilkan pada SKPI, <b>hanya data yang lolos validasi</b>
                            Admin yang akan ditampilkan.
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
@endpush
