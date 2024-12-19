@extends('admin.layout.app')

@section('title', 'SKPI')

@push('style')
    <link href="{{ asset('assets/vendor/simple-datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <style>
        thead input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }
    </style>
@endpush

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item ">User</li>
                <li class="breadcrumb-item ">Skpi</li>
                <li class="breadcrumb-item active">Periode</li>
            </ol>
        </nav>
    </div>


    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card overflow-auto">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-title">Data Periode SKPI</div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addPeriodeModal">
                                Tambah Periode
                            </button>
                        </div>

                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width = "5%">No</th>
                                    <th width = "50%">Nama</th>
                                    <th width = "15%">Aksi</th>
                                </tr>
                            </thead>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Modal Tambah Periode -->
    <div class="modal fade" id="addPeriodeModal" tabindex="-1" aria-labelledby="addPeriodeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPeriodeModalLabel">Tambah Periode</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addPeriodeForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Periode</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script type="text/javascript">
        function deleteskpi(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: 'admin/skpi/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        alert('Data berhasil dihapus');
                        $('#datatable').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat menghapus data.');
                    }
                });
            }
        }

        $('#datatable').on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            deleteData(id);
        });

        $(function() {
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.skpi.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            // Handle form submission
            $('#addPeriodeForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.periode.store') }}",
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#addPeriodeModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Periode berhasil ditambahkan',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#addPeriodeForm')[0].reset();
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat menambahkan periode.'
                        });
                    }
                });
            });
        });
    </script>
@endpush
