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

    <div class="card-body">
        <a href='{{ url('admin/pt/create') }}' class="btn btn-primary">Tambah</a>

        {{ $dataTable->table() }}
    </div>


@endsection

@section('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endsection
