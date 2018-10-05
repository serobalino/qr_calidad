<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class QrController extends Controller
{
    function crear($token){
        $qr = QrCode::format('png')
            ->margin(0)
            ->size(800)
            ->color(0, 6, 150)
            ->generate(route('qa.busqueda',$token));
        return Image::make($qr)->response();
    }
}
