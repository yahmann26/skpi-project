@extends('admin.layouts.app')

@section('title', 'PT')

@section('style')
    
@endsection

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>Pendidikan Tinggi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Pendidikan Tinggi</li>
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
