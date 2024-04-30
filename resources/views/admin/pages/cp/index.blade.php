@extends('admin.layouts.app')

@section('title', 'Capaian Pembelajaran')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>Capaian Pembelajaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Admin</a></li>
                <li class="breadcrumb-item active">Capaian Pembelajaran</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="pb-3">
        <a href='{{ url('admin/cp/create') }}' class="btn btn-primary">Tambah</a>
    </div>

    <div class="card">

        <div class="card-body">

            <!-- Table with stripped rows -->
            <table class="table datatable table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th width="15%">Nama Prodi</th>
                        <th width="20%">Penguasaan Pengetahuan</th>
                        <th width="20%">Keterampilan</th>
                        <th width="20%">Kemampuan Kerja</th>
                        <th width="20%">Sikap</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($cp as $cp)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cp->prodi->nama_prodi }}</td>
                            <td>{!! $cp->penguasaan_pengetahuan !!}</td>
                            <td>{!! $cp->keterampilan !!}</td>
                            <td>{!! $cp->kemampuan_kerja !!}</td>
                            <td>{!! $cp->sikap !!}</td>
                            <td class="text-center">
                                <a href="{{ url('admin/cp/' . $cp->id) }}" class="btn btn-success btn-sm"><i
                                        class="bi bi-eye"></i></a>
                                <a href="{{ url('admin/cp/' . $cp->id . '/edit') }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i></a>
                                <form onsubmit="return confirm('yakin menghapus data ??')" class='d-inline'
                                    action=" {{ url('admin/cp/' . $cp->id) }}" method="post">
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


