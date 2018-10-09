<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $primaryKey       =   "id_se";
    public $timestamps          =   false;

    protected $hidden           =   ['id_se'];

    protected $appends          =   ['ruta_se','page_se'];

    public function calificaciones(){
        return $this->hasMany(Calificacion::class,'id_se','id_se');
    }

    public function getRutaSeAttribute(){
        return  route('generar.qr',$this->attributes['codigo_se']);
    }

    public function getPageSeAttribute(){
        return  route('qa.busqueda',$this->attributes['codigo_se']);
    }
}
