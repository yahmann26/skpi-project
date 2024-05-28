@extends('mahasiswa.layouts.app')

@section('title', 'Kegiatan')

@section('mahasiswa-main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>Kegiatan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('mahasiswa/dahboard') }}">Mahasiswa</a></li>
                <li class="breadcrumb-item active">Kegiatan</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="pb-3">
        <a href='{{ url('mahasiswa/kegiatan/create') }}' class="btn btn-primary">Tambah</a>
    </div>

    {{ $dataTable->table() }}


@endsection

@push('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush()
