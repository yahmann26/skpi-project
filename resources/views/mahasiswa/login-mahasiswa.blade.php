@extends('auth.auth-login')
@section('title', 'Mahasiswa')

@section('login')
    <div class="card">
        <div class="login-brand">
            <img src="/img/logo.png" alt="logo" width="100" class="shadow-light rounded-circle" />
        </div>
        <div class="card-header d-flex align-items-center justify-content-center h-60">
            <h3 class="text-center mb-0">LOGIN</h3>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
            <form method="post" action="/login-mahasiswa">
                @csrf
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" name="nim"/>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                        {{-- <div class="float-right">
                            <a href="#" class="text-small">
                                Forgot Password?
                            </a>
                        </div> --}}
                    </div>
                    <input type="password" class="form-control" name="password"/>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            </form>

            <p class="mt-3 ">
                <a href="{{ url('verifikasi-mahasiswa')}}" class="text-center"> Verifikasi Akun</a>
            </p>
            <p class="mt-3 ">
                <a href="{{ url('login-dosen')}}" class="text-center"> Login Dosen</a>
            </p>
        </div>
    </div>
@endsection
