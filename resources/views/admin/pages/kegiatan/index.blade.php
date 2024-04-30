@extends('admin.layouts.app')

@section('title', 'Data Kegiatan')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>Data Kegiatan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                <li class="breadcrumb-item active">Data Kegiatan</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="pb-3">
        <a href='{{ url('admin/kegiatan/create') }}' class="btn btn-primary">Tambah</a>
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
                        <th width="15%">Tingkat</th>
                        <th width="10%">Jabatan</th>
                        <th width="10%">Bobot</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatan as $kegiatan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kegiatan->kategori->nama_kategori }}</td>
                            <td>{{ $kegiatan->nama_kegiatan }}</td>
                            <td>{{ $kegiatan->tingkat_kegiatan }}</td>
                            <td>{{ $kegiatan->jabatan }}</td>
                            <td>{{ $kegiatan->bobot }}</td>
                            <td>
                                {{-- <button type="submit" name="submit" class="btn btn-success btn-sm"><i
                                        class="bi bi-eye"></i></button> --}}
                                <a href="{{ url('admin/kegiatan/' . $kegiatan->id) }}" class="btn btn-success btn-sm"><i
                                        class="bi bi-eye"></i></a>
                                <a href="{{ url('admin/kegiatan/' . $kegiatan->id . '/edit') }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i></a>
                                <form onsubmit="return confirm('yakin menghapus data ??')" class='d-inline'
                                    action=" {{ url('admin/kegiatan/' . $kegiatan->id) }}" method="post">
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
