<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} {{ isset($title) ? '- ' : '' }} {{  $title ?? '' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/css/front/style.min.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/front/frontend.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/toastr.min.css') }}">
    @livewireStyles
</head>
<body>
<!-- Page Content -->
<div class="main-content">
    <header class="header-navbar">
        <!-- nav bar starts here -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container ">
                <div class="row w-100 py-4 px-2">
                    <div class="col-6">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img src="{{ asset('assets/images/Logo.webp') }}" alt="">
                        </a>
                    </div>
                    <div class="col-6 m-auto">
                        <div class='ms-5 text-end'>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <!-- align-middle -->
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item me-sm-3">
                                        <a class="fs-4 nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="nav-item me-sm-3">
                                        <a class="fs-4 nav-link" href="{{ route('store') }}">Store</a>
                                    </li>
                                    <li class="nav-item me-sm-3">
                                        <a class="fs-4 nav-link" href="{{ route('contact') }}">Contact</a>
                                    </li>
                                    @auth
                                        <li class="nav-item">
                                            <a class="fs-4 nav-link" href="{{ route('profile') }}">Account</a>
                                        </li>
                                        <li class="nav-item text-nowrap">
                                            <form class="formLogoutUser" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                            </form>
                                            <a class="fs-4 nav-link" href="javascript:void(0)"
                                               onclick="document.querySelector('.formLogoutUser').submit()">
                                                Log out
                                            </a>
                                        </li>
                                        @if(Auth::user()->is_admin)
                                            <li class="nav-item">
                                                <a class="fs-4 nav-link" href="{{ route('admin.dashboard') }}">Panel</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item me-sm-3 text-nowrap">
                                            <a class="fs-4 nav-link d-inline-block"
                                               href="{{ route('login') }}">Login</a>
                                            <span style="color: #c04747;">/</span>
                                            <a class="fs-4 nav-link d-inline-block" href="{{ route('register') }}">Register</a>

                                        </li>
                                    @endauth
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
                <div class="col-6 text-center text-md-start">
                    <img class="mt-4" width="200" height="40" src="{{ asset('assets/images/Logo.webp') }}" alt="">
                    <p class="mt-1 text-nowrap">Copyright © All Rights Reserved.</p>
                </div>
                <div class="col-6 m-auto text-center text-md-end">
                    <a href="#"><i class='me-1 me-md-3 fab fa-facebook-f fa-lg'></i></a>
                    <a href="#"><i class="me-1 me-md-3 fab fa-youtube fa-lg"></i></a>
                    <a href="#"><i class="me-1 me-md-3 fab fa-instagram fa-lg"></i></a>
                    <a href="#"><i class="me-1 me-md-3 fab fa-twitter fa-lg"></i></a>
                    <a href="#"><i class="me-1 me-md-3 far fa-envelope fa-lg"></i></a>

                </div>
            </div>
        </div>
    </footer>

</div>

@stack('modals')

<script src="{{ asset('/js/front/front.min.js') }}"></script>
<script src="{{ asset('/assets/js/toastr.min.js') }}"></script>
<script defer>
    toastr.options = { // For toastr plugin
        'closeButton': true,
        'preventDuplicates': false,
        'showMethod': 'slideDown',
        'hideMethod': 'slideUp',
        'closeMethod': 'slideUp',
        'progressBar': false,
        "positionClass": "toast-top-right", // toast-top-full-width
    };

    const Toast = Swal.mixin({ // for sweetAlert2 plugin
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    @if (Session::has('success'))
    {{--Toast.fire({--}}
    {{--    icon: 'success',--}}
    {{--    title: "{{ Session::get('success') }}"--}}
    {{--});--}}
        toastr.success("{{ Session::get('success') }}")
    @endif
    @if (Session::has('warning'))
    {{--Toast.fire({--}}
    {{--    icon: 'warning',--}}
    {{--    title: "{{ Session::get('warning') }}"--}}
    {{--});--}}
        toastr.warning("{{ Session::get('warning') }}")
    @endif
</script>
@livewireScripts
<script defer>
    Livewire.on('success', (msg) => {
        // Toast.fire({
        //     icon: 'success',
        //     title: msg,
        // })
        toastr.success(msg)
    });
    Livewire.on('error', (msg) => {
        // Toast.fire({
        //     icon: 'error',
        //     title: msg,
        // })
        toastr.error(msg)
    });
    Livewire.on('warning', (msg) => {
        // Toast.fire({
        //     icon: 'warning',
        //     title: msg,
        // })
        toastr.warning(msg)
    });
</script>
@stack('scripts')

</body>
</html>
