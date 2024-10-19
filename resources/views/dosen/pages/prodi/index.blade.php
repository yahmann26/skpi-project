@extends('dosen.layout.app')

@section('title', 'Prodi')

@push('style')
    <link href="{{ asset('assets/vendor/simple-datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
@endpush

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item ">Data Master</li>
                <li class="breadcrumb-item ">Program Studi</li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
    </div>


    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card overflow-auto">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-title">Data Program Studi</div>
                        </div>

                        {{-- @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif --}}

                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width = "5%">No</th>
                                    <th width = "15%">Nama</th>
                                    <th width = "15%">Jenis Pendidikan</th>
                                    <th width = "10%">Akreditasi</th>
                                    <th width = "20%">Gelar</th>
                                    <th width = "15%">Jenjang Lanjutan</th>
                                    <th width = "15%">Aksi</th>
                                </tr>
                            </thead>
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

    <script type="text/javascript">
        function deleteProdi(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: 'dosen/prodi/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        alert('Data berhasil dihapus');
                        $('#datatable').DataTable().ajax.reload(); // Reload tabel untuk memperbarui data
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat menghapus data.');
                    }
                });
            }
        }

        $(function() {

            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dosen.prodi.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'jenjang',
                        name: 'jenjang'
                    },
                    {
                        data: 'akreditasi',
                        name: 'akreditasi'
                    },
                    {
                        data: 'gelar',
                        name: 'gelar'
                    },
                    {
                        data: 'jenjang_lanjutan',
                        name: 'jenjang_lanjutan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // Event delegation for dynamically added delete buttons
            $('#datatable').on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                deleteData(id);
            });

        });
    </script>
@endpush
