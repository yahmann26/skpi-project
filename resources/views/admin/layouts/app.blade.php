<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title> Admin &mdash; @yield('title')</title>

    @stack('style')

    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Template Main CSS File -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">




</head>

<body>
    {{-- @include('sweetalert:alert') --}}

    @include('admin.components.header')
    @include('admin.components.sidebar')

    <main id="main" class="main">
        @include('admin.components.alert')

        @yield('main')

        @stack('script')

    </main>

    @include('admin.components.footer')

    <!-- End #main -->
</body>



<!-- Vendor JS Files -->
{{-- <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html>
