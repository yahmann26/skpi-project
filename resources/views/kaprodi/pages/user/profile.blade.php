@extends('kaprodi.layout.app')
@section('title', ' Profile ')

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('kaprodi.dashboard') }}"><i class="bi bi-house-door"></i></a>
                </li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>

    <section class="section profile">
        <div class="row">

            <div class="col-xl-4">

                <div class="card">
                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="{{ asset('images/user.png') }}" alt="Profile" class="rounded-circle">
                    <h2>{{ $user->kaprodi->nama }}</h2>
                    <h3>{{ $user->role }}</h3>
                  </div>
                </div>

              </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" role="tab"
                                    aria-controls="#profile-change-password" data-bs-target="#profile-change-password">Ubah
                                    Password</button>
                            </li>

                        </ul>

                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Detail Profile</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Kode Dosen</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->kaprodi->kode_dosen }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nama Lengkap</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->kaprodi->nama }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Program Studi</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->kaprodi->prodi->nama }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form id="profileEditForm" action="{{ route('kaprodi.user.update-profile') }}"
                                    method="post">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <label for="kode_dosen" class="col-md-4 col-lg-3 col-form-label">Kode Dosen</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="kode_dosen" type="number" class="form-control" id="kode_dosen"
                                                value="{{ $user->kaprodi->kode_dosen }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fullName" type="text" class="form-control" id="fullName"
                                                value="{{ $user->kaprodi->nama }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email', $user->email) }}" id="email">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->

                                <form id="changePasswordForm" action="{{ route('kaprodi.user.update-password') }}"
                                    method="post">
                                    @csrf
                                    @method('PUT')

                                    {{-- page old password --}}
                                    <div class="row mb-3">
                                        <label for="old_password" class="col-sm-4 col-form-label">Kata Sandi Lama</label>
                                        <div class="col-sm-8">
                                            <input type="password"
                                                class="form-control @error('old_password') is-invalid @enderror"
                                                name="old_password" value="{{ old('old_password') }}" id="old_password">
                                            @error('old_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- page Kata sandi baru --}}
                                    <div class="row mb-3">
                                        <label for="password" class="col-sm-4 col-form-label">Kata Sandi Baru</label>
                                        <div class="col-sm-8">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" value="{{ old('password') }}" id="password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- page Konfirmasi Kata sandi baru --}}
                                    <div class="row mb-3">
                                        <label for="password_confirmation" class="col-sm-4 col-form-label">Konfrimasi Kata
                                            Sandi
                                            Baru</label>
                                        <div class="col-sm-8">
                                            <input type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                name="password_confirmation" value="{{ old('password_confirmation') }}"
                                                id="password_confirmation">
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

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Form Edit Profile
            $('#profileEditForm').on('submit', function(e) {
                e.preventDefault(); // Mencegah pengiriman form default

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(), // Mengambil data dari form
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Profil Anda telah diperbarui.',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = 'Terjadi kesalahan:\n';
                        for (const key in errors) {
                            errorMessage += `${errors[key].join('\n')}\n`;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: errorMessage,
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // Form Change Password
            $('#changePasswordForm').on('submit', function(e) {
                e.preventDefault(); // Mencegah pengiriman form default

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(), // Mengambil data dari form
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Kata sandi Anda telah diperbarui.',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = 'Terjadi kesalahan:\n';
                        for (const key in errors) {
                            errorMessage += `${errors[key].join('\n')}\n`;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: errorMessage,
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
@endpush
