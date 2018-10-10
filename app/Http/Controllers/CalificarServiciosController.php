<?php

namespace App\Http\Controllers;

use App\Calificacion;
use App\Servicio;
use Illuminate\Http\Request;
use Request as Publico;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\DeviceParserAbstract;

class CalificarServiciosController extends Controller
{
    public function formualrio(){
        //return route('qa.busqueda',23423);
        return view('qa.busqueda');
    }

    public function buscar(Request $datos){
        return Servicio::where('codigo_se',$datos->q)->orWhere('titulo_se','like',"%$datos->q%")->get();
    }

    public function busqueda($token){
        $servicio = Servicio::where('codigo_se',$token)->first();
        if($servicio){
            $session_id = session()->getId();
            $qa = Calificacion::where('id_ca',$session_id)->where('id_se',$servicio->id_se)->first();
            if($qa){
                return view('qa.ya');
            }else{
                return view('qa.puede',['servicio'=>$servicio]);
            }
        }else{
            return abort(404);
        }
    }

    public function comprobar(Calificacion $datos){
        DeviceParserAbstract::setVersionTruncation(DeviceParserAbstract::VERSION_TRUNCATION_NONE);
        $userAgent = $_SERVER['HTTP_USER_AGENT']; // change this to the useragent you want to parse
        $dd = new DeviceDetector($userAgent);
        $dd->parse();

        $datos->os_ca           =   @$dd->getOs()['name']." ".@$dd->getOs()['version'];
        $datos->navegador_ca    =   @$dd->getClient()['name'];
        $datos->tipo_ca         =   @$dd->getDeviceName();
        $datos->ip_ca           =   Publico::ip();
    }

    public function guardar($token,Request $datos){
        $servicio = Servicio::where('codigo_se',$token)->first();
        if($servicio) {
            $session_id = session()->getId();
            $qa = Calificacion::where('id_ca', $session_id)->where('id_se', $servicio->id_se)->first();
            if(!$qa){
                $qa                 =   new Calificacion();
                $qa->id_ca          =   $session_id;
                $qa->id_se          =   $servicio->id_se;
                $qa->id_re          =   $datos->reaacion;
                $qa->comentario_ca  =   $datos->comentario;
                $this->comprobar($qa);
                //$qa->save();
                return app( 'App\Http\Controllers\ArchivosController')->guardarEnServicio($qa);
                return (['val'=>true,'mensaje'=>'Se ha guardado su calificación']);
            }else{
                return (['val'=>false,'mensaje'=>'Ya tiene registrada una calificación a este servicio']);
            }
        }else{
            return abort(404);
        }

    }
}
