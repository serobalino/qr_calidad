@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">{{$servicio->titulo_se}}</h4>
            <hr>
            <p>{{$servicio->descripcion_se}}</p>
        </div>
        <calificacion></calificacion>
    </div>
@endsection