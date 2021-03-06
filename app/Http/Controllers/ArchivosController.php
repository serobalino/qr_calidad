<?php

namespace App\Http\Controllers;

use App\Calificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ArchivosController extends Controller
{
    public function subir(Request $datos){
        $id     =   session()->getId();
        $path   =   Storage::disk('temporal')->getAdapter()->getPathPrefix();
        $files  =   $datos->file('file');
        $i=0;
        foreach($files as $file){
            $i++;
            $img = Image::make($file)->encode('jpg', 0);
            $img->save("$path$id.jpg");
            unset($img);
        }
        return (['val'=>true]);
    }

    public function listarMisImagenes(){
        $id     =   session()->getId();
        $lista  =   Storage::disk('temporal')->exists("$id.jpg");
        if($lista)
            return route('subida');
    }

    public function mostrar(){
        $id     =   session()->getId();
        $lista  =   Storage::disk('temporal')->get("$id.jpg");
        if($lista)
            return Image::make($lista)->response();
        return abort(404);
    }

    public function guardarEnServicio(Calificacion $datos){
        $id     =   session()->getId();
        if(Storage::disk('temporal')->exists("$id.jpg")){
            $file = Storage::disk('temporal')->url("$id.jpg");
            Storage::disk('servicios')->makeDirectory($datos->id_se);
            $full_path_source = Storage::disk('temporal')->getDriver()->getAdapter()->applyPathPrefix(basename($file));
            $full_path_dest = Storage::disk('servicios')->getDriver()->getAdapter()->applyPathPrefix($datos->id_se . '/' . basename($file));
            File::move($full_path_source, $full_path_dest);
            Storage::disk('temporal')->delete("$id.jpg");
        }
    }

    public function imagenGuardada($servicio,$token){
        if(Storage::disk('servicios')->exists("$servicio/$token.jpg")){
            $lista  =   Storage::disk('servicios')->get("$servicio/$token.jpg");
            return Image::make($lista)->response();
        }
    }
}
