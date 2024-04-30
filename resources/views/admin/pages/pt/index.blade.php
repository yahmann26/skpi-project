@extends('admin.layouts.app')

@section('title', 'Prodi')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>Pendidikan Tinggi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Admin</a></li>
                <li class="breadcrumb-item active">Pendidikan Tinggi</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="pb-3">
        <a href='{{ url('admin/pt/create') }}' class="btn btn-primary">Tambah</a>
    </div>

    <div class="card">

        <div class="card-body">

            <!-- Table with stripped rows -->
            <table class="table datatable table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="2%">No</th >
                        <th width="25%">Sistem PT di Indonesia</th>
                        <th width="25%">KKNI</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pt as $pt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pt->sistem_pt }}</td>
                        <td>{{ $pt->kkni }}</td>
                        <td>
                            {{-- <a href="{{ url('admin/pt/'.$pt->id)}}" class="btn btn-success btn-sm"><i class="bi bi-eye"></i></a> --}}
                            <a href="{{ url('admin/pt/'.$pt->id.'/edit')}}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                            <form onsubmit="return confirm('yakin menghapus data ??')" class='d-inline' action=" {{ url('admin/pt/'.$prodi->id)}}" method="post">
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

