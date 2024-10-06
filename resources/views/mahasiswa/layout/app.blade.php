<?php

use App\Helper\Skpi;

if (!function_exists('isRouteName')) {
    function isRouteName($routeNames)
    {
        if (is_array($routeNames)) {
            foreach ($routeNames as $routeName) {
                if (Route::currentRouteName() == $routeName) {
                    return true;
                }
            }
        } else {
            if (Route::currentRouteName() == $routeNames) {
                return true;
            }
        }
    }
}

// $logoAplikasiUrl = Skpi::getAssetUrl(Skpi::getSettingByName('logo_universitas'));
// $namaAplikasi = Skpi::getSettingByName('nama_aplikasi');
// $namaInstitusiSingkat = Skpi::getSettingByName('nama_universitas_singkat');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Mahasiswa &mdash; @yield('title')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">

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
    @include('mahasiswa.components.header')

    @include('mahasiswa.components.sidebar')

    <main id="main" class="main">

        @yield('main')

    </main>

    @include('mahasiswa.components.footer')

    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @stack('script')

</body>

</html>
