<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/a','QrController@crear');


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::options('/home','ServiciosController@listar');
Route::post('/home','ServiciosController@crear');
Route::put('/home','ServiciosController@editar');
Route::patch('/home','ServiciosController@estadisticas');
Route::delete('/home/{codigo}','ServiciosController@eliminar');

Route::get('/a','CalificarServiciosController@prueba');

Route::prefix('📊')->group(function () {
    Route::get('/resultados/{token}','CalificarServiciosController@resultados')->name('re.qa');
    Route::prefix('servicios')->group(function () {
        Route::get('/','CalificarServiciosController@formualrio')->name('qa.formulario');
        Route::post('/','CalificarServiciosController@buscar');

        Route::get('/{token}','CalificarServiciosController@busqueda')->name('qa.busqueda');
        Route::put('/{token}','CalificarServiciosController@guardar');
        Route::post('/{token}','ArchivosController@subir');
        Route::options('/{token}','ArchivosController@listarMisImagenes');
    });
});

Route::get('image','ArchivosController@mostrar')->name('subida');