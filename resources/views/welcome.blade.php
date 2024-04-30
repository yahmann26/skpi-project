<!DOCTYPE html>
<html lang="en">

@include('app-layouts.head')

<body>

    @include('app-layouts.navbar')

    @include('app-layouts.home')

    <main id="main">

        @include('app-layouts.about')

        {{-- @include('app-layouts.contact') --}}

    </main><!-- End #main -->

    @include('app-layouts.footer')
    {{-- @include('app-layouts.contact') --}}

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/FlexStart/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="/FlexStart/assets/vendor/aos/aos.js"></script>
    <script src="/FlexStart/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/FlexStart/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/FlexStart/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/FlexStart/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/FlexStart/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/FlexStart/assets/js/main.js"></script>

</body>

</html>
