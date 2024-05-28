@extends('admin.layouts.app')

@section('title', 'Kategori')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>Kategori Kegiatan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Admin</a></li>
                <li class="breadcrumb-item active">Kategori</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="card-body">
        <a href='{{ url('admin/kategori/create') }}' class="btn btn-primary">Tambah</a>

        {{ $dataTable->table() }}

    </div>


@endsection

@push('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
