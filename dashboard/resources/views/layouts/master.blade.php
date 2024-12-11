<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--favicon-->
    <link rel="icon" href="{{ URL::asset('build/images/favicon-32x32.png') }}" type="image/png">
    <title>@yield('title') | Laravel & Bootstrap 5 Admin Dashboard Template</title>

    @yield('head')
    @yield('css')
    <link href="{{ URL::asset('build/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('build/plugins/select2/css/select2-bootstrap-5-theme.css') }}" rel="stylesheet">
    <style>
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            /* Fondo semi-transparente */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* Asegúrate de que esté por encima de otros elementos */
            display: none;
            /* Oculto por defecto */
        }
    </style>

    @include('layouts.head-css')

</head>

<body>
    <div id="loadingSpinner" class="loading-overlay">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    @include('layouts.topbar')
    @include('layouts.sidebar')

    <!--start main wrapper-->
    <main class="main-wrapper">
        <div class="main-content">

            @yield('content')

        </div>
    </main>
    <!--end main wrapper-->

    <!--start overlay-->
    <div class="overlay btn-toggle"></div>
    <!--end overlay-->

    @include('layouts.footer')

    @include('layouts.cart')

    @include('layouts.right-sidebar')

    @include('layouts.vendor-scripts')

    @yield('scripts')

</body>

</html>
