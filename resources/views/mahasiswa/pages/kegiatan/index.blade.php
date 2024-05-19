@extends('mahasiswa.layouts.app')

@section('title', 'Kegiatan')

@section('mahasiswa-main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>Kegiatan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('mahasiswa/dahboard') }}">Mahasiswa</a></li>
                <li class="breadcrumb-item active">Kegiatan</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="pb-3">
        <a href='{{ url('mahasiswa/kegiatan/create') }}' class="btn btn-primary">Tambah</a>
    </div>

    <div class="card">

        <div class="card-body">
            <!-- Table with stripped rows -->
            <table class="table datatable table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th width="15%">Kategori Kegiatan</th>
                        <th width="20%">Nama Kegiatan</th>
                        <th width="10%">Tingkat</th>
                        <th width="10%">Jabatan</th>
                        <th width="10%">Bobot</th>
                        <th width="10%">Status</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Prestasi</td>
                        <td>Lomba Karya Ilmiah</td>
                        <td>Nasional</td>
                        <td>Juara 1</td>
                        <td>120</td>
                        <td><span class="budge budge-primary">Pengajuan</span></td>
                        <td>
                            <a href="" class="btn btn-success btn-sm"><i class="bi bi-eye"></i></a>
                                <a href="" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center">2</th>
                        <th class="text-center">Organisasi</th>
                        <th class="text-center">Pengurus Organisasi</th>
                        <th class="text-center">Himpunan</th>
                        <th class="text-center">Wakil Ketua</th>
                        <th class="text-center">50</th>
                        <th class="text-center">Divalidasi</th>
                        <th class="text-center">
                            <a href="" class="btn btn-success btn-sm"><i class="bi bi-eye"></i></a>
                                <a href="" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center">3</th>
                        <th class="text-center">Sertifikasi Wajib</th>
                        <th class="text-center">Sertifikasi TOEFL</th>
                        <th class="text-center">Universitas</th>
                        <th class="text-center">-</th>
                        <th class="text-center">30</th>
                        <th class="text-center"><span class="badge badge-success">Active</span></th>
                        {{-- <th class="text-center">Pengajuan</th> --}}
                        <th class="text-center">
                            <a href="" class="btn btn-success btn-sm"><i class="bi bi-eye"></i></a>
                                <a href="" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                        </th>
                    </tr>
                </tbody>

            </table>
            <!-- End Table with stripped rows -->

        </div>
    </div>




@endsection
