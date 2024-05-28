<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title> Mahasiswa &mdash; @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i">

    <!-- Vendor CSS Files -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    @stack('style')

</head>

<body>
    {{-- @include('sweetalert:alert') --}}

    @include('mahasiswa.components.header')
    @include('mahasiswa.components.sidebar')

    <main id="main" class="main">
        @include('mahasiswa.components.alert')

        @yield('mahasiswa-main')

        @stack('script')

    </main>

    @include('mahasiswa.components.footer')

    <!-- End #main -->
</body>


<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>
