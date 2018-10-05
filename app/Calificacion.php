<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table        =   "calificaciones";
    protected $primaryKey   =   'id_ca';
    public const UPDATED_AT =   'creado_ca';
    public const CREATED_AT =   'creado_ca';
}
