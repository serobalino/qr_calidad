<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('qr/{token}','QrController@crear')->name('generar.qr');

Route::get('servicio/codigo','ServiciosController@codigo');


Route::prefix('lista')->group(function () {
    Route::get('c1','ListasController@listaCat1');
    Route::get('c2/{codigo}','ListasController@listaCat2');
    Route::get('c3/{codigo}','ListasController@listaCat3');
});