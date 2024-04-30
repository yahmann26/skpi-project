@extends('admin.layouts.app')

@section('title', 'Tambah Capaian Pembelajaran')

@section('style')

    <style type="text/css">
        .ck-editor__editable_inline {
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
                    <h5 class="card-title">Form Tambah Capaian Pembelajran</h5>

                    <!-- General Form Elements -->
                    <form action="{{ url('admin/cp') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-form-label">Prodi</label>
                            <div class="col-sm-15">
                                <select class="form-select" name="prodi_id" id="prodi_id">
                                    <option><----Pilih Prodi----></option>
                                    @foreach ($prodi as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                    @endforeach
                                </select>
                                @error('prodi_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="penguasaan_pengetahuan" class="col-form-label">Penguasaan
                                Pengetahuan</label>
                            <div class="col-sm-15">
                                <textarea class="form-control" name="penguasaan_pengetahuan" id="penguasaan_pengetahuan">
                            </textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="keterampilan" class="col-form-label">Keterampilan</label>
                            <div class="col-sm-15">
                                <textarea name="keterampilan" id="keterampilan">
                            </textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kemampuan_kerja" class="col-form-label">Kemampuan Kerja</label>
                            <div class="col-sm-15">
                                <textarea name="kemampuan_kerja" id="kemampuan_kerja">
                            </textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="sikap" class="col-form-label">Sikap</label>
                            <div class="col-sm-15">
                                <textarea name="sikap" id="sikap">
                            </textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">Simpan</button>
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
            .create(document.querySelector('#sikap'), {
                ckFinder: {
                    storeUrl: " {{ route('cp.store', ['_token'=>csrf_token()]) }}",
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>


@endsection
