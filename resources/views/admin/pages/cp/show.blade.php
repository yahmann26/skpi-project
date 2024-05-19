@extends('admin.layouts.app')

@section('title', 'Lihat Capaian Pembelajaran')

@section('style')

    <style type="text/css">
        .ck-editor__disable_inline {
            height: 200px;
        }
    </style>

@endsection

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
        <a href='{{ url('admin/cp') }}' class="btn btn-danger">Kembali</a>
    </div>

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Capaian Pembelajan</h5>

                    <!-- General Form Elements -->
                    <form action="{{ url('admin/cp/' . $cp->id) }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-form-label">Prodi</label>
                            <div class="col-sm-15">
                                {{-- <input class="" name="prodi_id" id="prodi_id"> {{ $prodi->nama_prodi }} --}}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label" class="">Penguasaan Pengetahuan</label>
                            <div class="col-sm-15">
                                <textarea id="penguasaan_pengetahuan" disabled>{{ $cp->penguasaan_pengetahuan }}
                            </textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="keterampilan" class="col-form-label">Keterampilan</label>
                            <div class="col-sm-15">
                                <textarea id="keterampilan" readonly>{{ $cp->keterampilan }}
                            </textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kemampuan_kerja" class="col-form-label">Kemampuan Kerja</label>
                            <div class="col-sm-15">
                                <textarea id="kemampuan_kerja" readonly>{{ $cp->kemampuan_kerja }}
                            </textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="sikap" class="col-form-label">Sikap</label>
                            <div class="col-sm-15">
                                <textarea id="sikap" readonly>{{ $cp->sikap }}
                            </textarea>
                            </div>
                        </div>

                    </form>
                    <!-- End General Form Elements -->

                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

    <script>
        ClassicEditor
            .create(document.querySelector('#penguasaan_pengetahuan'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#keterampilan'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#kemampuan_kerja'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#sikap'))
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection
