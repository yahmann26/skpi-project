@extends('admin.layouts.app')

@section('title', 'Tambah PT')

@push('style')
    <style type="text/css">
        .ck-editor__editable_inline {
            height: 200px;
        }
    </style>
@endpush

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>Pendidikan Tinggi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Admin</a></li>
                <li class="breadcrumb-item active">PT</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="pb-3">
        <a href='{{ url('admin/pt') }}' class="btn btn-danger">Kembali</a>
    </div>

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah Pendidikan Tinggi</h5>

                    <form class="row g-3" action="{{ url('admin/pt') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label for="sistem_pt" class="col-form-label">Sistem PT</label>
                            <div class="col-sm-15">
                                <textarea class="form-control" name="sistem_pt" id="sistem_pt">
                            </textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kkni" class="col-form-label">KKNI</label>
                            <div class="col-sm-15">
                                <textarea class="form-control" name="kkni" id="kkni">
                            </textarea>
                            </div>
                        </div>

                        <div class="">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

@endsection

@push('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#sistem_pt'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#kkni'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
