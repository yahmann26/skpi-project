@extends('mahasiswa.layouts.app')

@section('title', 'Tambah Kegiatan')

@section('main')
    {{-- Page Titile --}}
    <div class="pagetitle">
        <h1>Kegiatan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('mahasiswa/dashboard') }}">Mahasiswa</a></li>
                <li class="breadcrumb-item"><a>Kegiatan</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="pb-3">
        <a href='{{ url('mahasiswa/kegiatan') }}' class="btn btn-danger">Kembali</a>
    </div>

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah Kegiatan</h5>

                    <!-- General Form Elements -->
                    <form action="{{ url('mahasiswa/kegiatan') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kategori Kegiatan</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value><----Pilih Kategori Kegiatan----></option>
                                    <option value="laki-laki">Organisasi</option>
                                    <option value="perempuan">Prestasi</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama Kegiatan</label>
                            <div class="col-sm-10">
                                <select class="choices form-select">
                                    <option value="rombo">Pilih Nama Kegiatan</option>
                                    <option value="rectangle">Pengurus Organisasi || Himpunan || Ketua || 130 </option>
                                    <option value="rombo">Rombo</option>
                                    <option value="romboid">Romboid</option>
                                    <option value="trapeze">Trapeze</option>
                                    <option value="traible">Triangle</option>
                                    <option value="polygon">Polygon</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="tgl_lulus" id="tgl_lulus" value="">

                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="exampleFormControlTextarea" class="col-sm-2 col-form-label">Deskripsi</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">
                          </textarea>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="formFile">Bukti Dokumen</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="formFile" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                </div>


                </form>
                <!-- End General Form Elements -->

            </div>
        </div>
        </div>
    </section>

@endsection
