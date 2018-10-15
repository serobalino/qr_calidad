@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">{{$tot->titulo_se}}</h1>
                <p class="lead">{{$tot->detalle_se_se}}</p>
            </div>
        </div>
        <div class="card card-block bg-faded">
            <div class="row align-items-center text-center">
                <div class="col">
                    <span class="options reactions reaction r1"></span><br>
                    Me gusta <b>{{$rea['r1']}}</b>
                </div>
                <div class="col">
                    <span class="options reactions reaction r2"></span><br>
                    Me encanta <b>{{$rea['r2']}}</b>
                </div>
                <div class="col">
                    <span class="options reactions reaction r3"></span><br>
                    Me enorgullece <b>{{$rea['r3']}}</b>
                </div>
                <div class="col">
                    <span class="options reactions reaction r4"></span><br>
                    Me asombra <b>{{$rea['r4']}}</b>
                </div>
                <div class="col">
                    <span class="options reactions reaction r5"></span><br>
                    Me divierte <b>{{$rea['r5']}}</b>
                </div>
                <div class="col">
                    <span class="options reactions reaction r6"></span><br>
                    Me entristece <b>{{$rea['r6']}}</b>
                </div>
                <div class="col">
                    <span class="options reactions reaction r7"></span><br>
                    Me enoja <b>{{$rea['r7']}}</b>
                </div>
            </div>
        </div>
        <br>
            <div class="list-group">
                @foreach($res as $item)
                <a href="{{$item->image_ca}}" target="_blank" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1">
                            @if ($item->image_ca)
                            <i class="fa fa-paperclip" aria-hidden="true"></i>
                            @endif
                        </h6>
                        <small>{{$item->desde_ca}}</small>
                    </div>
                    <p class="mb-1">{{$item->comentario_ca}}</p>
                    <small ><span class="options reactions reaction r{{$item->id_re}}"></span></small>
                </a>
                @endforeach
            </div>

    </div>
@endsection