<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class QrController extends Controller
{
    function crear(){
        $qr = QrCode::
            format('png')
            ->margin(0)
            ->size(800)
//            ->color(0,178,244)
            ->generate('Mateo 32115');
        //return $qr;
        $qr = Image::make($qr);
        //$qr->crop(800, 800, 100, 100);
        // color #00b2f4
        return ($qr)->response();
    }
}
