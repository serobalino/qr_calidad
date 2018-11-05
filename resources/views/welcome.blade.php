<!doctype html>
<html lang="{{ app()->getLocale() }}" class="landing">
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

                    @endauth
                </div>
            @endif
            <div class="content">
                <div class="title m-b-md d-none d-md-block">
                    ​<picture>
                        <source srcset="{{asset('images/consupe_logo.svg')}}" type="image/svg+xml">
                        <img src="{{asset('images/consupe_logo.svg')}}" class="img-fluid" alt="...">
                    </picture>
                    <br><br>
                    <h3>Con el apoyo de la Dirección de Aseguramiento de la Calidad - PUCE</h3>
                </div>
                <div class="d-block d-sm-none text-center">
                    <img src="{{asset('images/consupe_logo.svg')}}" class="img-fluid" alt="...">
                    <br><br>
                    <h3>Con el apoyo de la Dirección de Aseguramiento de la Calidad - PUCE</h3>
                </div>
                <div class="links">
                    <a href="{{route('qa.formulario')}}">Ingresar al Calificador de Servicios</a>
                </div>
                <a href="https://www.facebook.com/consupepuce/" class="btn btn-link" target="_blank"><span class="fa fa-facebook-square"></span> fanpage</a>
                <a href="https://consupe.com/contacto/" class="btn btn-link" target="_blank"><span class="fa fa-phone"></span> Contacto</a>
            </div>
        </div>
    </body>
</html>
