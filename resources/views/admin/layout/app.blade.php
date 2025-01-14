<?php

use App\Helper\Skpi;
use Illuminate\Support\Facades\Route;

if (!function_exists('isRouteName')) {
    function isRouteName($routeNames)
    {
        // Get the current route name
        $currentRouteName = Route::currentRouteName();

        // Check if $routeNames is an array
        if (is_array($routeNames)) {
            return in_array($currentRouteName, $routeNames);
        }

        // Check if it's a single route name
        return $currentRouteName === $routeNames;
    }
}

// Uncomment and use these lines as needed
// $logoAplikasiUrl = Skpi::getAssetUrl(Skpi::getSettingByName('logo_universitas'));
// $namaAplikasi = Skpi::getSettingByName('nama_aplikasi');
// $namaInstitusiSingkat = Skpi::getSettingByName('nama_universitas_singkat');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin &mdash; @yield('title')</title>

    <link href="{{ asset('images/unsiq.png') }}" rel="icon">

    <!-- Preconnect and Preload Optimization -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        onload="this.rel='stylesheet'">

    <!-- Stylesheets -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    @stack('style')

</head>

<body>
    @include('admin.components.header')

    @include('admin.components.sidebar')

    <main id="main" class="main">

        @yield('main')

    </main>

    @include('admin.components.footer')

    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus Data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, submit form hapus
                    document.getElementById('deleteForm-' + id).submit();
                }
            });
        }

        //fungsi alert reset password
        function confirmResetPassword(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Password akan di-reset!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, reset password!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, redirect ke URL reset password
                    window.location.href = url;
                }
            });
        }
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    @stack('script')

</body>

</html>
