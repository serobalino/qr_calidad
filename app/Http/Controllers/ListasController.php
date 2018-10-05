<?php

namespace App\Http\Controllers;

use App\Categoria1;
use App\Categoria2;
use App\Categoria3;
use Illuminate\Http\Request;

class ListasController extends Controller
{
    public function listaCat1(){
        return Categoria1::select('id_c1 AS id','titulo_c1 AS name')->get();
    }

    public function listaCat2($codigo){
        return Categoria2::where('id_c1',$codigo)->select('id_c2 AS id','titulo_c2 AS name')->get();
    }

    public function listaCat3($codigo){
        return Categoria3::where('id_c2',$codigo)->select('id_c3 AS id','titulo_c3 AS name')->get();
    }

}
