@extends('admin.layout.app')

@section('title', '')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
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
                            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-sm btn-outline-primary"><i
                                    class="bi bi-arrow-left"></i> Kembali</a>
                        </div>

                        <div class="row">
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

                                <div class="col-12 mt-4">

                                    {{-- form validasi atau tolak --}}

                                    <form id="updateStatusForm-{{ $kegiatan->id }}"
                                        action="{{ route('admin.kegiatan.update-status', $kegiatan->id) }}" method="POST">

                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="status" id="status-{{ $kegiatan->id }}" value="">

                                        <!-- Tombol Validasi (Terima) -->
                                        @if ($kegiatan->status !== 'diterima')
                                            <button title="Terima" data-tooltip="tooltip" type="button"
                                                class="btn btn-sm btn-success"
                                                onclick="submitForm({{ $kegiatan->id }}, 'diterima')">
                                                <i class="bi bi-check"> Validasi </i>
                                            </button>
                                        @endif

                                        <!-- Tombol Tolak -->
                                        @if ($kegiatan->status !== 'ditolak')
                                            <button title="Tolak" data-tooltip="tooltip" type="button"
                                                class="btn btn-sm btn-danger"
                                                onclick="submitForm({{ $kegiatan->id }}, 'ditolak')">
                                                <i class="bi bi-x"> Tolak </i>
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </div>


                            <div class="col-md-7">
                                <h5>Data Kegiatan</h5>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Kategori</th>
                                            <td>:</td>
                                            <td>{{ $kegiatan->kategoriKegiatan->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama </th>
                                            <td>:</td>
                                            <td>{{ $kegiatan->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tingkat</th>
                                            <td>:</td>
                                            <td>{{ $kegiatan->tingkat }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal</th>
                                            <td>:</td>
                                            <td>{{ $kegiatan->tgl_mulai }} sampai {{ $kegiatan->tgl_selesai }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pencapaian</th>
                                            <td>:</td>
                                            <td>{{ $kegiatan->jabatan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Penyelenggara</th>
                                            <td>:</td>
                                            <td>{{ $kegiatan->penyelenggara }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bukti</th>
                                            <td>:</td>
                                            <td>
                                                @if ($kegiatan->file_sertifikat)
                                                    <!-- Tombol untuk membuka modal dan melihat file sertifikat -->
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
                        <!-- Konten akan dimuat berdasarkan tipe file (gambar/PDF) -->
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
                var button = event.relatedTarget; // Tombol yang diklik
                var fileUrl = button.getAttribute('data-url'); // URL file sertifikat
                var fileType = button.getAttribute('data-type'); // Tipe file (pdf/jpg/png)

                // Kosongkan konten sebelumnya
                filePreviewContent.innerHTML = '';

                // Render preview berdasarkan tipe file
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
        function submitForm(id, status) {
            // Set nilai status
            document.getElementById('status-' + id).value = status;

            // Submit form secara langsung
            document.getElementById('updateStatusForm-' + id).submit();
        }
    </script>
@endpush
