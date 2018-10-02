<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{env('APP_NAME')}}</title>
        <link rel="stylesheet" href="{{mix('css/app.css')}}">
    </head>
    <body class="landing">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Inicio</a>
                    @else
                        <a href="{{ route('login') }}">Ingresar</a>
                    @endauth
                </div>
            @endif
            <div class="content">
                <div class="title m-b-md">
                    <img src="{{asset('images/consupe_logo.svg')}}" alt="logo" style="min-width: 100%"/>
                    {{env('APP_NAME')}}
                </div>
                <div class="links">
                    <a href="{{route('qa.formulario')}}">Calificación de Servicios</a>
                </div>
            </div>
        </div>
    </body>
</html>
