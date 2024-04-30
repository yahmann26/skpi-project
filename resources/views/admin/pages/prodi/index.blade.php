@extends('admin.layouts.app')

@section('title', 'Prodi')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>Program Studi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Admin</a></li>
                <li class="breadcrumb-item active">Prodi</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="pb-3">
        <a href='{{ url('admin/prodi/create') }}' class="btn btn-primary">Tambah</a>
    </div>

    <div class="card">

        <div class="card-body">

            <!-- Table with stripped rows -->
            <table class="table datatable table-striped table-bordered">
                <thead>
                    <tr>
                        <th width = "5%">No</th >
                        <th width = "15%">Kode Prodi</th>
                        <th width = "20%">Nama Prodi</th>
                        <th width = "15%">Akreditasi</th>
                        <th width = "25%">Gelar</th>
                        <th width = "15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prodi as $prodi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $prodi->kode_prodi }}</td>
                        <td>{{ $prodi->nama_prodi }}</td>
                        <td>{{ $prodi->akreditasi }}</td>
                        <td>{{ $prodi->gelar }}</td>
                        <td>
                            <a href="{{ url('admin/prodi/'.$prodi->id)}}" class="btn btn-success btn-sm"><i class="bi bi-eye"></i></a>
                            <a href="{{ url('admin/prodi/'.$prodi->id.'/edit')}}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                            <form onsubmit="return confirm('yakin menghapus data ??')" class='d-inline' action=" {{ url('admin/prodi/'.$prodi->id)}}" method="post">
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

