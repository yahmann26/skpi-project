@extends('mahasiswa.layouts.app')

@section('title', 'Kegiatan')

@section('main')
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
            <table class="table datatable table-striped ">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kategori Kegiatan</th>
                        <th class="text-center">Nama Kegiatan</th>
                        <th class="text-center">Tingkat</th>
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">Bobot</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">Prestasi</td>
                        <td class="text-center">Lomba Karya Ilmiah</td>
                        <td class="text-center">Nasional</td>
                        <td class="text-center">Juara 1</td>
                        <td class="text-center">120</td>
                        <td class="text-center"><span class="budge budge-primary">Pengajuan</span></td>
                        <td class="text-center">
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
                        <th class="text-center"><span class="badge badge-primary">Active</span></th>
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
