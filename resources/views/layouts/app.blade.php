<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('backend/images/favicon.jpg') }}" sizes="16x16">
    <meta name="site-url" content="{{ url('/') }}">

    <title>{{ config('app.name', 'Formwood') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/material-vendors.min.css') }}">
    <link href="{{ asset('backend/css/admin-panel.css') }}" rel="stylesheet">
</head>
<body class="vertical-layout vertical-compact-menu material-vertical-layout material-layout bg-gradient 1-column blank-page menu-open" data-open="click" data-menu="vertical-compact-menu" data-col="1-column">
    <div class="app-content content">
        @yield('content')
    </div>
</body>
</html>