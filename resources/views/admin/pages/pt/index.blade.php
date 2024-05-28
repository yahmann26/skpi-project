@extends('admin.layouts.app')

@section('title', 'PT')

@section('main')
    <!-- Judul Halaman -->
    <div class="pagetitle">
        <h1>Pendidikan Tinggi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Pendidikan Tinggi</li>
            </ol>
        </nav>
    </div>
    <!-- Akhir Judul Halaman -->

    <!-- Konten Utama -->
    <div class="card-body">
        <!-- Tombol Tambah -->
        <a href="{{ url('admin/pt/create') }}" class="btn btn-primary">Tambah</a>

        <!-- Tabel Data -->
        {{ $dataTable->table() }}
    </div>
    <!-- Akhir Konten Utama -->
@endsection

@push('script')
    <!-- Script DataTable -->
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
