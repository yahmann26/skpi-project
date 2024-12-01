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
                            <div class="card-title"><a href="{{ route('admin.skpi.index') }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-arrow-left"></i> Kembali</a></div>
                            <div class="card-title">Data SKPI {{ $periode->nama }} </div>
                            <div class="d-flex">

                                {{-- cetak --}}
                                <a id="printButton" href="#" class="btn btn-sm btn-success me-2 d-none">
                                    <i class="bi bi-printer"></i> Cetak
                                </a>

                                <a href="{{ route('admin.skpi.download') }}" class="btn btn-sm btn-info me-2">
                                    <i class="bi bi-download"></i> Download Template
                                </a>
                                <button class="btn btn-sm btn-secondary me-2" data-bs-toggle="modal"
                                    data-bs-target="#importModal">
                                    <i class="bi bi-upload"></i> Import
                                </button>
                            </div>
                        </div>

                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width = "5%"><input type="checkbox" id="selectAll"></th>
                                    <th width = "20%">NIM</th>
                                    <th width = "30%">Nama</th>
                                    <th width = "15%">Nomor</th>
                                    <th width = "35%">Prodi</th>
                                </tr>
                            </thead>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Modal Import -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data SKPI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="importForm" action="{{ route('admin.skpi.import', $periode->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Pilih File Excel</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".xlsx, .xls">
                        </div>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script type="text/javascript">
        $(function() {
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.skpi.show', $periode->id) }}",
                columns: [{
                        data: null,
                        name: 'checkbox',
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row) {
                            return `<input type="checkbox" class="selectRow" value="${row.id}">`;
                        },
                    },
                    {
                        data: 'nim',
                        name: 'nim'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nomor',
                        name: 'nomor'
                    },
                    {
                        data: 'prodi',
                        name: 'prodi'
                    },
                ],
            });

            // Event untuk Select All Checkbox
            $('#selectAll').on('click', function() {
                var isChecked = $(this).prop('checked');
                $('.selectRow').prop('checked', isChecked);
                togglePrintButton();
            });

            // Event untuk Checkbox per Row
            $('#datatable').on('change', '.selectRow', function() {
                var totalCheckboxes = $('.selectRow').length;
                var checkedCheckboxes = $('.selectRow:checked').length;

                $('#selectAll').prop('checked', totalCheckboxes === checkedCheckboxes);
                togglePrintButton();
            });

            // Fungsi untuk toggle tombol Cetak
            function togglePrintButton() {
                var selectedIds = getSelectedIds();

                if (selectedIds.length > 0) {
                    $('#printButton').removeClass('d-none'); // Tampilkan tombol
                    var printUrl = "{{ route('admin.skpi.cetak', ':ids') }}";
                    printUrl = printUrl.replace(':ids', selectedIds.join(',')); // Ganti placeholder dengan ID
                    $('#printButton').attr('href', printUrl);
                } else {
                    $('#printButton').addClass('d-none'); // Sembunyikan tombol
                }
            }

            // Fungsi untuk mendapatkan ID yang dicentang
            function getSelectedIds() {
                var selectedIds = [];
                $('.selectRow:checked').each(function() {
                    selectedIds.push($(this).val());
                });
                return selectedIds;
            }

        });
    </script>

@endpush
