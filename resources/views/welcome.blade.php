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
                <div class="text-center">
                    <img src="{{asset('images/consupe_logo.svg')}}" class="img-fluid" style="width: 90%">
                    <br><br>
                    <div>
                        <h5>Con el apoyo de la Dirección de Aseguramiento de la Calidad - PUCE</h5>
                    </div>
                </div>
                <div class="links">
                    <a href="{{route('qa.formulario')}}">Ingresar al Calificador de Servicios</a>
                </div>
                <a href="https://www.facebook.com/consupepuce/" class="btn btn-link" target="_blank" style="color: black"><span class="fa fa-facebook-square"></span> fanpage</a>
                <a href="https://consupe.com/contacto/" class="btn btn-link" target="_blank" style="color: black"><span class="fa fa-file-text-o"></span> Contacto</a>
            </div>
        </div>
    </body>
</html>
