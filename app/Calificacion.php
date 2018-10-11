<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Calificacion extends Model
{
    protected $table        =   "calificaciones";
    protected $primaryKey   =   'id_ca';
    public $incrementing    =   false;
    public const UPDATED_AT =   'creado_ca';
    public const CREATED_AT =   'creado_ca';

    protected $appends          =   ['image_ca'];

    public function getImageCaAttribute(){
        if(Storage::disk('servicios')->exists($this->attributes['id_se'].'/'.$this->attributes['id_ca'].'.jpg'))
            return  route('generar.image',['servicio'=>$this->attributes['id_se'],'token'=>$this->attributes['id_ca']]);
        else
            return false;
    }
}
