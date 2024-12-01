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
                        </div>
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th width = "5%">No</th>
                                    <th width = "20%">Nama</th>
                                    <th width = "40%">Nomor</th>
                                    <th width = "15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                ajax: "{{ route('mahasiswa.skpi.index') }}",
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
                        data: 'action',
                        name: 'action',
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
    </script>
@endpush
