@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">{{$tot->titulo_se}}</h1>
                <p class="lead">{{$tot->detalle_se_se}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
        </div>

            <div class="list-group">
                @foreach($res as $item)
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"></h5>
                        <small>{{$item->desde_ca}}</small>
                    </div>
                    <p class="mb-1">{{$item->comentario_ca}}</p>
                    <small>{{$item->id_re}}</small>
                </a>
                @endforeach
            </div>

    </div>
@endsection