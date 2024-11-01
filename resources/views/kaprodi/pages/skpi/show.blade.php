@extends('kaprodi.layout.app')

@section('title', 'Lihat SKPI')

@push('style')
    <link href="{{ asset('assets/vendor/simple-datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
@endpush

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('kaprodi.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item">SKPI</li>
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
                            <a href="{{ route('kaprodi.skpi.index') }}" class="btn btn-sm btn-outline-primary"><i
                                    class="bi bi-arrow-left"></i> Kembali</a>
                        </div>

                        {{-- data mahasiswa --}}
                        <div class="row">
                            <div class="col-md-5">
                                <h5>Data Diri</h5>
                                <table class="table ">
                                    <tbody>
                                        <tr>
                                            <th>NIM</th>
                                            <td>:</td>
                                            <td>{{ $skpi->mahasiswa->nim }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>:</td>
                                            <td>{{ $skpi->mahasiswa->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tempat, Tanggal Lahir</th>
                                            <td>:</td>
                                            <td>{{ $skpi->mahasiswa->tempat_lahir }},
                                                {{ \App\Helper\Skpi::dateIndo($skpi->mahasiswa->tgl_lahir) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Masuk</th>
                                            <td>:</td>
                                            <td>{{ \App\Helper\Skpi::dateIndo($skpi->mahasiswa->tgl_masuk) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lulus</th>
                                            <td>:</td>
                                            <td>{{ \App\Helper\Skpi::dateIndo($skpi->mahasiswa->tgl_lulus) }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Ijazah</th>
                                            <td>:</td>
                                            <td>{{ $skpi->mahasiswa->no_ijazah }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="col-12 mt-7">

                                    {{-- form validasi atau tolak --}}
                                    <form id="updateStatusForm-{{ $skpi->id }}"
                                        action="{{ route('kaprodi.skpi.update-status', $skpi->id) }}" method="POST">

                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="status" id="status-{{ $skpi->id }}"
                                            value="">

                                        <!-- Cek status saat ini untuk menentukan visibilitas tombol -->
                                        @if ($skpi->status === 'validasi' || $skpi->status === 'tolak')
                                            {{-- <p>Status : {{ $kegiatan->status }}</p> --}}
                                        @else
                                            <!-- Tombol Validasi (Terima) -->
                                            <button title="Validasi" data-tooltip="tooltip" type="button"
                                                class="btn btn-sm btn-success"
                                                onclick="submitForm({{ $skpi->id }}, 'validasi')">
                                                <i class="bi bi-check"> Validasi </i>
                                            </button>

                                            <!-- Tombol Tolak -->
                                            <button title="Tolak" data-tooltip="tooltip" type="button"
                                                class="btn btn-sm btn-danger"
                                                onclick="submitForm({{ $skpi->id }}, 'tolak')">
                                                <i class="bi bi-x"> Tolak </i>
                                            </button>
                                        @endif
                                    </form>


                                </div>
                            </div>

                            {{-- data program studi --}}
                            <div class="col-md-7">
                                <h5>Data Program Studi</h5>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Jenjang Pendidikan</th>
                                            <td>:</td>
                                            <td>{{ $skpi->mahasiswa->prodi->jenjangPendidikan->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>:</td>
                                            <td>{{ $skpi->mahasiswa->prodi->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Akreditasi</th>
                                            <td>:</td>
                                            <td>{{ $skpi->mahasiswa->prodi->akreditasi }}</td>
                                        </tr>
                                        <tr>
                                            <th>SK Akreditasi</th>
                                            <td>:</td>
                                            <td>{{ $skpi->mahasiswa->prodi->sk_akreditasi }}</td>
                                        </tr>
                                        <tr>
                                            <th>Gelar</th>
                                            <td>:</td>
                                            <td>{{ $skpi->mahasiswa->prodi->gelar }}
                                                ({{ $skpi->mahasiswa->prodi->gelar_singkat }})</td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- data kegiatan --}}
        <div class="row">
            <div class="col-12">
                <div class="card overflow-auto">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-title">Data Kegiatan</div>
                        </div>

                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width = "5%">No</th>
                                    <th width = "30%">Kategori Kegiatan</th>
                                    <th width = "30%">Nama Kegiatan</th>
                                    <th width = "20%">Pencapaian</th>
                                </tr>
                            </thead>
                        </table>

                    </div>

                </div>
            </div>
        </div>


    </section>

@endsection

@push('style')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(function() {

            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('kaprodi.skpi.show', $skpi->id) }}', // Pastikan $skpi->id tidak null
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'pencapaian',
                        name: 'pencapaian'
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

    <script>
        function submitForm(id, action) {

            // Tampilkan SweetAlert2 konfirmasi
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin ' + (action === 'validasi' ? 'validasi' : 'menolak') +
                    ' SKPI ini?',
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
