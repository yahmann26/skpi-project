@extends('mahasiswa.layout.app')
@section('title', 'SKPI')

@push('style')
    <link href="{{ asset('assets/vendor/simple-datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
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
                <li class="breadcrumb-item">SKPI</li>
                <li class="breadcrumb-item active">Daftar</li>
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
                            {{-- Hapus komentar jika ingin menambahkan tombol untuk membuat SKPI baru --}}
                            {{-- <a href="{{ route('mahasiswa.skpi.create') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus"></i> Tambah
                            </a> --}}
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
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mahasiswa.skpi.index') }}", // URL untuk permintaan AJAX
                columns: [
                    {
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
                columnDefs: [
                    {
                        targets: '_all',
                        className: 'align-middle'
                    }
                ],
            });
        });
    </script>
@endpush
