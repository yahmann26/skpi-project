@extends('mahasiswa.layout.app')
@section('title', 'Kegiatan ')


@push('style')
    <link href="{{ asset('assets/vendor/simple-datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
@endpush

@section('main')

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}"><i class="bi bi-house-door"></i></a>
                </li>
                <li class="breadcrumb-item ">Kegiatan</li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card overflow-auto">

                    <div class="card-body" style="min-height: 300px">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-title">Data Kegiatan</div>
                            <a href="{{ route('mahasiswa.kegiatan.create') }}" class="btn btn-sm btn-primary"><i
                                    class="bi bi-plus"></i> Tambah</a>
                        </div>

                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Pencapaian</th>
                                    <th>Penyelenggara</th>
                                    <th>Sertifikat</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
            <!-- End Recent Sales -->
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
                ajax: "{{ route('mahasiswa.kegiatan.index') }}", // URL for AJAX request
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    }, // Row index
                    {
                        data: 'kategori',
                        name: 'kategoriKegiatan.nama'
                    }, // Kategori from relation
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'pencapaian',
                        name: 'pencapaian'
                    }, // For Pencapaian
                    {
                        data: 'penyelenggara',
                        name: 'penyelenggara'
                    }, // Penyelenggara & Tempat
                    {
                        data: 'sertifikat',
                        name: 'sertifikat',
                        orderable: false,
                        searchable: false
                    }, // Sertifikat with preview button
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }, // Edit and Delete buttons
                ],
                columnDefs: [{
                        targets: '_all',
                        className: 'align-middle'
                    } // Add custom class to align columns
                ],
            });

            // Event untuk membuka file di tab baru
            $(document).on('click', '.open-file', function() {
                var url = $(this).data('url');
                window.open(url, '_blank');
            });
        });
    </script>

    
@endpush
