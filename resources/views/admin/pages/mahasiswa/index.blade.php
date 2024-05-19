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

    <div class="card-body">
        <a href='{{ url('admin/mahasiswa/create') }}' class="btn btn-primary">Tambah</a>

        {{ $dataTable->table() }}
    </div>


@endsection

@section('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endsection
