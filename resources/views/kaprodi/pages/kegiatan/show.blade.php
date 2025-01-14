@extends('kaprodi.layout.app')

@section('title', 'Lihat Kegiatan')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('kaprodi.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item">Kegiatan</li>
                <li class="breadcrumb-item">Mahasiswa</li>
                <li class="breadcrumb-item active">Lihat</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <div class="card overflow-auto">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('kaprodi.kegiatan.index') }}" class="btn btn-sm btn-outline-primary"><i
                                    class="bi bi-arrow-left"></i> Kembali</a>
                        </div>

                        <div class="row">

                            <div class="col-md-7">
                                <form id="updateStatusForm-{{ $kegiatan->id }}"
                                    action="{{ route('kaprodi.kegiatan.update-status', $kegiatan->id) }}" method="POST">

                                    @csrf
                                    @method('PUT')
                                    <h5>Data Kegiatan</h5>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Tahun Akademik</th>
                                                <td>:</td>
                                                <td>
                                                    <select name="tahun_akademik_id"
                                                        class="form-control @error('tahun_akademik_id') is-invalid @enderror">
                                                        @foreach ($tahunAkademik as $tahun)
                                                            <option value="{{ $tahun->id }}"
                                                                {{ $kegiatan->tahunAkademik->id == $tahun->id ? 'selected' : '' }}>
                                                                {{ $tahun->nama }} / {{ $tahun->semester->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('tahun_akademik_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <th>Kategori</th>
                                            <td>:</td>
                                            <td>
                                                <select name="kategori_kegiatan_id"
                                                    class="form-control @error('kategori_kegiatan_id') is-invalid @enderror">
                                                    @foreach ($kategori as $k)
                                                        <option value="{{ $k->id }}"
                                                            {{ $kegiatan->kategoriKegiatan->id == $k->id ? 'selected' : '' }}>
                                                            {{ $k->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('kategori_kegiatan_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <tr>
                                                <th>Nama </th>
                                                <td>:</td>
                                                <td><input type="text" name="nama"
                                                        value="{{ old('nama', $kegiatan->nama) }}"
                                                        class="form-control @error('nama') is-invalid @enderror">
                                                    @error('nama')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Nama English</th>
                                                <td>:</td>
                                                <td><input type="text" name="nama_en"
                                                        value="{{ old('nama_en', $kegiatan->nama_en) }}"
                                                        class="form-control @error('nama_en') is-invalid @enderror">
                                                    @error('nama_en')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal</th>
                                                <td>:</td>
                                                <td>
                                                    <input type="date" name="tgl_mulai" value="{{ old('tgl_mulai',$kegiatan->tgl_mulai) }}" class="form-control @error('tgl_mulai') is-invalid

                                                    @enderror" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                                    s/d
                                                    <input type="date" name="tgl_selesai" value="{{ old('tgl_selesai',$kegiatan->tgl_selesai) }}" class="form-control @error('tgl_selesai') is-invalid

                                                    @enderror" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Penyelenggara</th>
                                                <td>:</td>
                                                <td><input type="text" name="penyelenggara" value="{{ old('penyelenggara', $kegiatan->penyelenggara) }}"
                                                    class="form-control @error('penyelenggara') is-invalid @enderror">
                                             @error('penyelenggara')
                                                 <div class="invalid-feedback">{{ $message }}</div>
                                             @enderror</td>
                                            </tr>
                                            <tr>
                                                <th>Bukti</th>
                                                <td>:</td>
                                                <td>
                                                    @if ($kegiatan->file_sertifikat)
                                                        <button type="button" class="btn btn-sm btn-success"
                                                            data-bs-toggle="modal" data-bs-target="#previewModal"
                                                            data-url="{{ asset('storage/' . $kegiatan->file_sertifikat) }}"
                                                            data-type="{{ pathinfo($kegiatan->file_sertifikat, PATHINFO_EXTENSION) }}">
                                                            <i class="bi bi-file-earmark"></i> Lihat
                                                        </button>
                                                    @else
                                                        <span class="badge bg-secondary">Tidak ada</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Deskripsi</th>
                                                <td>:</td>
                                                <td>{{ $kegiatan->deskripsi }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <div class="mb-3">
                                        <label for="catatan_status" class="form-label" style="font-weight: bold;">Catatan</label>
                                        <textarea name="catatan_status" id="catatan_status" class="form-control @error('catatan_status') is-invalid @enderror">{{ old('catatan_status', $kegiatan->catatan_status) }}</textarea>
                                        @error('catatan_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <input type="hidden" name="status" id="status-{{ $kegiatan->id }}" value="">

                                    @if ($kegiatan->status === 'validasi' || $kegiatan->status === 'tolak')
                                        {{-- <p>Status : {{ $kegiatan->status }}</p> --}}
                                    @else
                                        <!-- Tombol Validasi (Terima) -->
                                        <button title="Validasi" data-tooltip="tooltip" type="button"
                                            class="btn btn-sm btn-success"
                                            onclick="submitForm({{ $kegiatan->id }}, 'validasi')">
                                            <i class="bi bi-check"> Validasi </i>
                                        </button>

                                        <!-- Tombol Tolak -->
                                        <button title="Tolak" data-tooltip="tooltip" type="button"
                                            class="btn btn-sm btn-danger"
                                            onclick="submitForm({{ $kegiatan->id }}, 'tolak')">
                                            <i class="bi bi-x"> Tolak </i>
                                        </button>
                                    @endif
                                </form>
                            </div>

                            <div class="col-md-5">
                                <h5>Data Diri</h5>
                                <table class="table ">
                                    <tbody>
                                        <tr>
                                            <th>NIM</th>
                                            <td>:</td>
                                            <td>{{ $kegiatan->mahasiswa->nim }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>:</td>
                                            <td>{{ $kegiatan->mahasiswa->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Prodi</th>
                                            <td>:</td>
                                            <td>{{ $kegiatan->mahasiswa->prodi->nama }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="previewModalLabel">Preview Sertifikat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="filePreviewContent"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>


    </section>

@endsection

@push('style')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var previewModal = document.getElementById('previewModal');
            var filePreviewContent = document.getElementById('filePreviewContent');

            previewModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var fileUrl = button.getAttribute('data-url');
                var fileType = button.getAttribute('data-type');

                filePreviewContent.innerHTML = '';

                if (fileType === 'pdf') {
                    filePreviewContent.innerHTML = '<iframe src="' + fileUrl +
                        '" frameborder="0" width="100%" height="750px"></iframe>';
                } else {
                    filePreviewContent.innerHTML = '<img src="' + fileUrl +
                        '" class="img-fluid" alt="Sertifikat">';
                }
            });
        });
    </script>

    <script>
        function submitForm(id, action) {

            // Tampilkan SweetAlert2 konfirmasi
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin ' + (action === 'validasi' ? 'validasi' : 'menolak') +
                    ' kegiatan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, lanjutkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('status-' + id).value = action;
                    document.getElementById('updateStatusForm-' + id).submit();
                }
            });
        }
    </script>
@endpush
