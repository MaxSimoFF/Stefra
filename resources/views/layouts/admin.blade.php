<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
    <!-- My Custom Style -->
    <link rel="stylesheet" href="{{ asset('/assets/admin/dist/css/backend.css') }}">

    @livewireStyles
</head>
<body class="layout-navbar-fixed dark-mode @yield('body-class')">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center bg-dark">
        <img class="animation__wobble" src="{{ asset('assets/images/Logo.png') }}" alt="AdminLTELogo" height="100"
             width="200">
    </div>

<!-- Navbar -->
@include('livewire.admin.includes.navbar')
<!-- /.navbar -->

<!-- Main Sidebar Container -->
@include('livewire.admin.includes.sidebar')

<!-- Content Wrapper. Contains page content -->
{{ $slot }}

<!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('livewire.admin.includes.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/dist/js/adminlte.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/admin/dist/js/demo.js') }}"></script>

@stack('modals')
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    @if (Session::has('success'))
    Toast.fire({
        icon: 'success',
        title: "{{ Session::get('success') }}"
    });
    @endif
    @if (Session::has('warning'))
    Toast.fire({
        icon: 'warning',
        title: "{{ Session::get('warning') }}"
    });
    @endif
</script>
@livewireScripts
<script>
    Livewire.on('success', (msg) => {
        Toast.fire({
            icon: 'success',
            title: msg,
        })
    });
    Livewire.on('error', (msg) => {
        Toast.fire({
            icon: 'error',
            title: msg,
        })
    });
    window.livewire.on('closeModal', () => {
        $(".modal").modal('hide');
    });

</script>
@stack('scripts')

</body>
</html>
