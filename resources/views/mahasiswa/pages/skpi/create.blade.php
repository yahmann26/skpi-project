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
                            <a href="{{ route('mahasiswa.kegiatan.create') }}" class="btn btn-sm btn-primary"><i
                                class="bi bi-plus"></i> Tambah</a>
                            <div id="skpi-action-button"></div>
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

    @push('script')
        <script>
            $(document).ready(function() {
                // Memeriksa status SKPI
                $.ajax({
                    url: "{{ route('mahasiswa.skpi.status') }}",
                    method: 'GET',
                    success: function(response) {
                        if (!response.has_skpi) {
                            $('#skpi-action-button').html('<a href="{{ route('mahasiswa.skpi.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i> Ajukan SKPI</a>');
                        } else {
                            $('#skpi-action-button').html('<a href="{{ route('mahasiswa.skpi.print', response.skpi.id) }}" class="btn btn-sm btn-success"><i class="bi bi-printer"></i> Cetak SKPI</a>');
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
