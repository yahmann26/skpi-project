@extends('admin.layouts.app')

@section('title', 'Capaian Pembelajaran')

@section('main')
    <!-- Page Title -->
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

    <!-- Card Body -->
    <div class="card-body">
        <a href="{{ url('admin/cp/create') }}" class="btn btn-primary">Tambah</a>
        {{ $dataTable->table() }}
    </div>
    <!-- End Card Body -->
@endsection

@push('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

