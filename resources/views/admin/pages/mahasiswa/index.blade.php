@extends('admin.layouts.app')

@section('title', 'User Mahasiswa')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>User Mahasiswa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                <li class="breadcrumb-item"><a>User</a></li>
                <li class="breadcrumb-item active">Mahasiswa</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="pb-3">
        <a href='{{ url('admin/mahasiswa/create') }}' class="btn btn-primary">Tambah</a>
    </div>

    <div class="card">

        <div class="card-body">
            <!-- Table with stripped rows -->
            <table class="table datatable table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th width="15%">NIM</th>
                        <th width="20%">Nama</th>
                        <th width="20%">Prodi</th>
                        <th width="15%">Tanggal Masuk</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ $mhs->nama_mahasiswa }}</td>
                            <td>{{ $mhs->prodi->nama_prodi }}</td>
                            <td>{{ date('d-m-Y', strtotime($mhs->tgl_masuk)) }}</td>
                            <td>
                                {{-- <button type="submit" name="submit" class="btn btn-success btn-sm"><i
                                        class="bi bi-eye"></i></button> --}}
                                <a href="{{ url('admin/mahasiswa/' . $mhs->id) }}" class="btn btn-success btn-sm"><i
                                        class="bi bi-eye"></i></a>
                                <a href="{{ url('admin/mahasiswa/' . $mhs->id . '/edit') }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i></a>
                                <form onsubmit="return confirm('yakin menghapus data ??')" class='d-inline'
                                    action=" {{ url('admin/mahasiswa/' . $mhs->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            <!-- End Table with stripped rows -->

        </div>
    </div>




@endsection
