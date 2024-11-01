@extends('mahasiswa.layout.app')
@section('title', 'SKPI')

@push('style')
    <link href="{{ asset('assets/vendor/simple-datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('mahasiswa.dashboard') }}">
                        <i class="bi bi-house-door"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active">SKPI</li>
            </ol>
        </nav>
    </div><!-- Akhir Judul Halaman -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card overflow-auto">
                    <div class="card-body" style="min-height: 300px">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-title">Data SKPI</div>
                            <a href="#" class="btn btn-sm btn-primary" id="btnAjukan"><i class="bi bi-plus"></i>
                                Ajukan</a>
                        </div>
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nomor</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data akan diisi oleh DataTables -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- Akhir Penjualan Terbaru -->
        </div>
    </section>
@endsection



@push('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mahasiswa.skpi.index') }}", // URL untuk permintaan AJAX
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'mhs',
                        name: 'mhs'
                    },
                    {
                        data: 'nomor',
                        name: 'nomor'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    targets: '_all',
                    className: 'align-middle'
                }],
            });
        });

        $('#btnAjukan').on('click', function(e) {
            e.preventDefault(); // Mencegah link default

            // Tampilkan konfirmasi dengan SweetAlert
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin mengajukan SKPI?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, ajukan!',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna memilih "Ya", lakukan AJAX
                    $.ajax({
                        url: "{{ route('mahasiswa.skpi.store') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}', // Token CSRF
                        },
                        success: function(response) {
                            // Tambahkan data baru ke DataTable
                            $('.datatable').DataTable().ajax.reload();

                            // Tampilkan notifikasi sukses jika perlu
                            Swal.fire(
                                'Sukses!',
                                'Data berhasil diajukan!',
                                'success'
                            );
                        },
                        error: function(xhr) {
                            // Tampilkan error jika ada
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan: ' + xhr.responseText,
                                'error'
                            );
                        }
                    });
                } else {
                    // Jika pengguna memilih "Tidak"
                    Swal.fire(
                        'Dibatalkan',
                        'Pengajuan dibatalkan.',
                        'info'
                    );
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
                    // Jika dikonfirmasi, set nilai status dan submit form
                    document.getElementById('status-' + id).value = action;
                    document.getElementById('updateStatusForm-' + id).submit();
                }
            });
        }
    </script>
@endpush
