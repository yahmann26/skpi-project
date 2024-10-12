@extends('dosen.layout.app')
@section('title', ' Profile ')

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dosen.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item ">Dosen</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-8">
                <div class="card overflow-auto">
                    <div class="card-body" style="min-height: 300px">
                        <div class="card-title">Ubah Profil</div>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                {!! session('success') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                {!! session('error') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('dosen.user.update-profile') }}" method="post">
                            @csrf
                            @method('PUT')

                             {{-- page kode_dosen --}}
                             <div class="row mb-3">
                                <label for="kode_dosen" class="col-sm-2 col-form-label">Kode Dosen</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" disabled name="kode_dosen"
                                        value="{{ $user->dosen->kode_dosen }}" id="kode_dosen">
                                </div>
                            </div>

                             {{-- page nama --}}
                             <div class="row mb-3">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" disabled name="nama"
                                        value="{{ $user->dosen->nama }}" id="nama">
                                </div>
                            </div>

                             {{-- page email --}}
                             <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', $user->email) }}" id="email">
                                        @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>

                            <div class="mb-3 mt-4">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="row">
            <div class="col-md-8">
                <div class="card overflow-auto">
                    <div class="card-body" style="min-height: 300px">
                        <div class="card-title">Ubah Password</div>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                {!! session('success') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                {!! session('error') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('dosen.user.update-password') }}" method="post">
                            @csrf
                            @method('PUT')

                            {{-- page old password --}}
                            <div class="row mb-3">
                                <label for="old_password" class="col-sm-4 col-form-label">Kata Sandi Lama</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password"
                                        value="{{ old('old_password') }}" id="old_password">
                                        @error('old_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>

                            {{-- page Kata sandi baru --}}
                            <div class="row mb-3">
                                <label for="password" class="col-sm-4 col-form-label">Kata Sandi Baru</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                        value="{{ old('password') }}" id="password">
                                        @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>

                            {{-- page Konfirmasi Kata sandi baru --}}
                            <div class="row mb-3">
                                <label for="password_confirmation" class="col-sm-4 col-form-label">Konfrimasi Kata Sandi Baru</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                        value="{{ old('password_confirmation') }}" id="password_confirmation">
                                        <small class="text-muted">Ulang kata sandi baru untuk memastikan</small>
                                        @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>

                            <div class="mb-3 mt-4">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
