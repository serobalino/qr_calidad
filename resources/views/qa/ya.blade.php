@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="alert alert-success" role="alert">
            <p>Ya calificaste el servicio</p>
            <hr>
            <p class="mb-0">No puedes calificar el mismo servicio varias veces</p>
        </div>
        <div class="row">
            <a class="btn btn-link" type="button" href="{{route('qa.formulario')}}"><i class="fa fa-search" aria-hidden="true"></i> Buscar Servicio</a>
        </div>
    </div>
@endsection
