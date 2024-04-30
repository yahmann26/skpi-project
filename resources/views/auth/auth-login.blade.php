<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
    <title> Login &mdash; @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/modules/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/modules/fontawesome/css/all.min.css" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/components.css" />

</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        @yield('login')
                        <div class="simple-footer">Copyright &copy; Vyzz</div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="/js/stisla.js"></script>
</body>

</html>
