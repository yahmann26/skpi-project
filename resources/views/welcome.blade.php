<!DOCTYPE html>
<html lang="en">

@include('app-layouts.head')

<body>

    <!-- Navigation Bar -->
    @include('app-layouts.navbar')

    <!-- Main Content -->
    <main id="main">
        @include('app-layouts.home')
        @include('app-layouts.about')
        {{-- Pastikan untuk mengaktifkan atau menghapus baris berikut jika kontak diperlukan --}}
        {{-- @include('app-layouts.contact') --}}
    </main><!-- End #main -->

    <!-- Footer -->
    @include('app-layouts.footer')

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('FlexStart/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{ asset('FlexStart/assets/vendor/aos/aos.js')}}"></script>
    <script src="{{ asset('FlexStart/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('FlexStart/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{ asset('FlexStart/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{ asset('FlexStart/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('FlexStart/assets/js/main.js')}}"></script>

</body>

</html>
