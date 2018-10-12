<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria3 extends Model
{
    protected $table        =       "categoria_3";
    protected $primaryKey   =       "id_c3";
    public $timestamps      =       false;

    public function cat2(){
        return $this->belongsTo(Categoria2::class,'id_c2','id_c2');
    }
}
