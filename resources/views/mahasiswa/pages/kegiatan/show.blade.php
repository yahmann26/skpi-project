@extends('mahasiswa.layout.app')

@section('title', 'Lihat Kegiatan')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}"><i class="bi bi-house-door"></i></a>
                </li>
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
                            <a href="{{ route('mahasiswa.kegiatan.index') }}" class="btn btn-sm btn-outline-primary"><i
                                    class="bi bi-arrow-left"></i> Kembali</a>
                        </div>

                        <div class="row">

                            <div class="col-md-7">

                                <h5>Data Kegiatan</h5>
                                <table class="table">
                                    <tbody>

                                        <tr>
                                            <th>Tahun Akademik </th>
                                            <td>:</td>
                                            <td>{{ $kegiatan->tahunAkademik->nama }} / {{ $kegiatan->tahunAkademik->semester->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kategori </th>
                                            <td>:</td>
                                            <td>{{ $kegiatan->kategoriKegiatan->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama </th>
                                            <td>:</td>
                                            <td>{{ $kegiatan->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama English</th>
                                            <td>:</td>
                                            <td>{{ $kegiatan->nama_en }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal</th>
                                            <td>:</td>
                                            <td>{{ \App\Helper\Skpi::dateIndo($kegiatan->tgl_mulai) }} s/d
                                                {{ \App\Helper\Skpi::dateIndo($kegiatan->tgl_selesai) }}</td>
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
                                        <tr>
                                            <th>Status</th>
                                            <td>:</td>
                                            <td>{{ $kegiatan->status }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                                <div class="mb-3">
                                    <label for="catatan_status" class="form-label"
                                        style="font-weight: bold;">Catatan</label>
                                    <textarea class="form-control" disabled>{{$kegiatan->catatan_status }}</textarea>
                                </div>
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
