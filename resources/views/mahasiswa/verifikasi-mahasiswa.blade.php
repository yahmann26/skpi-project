@extends('auth.auth-login')
@section('title', 'Verifikasi')


@section('login')
    <div class="card">
        <div class="login-brand">
            <img src="/img/logo.png" alt="logo" width="100" class="shadow-light rounded-circle" />
        </div>
        <div class="card-header d-flex align-items-center justify-content-center h-60">
            <h3 class="text-center mb-0">Verifikasi Mahasiswa</h3>
        </div>

        <div class="card-body">
            @if (session('status'))
                @if (session('status')["status"])
                <div class="alert alert-success mb-2">
                    {{ session('status')["pesan"] }}
                </div>

                @else
                <div class="alert alert-danger mb-2">
                    {{ session('status')["pesan"] }}
                </div>

                @endif
                @endif
            <form method="post" action="">
                @csrf
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" name="nim"/>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                    </div>
                    <input type="password" class="form-control" name="password"/>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Ulangi Password</label>
                    </div>
                    <input type="password" class="form-control" name="password2"/>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Verifikasi
                    </button>
                </div>
            </form>

            <a href="/login-mahasiswa" class="text-center">Kembali</a>
        </div>
    </div>
@endsection
