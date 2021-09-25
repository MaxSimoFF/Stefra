<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    {{--        <link rel="stylesheet" href="{{ mix('css/app.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    @livewireStyles
</head>
<body>
<!-- Page Content -->
<div class="main-content">
    <header class="header-navbar">
        <!-- nav bar starts here -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container ">
                <div class="row w-100  p-4">
                    <div class="col-6 text-center">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img src="{{ asset('assets/images/Logo.png') }}" alt="">
                        </a>
                    </div>
                    <div class="col-6 m-auto">
                        <div class='ms-5'>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <!-- align-middle -->
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item me-5">
                                        <a class="fs-4 nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="nav-item me-5">
                                        <a class="fs-4 nav-link" href="#">Products</a>
                                    </li>
                                    <li class="nav-item me-5">
                                        <a class="fs-4 nav-link" href="#">Contact</a>
                                    </li>
                                    <li class="nav-item me-5">
                                        <a class="fs-4 nav-link" href="{{ route('store') }}">Store</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- nav bar ends here -->
    </header>
<!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <footer class='bg-dark mt-5'>
        <div class='container text-secondary'>
            <div class="row">
                <div class="col-6 text-center">
                    <img class="mt-3" width="200" height="35" src="{{ asset('assets/images/Logo.png') }}" alt="">
                    <p class="mt-3">Copyright © All Rights Reserved.</p>
                </div>
                <div class="col-6 m-auto text-center">
                    <a href="#"><i class='me-3 fab fa-facebook-f fa-lg'></i></a>
                    <a href="#"><i class="me-3 fab fa-youtube fa-lg"></i><a href="#">
                    <a href="#"><i class="me-3 fab fa-instagram fa-lg"></i><a href="#">
                    <a href="#"><i class="me-3 fab fa-twitter fa-lg"></i><a href="#">
                    <a href="#"><i class="me-3 far fa-envelope fa-lg"></i><a href="#">

                </div>
            </div>
        </div>
    </footer>

</div>

@stack('modals')

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
@livewireScripts

</body>
</html>
