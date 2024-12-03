@extends('admin.layout.app')

@section('title', 'Tahun Akademik')

@push('style')
    <link href="{{ asset('assets/vendor/simple-datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
@endpush

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item ">Tahun Akademik</li>
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
                            <div class="card-title">Data Tahun Akademik</div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addAcademicYearModal">
                                Tambah
                            </button>
                        </div>

                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="40%">Semester</th>
                                    <th width="40%">Tahun</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Modal untuk input Tahun Akademik -->
    <div class="modal fade" id="addAcademicYearModal" tabindex="-1" aria-labelledby="addAcademicYearModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAcademicYearModalLabel">Tambah Tahun Akademik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addAcademicYearForm">
                        @csrf
                        <div class="mb-3">
                            <label for="semester_id" class="form-label">Semester</label>
                            <select class="form-select" id="semester_id" name="semester_id" required>
                                <option value="">Pilih Semester</option>
                                @foreach ($semester as $semester)
                                    <option value="{{ $semester->id }}">{{ $semester->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Tahun Akademik</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="addAcademicYearForm" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script type="text/javascript">
        $(function() {
            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.thnAkademik.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'semester',
                        name: 'semester'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ],
            });

            $(function() {
                // Menangani pengiriman form untuk menambahkan Tahun Akademik
                $('#addAcademicYearForm').submit(function(event) {
                    event.preventDefault(); // Mencegah pengiriman form secara default

                    // Mengambil data form
                    var formData = $(this).serialize();

                    $.ajax({
                        url: "{{ route('admin.thnAkademik.store') }}", // URL untuk pengiriman data
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            // Memuat ulang tabel data jika menggunakan DataTables
                            table.ajax.reload();

                            // Menutup modal
                            $('#addAcademicYearModal').modal('hide');

                            // Mereset field form
                            $('#addAcademicYearForm')[0].reset();

                            // Menampilkan SweetAlert sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: 'Tahun Akademik berhasil ditambahkan!',
                                showConfirmButton: true,
                                timer: 3000
                            });

                            // Redirect ke halaman yang dituju setelah sukses
                            window.location.href =
                                "{{ route('admin.thnAkademik.index') }}";
                        },
                        error: function(xhr, status, error) {
                            // Menampilkan SweetAlert error saat terjadi masalah
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: 'Terjadi kesalahan saat menambahkan Tahun Akademik.',
                                showConfirmButton: true
                            });
                        }
                    });
                });

                // Menangani penutupan modal dan mereset form
                $('#addAcademicYearModal').on('hidden.bs.modal', function() {
                    $('#addAcademicYearForm')[0].reset(); // Mereset form saat modal ditutup
                });
            });


        });
    </script>
@endpush
