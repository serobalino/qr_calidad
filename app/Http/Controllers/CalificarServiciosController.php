<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalificarServiciosController extends Controller
{
    public function formualrio(){
        return route('qa.busqueda',23423);
    }

    public function busqueda($token){
        return $token;
    }
}
