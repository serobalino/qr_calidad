<?php

namespace App\Http\Controllers;

use App\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServiciosController extends Controller
{
    public function listar(){
        return Servicio::withCount('calificaciones')->with('cat3.cat2')->get();
    }

    public function editar(Request $datos){
        $validator = Validator::make($datos->all(), [
            'codigo'        =>  'required|exists:servicios,codigo_se',
            'titulo'        =>  'required',
            'descripcion'   =>  'nullable',
            'categoria'     =>  'required|exists:categoria_3,id_c3',
        ]);
        if ($validator->fails()) {
            $mensaje="";
            foreach ($validator->errors()->all() as $item)
                $mensaje.="$item</br>";
            return (['val'=>false,'mensaje'=>$mensaje,'errores'=>$validator->errors()->all()]);
        }else{
            $servicio                   =   Servicio::where('codigo_se',$datos->codigo)->first();
            $servicio->id_c3            =   $datos->categoria;
            $servicio->titulo_se        =   $datos->titulo;
            $servicio->codigo_se        =   $datos->codigo;
            $servicio->descripcion_se   =   $datos->descripcion;
            $servicio->save();
            return (['val'=>true,'mensaje'=>"Se ha guardado $datos->titulo"]);
        }
    }

    public function eliminar($id){
        $sql    =   Servicio::where('codigo_se',$id)->first();
        if($sql){
            DB::beginTransaction();
            try {
                $sql->calificaciones()->delete();
                $sql->delete();
                DB::commit();
                return (['val'=>true,'mensaje'=>'Se ha eliminado exitosamente']);
            } catch (\Exception $e) {
                DB::rollback();
                return (['val' => false, 'mensaje' => "$sql->titulo_se ya tiene calificaciones no se puede eliminar"]);
            }
        }else{
            return (['val'=>false,'mensaje'=>'No se ha encontrado el registro']);
        }

    }

    public function crear(Request $datos){
        $validator = Validator::make($datos->all(), [
            'codigo'        =>  'required|unique:servicios,codigo_se',
            'titulo'        =>  'required',
            'descripcion'   =>  'nullable',
            'categoria'     =>  'required|exists:categoria_3,id_c3'
        ]);
        if ($validator->fails()) {
            $mensaje="";
            foreach ($validator->errors()->all() as $item)
                $mensaje.="$item</br>";
            return (['val'=>false,'mensaje'=>$mensaje,'errores'=>$validator->errors()->all()]);
        }else{
            $servicio                   =   new Servicio();
            $servicio->id_c3            =   $datos->categoria;
            $servicio->titulo_se        =   $datos->titulo;
            $servicio->codigo_se        =   $datos->codigo;
            $servicio->descripcion_se   =   $datos->descripcion;
            $servicio->save();
            return (['val'=>true,'mensaje'=>"Se ha guardado $datos->titulo"]);
        }
    }

    public function codigo(Request $datos){
        $codigo = @$datos->q ? $datos->q : hash('joaat',Servicio::count()+1);
        return ([
            'codigo'    =>  $codigo,
            'imagen'    =>  route('generar.qr',$codigo)
        ]);
    }
}
