<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                    <span class="text-muted d-none d-md-block">Con el apoyo de la Dirección de Aseguramiento de la Calidad - PUCE</span>
                </a>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <div class="container">
        <a href="https://www.facebook.com/consupepuce/" class="btn btn-link" target="_blank"><span class="fa fa-facebook-square"></span> fanpage</a>
        <a href="https://consupe.com/contacto/" class="btn btn-link" target="_blank"><span class="fa fa-phone"></span> Contacto</a>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
