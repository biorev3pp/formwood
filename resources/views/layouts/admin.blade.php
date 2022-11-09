<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('backend/images/favicon.jpg') }}" sizes="16x16">
    <meta name="site-url" content="{{ url('/') }}"> 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Formwood Product Builder</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/material-icons/material-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/material-vendors.min.css') }}">
    <link href="{{ asset('backend/css/admin-panel.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet">
</head>
<body class="vertical-layout vertical-compact-menu material-vertical-layout material-layout 2-columns  fixed-navbar {{ in_array($menu, ['models', 'media', 'pages'])?'todo-application':'' }}" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
    @include('elements.header')
    @include('elements.menu')
    <div class="app-content content">
        @yield('content')
    </div>
    @include('elements.footer')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script>
        const siteURL = document.querySelector('meta[name="site-url"]').content;
    </script>
    @if(Route::currentRouteName() != 'analytics')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    @endif
    @stack('scripts')
</body>
</html>