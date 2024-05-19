@extends('admin.layouts.app')

@section('title', 'User Dosen')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>User Dosen</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Admin</a></li>
                <li class="breadcrumb-item"><a>User</a></li>
                <li class="breadcrumb-item active">Dosen</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="pb-3">
        <a href='{{ url('admin/dosen/create') }}' class="btn btn-primary">Tambah</a>
    </div>

    <div class="card">

        <div class="card-body">
            <!-- Table with stripped rows -->
            <table class="table datatable table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th width="15%">Kode Dosen</th>
                        <th width="20%">Nama</th>
                        <th width="25%">Prodi</th>
                        <th width="15%">Jabatan</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dosen as $dosen)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $dosen->kode_dosen }}</td>
                            <td>{{ $dosen->nama_dosen }}</td>
                            <td>{{ $dosen->prodi->nama_prodi }}</td>
                            <td>{{ $dosen->jabatan }}</td>
                            <td>
                                <a href="{{ url('admin/dosen/' . $dosen->id) }}" class="btn btn-success btn-sm"><i class="bi bi-eye"></i></a>
                                <a href="{{ url('admin/dosen/' . $dosen->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <form onsubmit="return confirm('yakin menghapus data ??')" class='d-inline' action=" {{ url('admin/dosen/'.$dosen->id)}}" method="post">
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
