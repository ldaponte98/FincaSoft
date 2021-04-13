<?php

use Illuminate\Support\Facades\Route;

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
    return view('sitio.login');
});
Route::get('panel', 'UsuarioController@Panel')->name('panel');
Route::post('validar_login','UsuarioController@ValidarLogin')->name('validar_login');
Route::get('cerrar_sesion', 'UsuarioController@CerrarSesion')->name('cerrar_sesion');


//ANIMAL
Route::any('animal/registrar','AnimalController@Guardar')->name('animal/registrar');
Route::any('animal/editar','AnimalController@Guardar')->name('animal/editar');
Route::any('animal/vista/{id}','AnimalController@Vista')->name('animal/vista');


//TERCERO
Route::any('tercero/vista/{id}','TerceroController@Vista')->name('tercero/vista');
Route::any('tercero/validar_identificacion/{identificacion}', 'TerceroController@ValidarIdentificacion')->name('tercero/validar_identificacion');


//TRATAMIENTO
Route::any('tratamiento/registrar','TratamientoController@Guardar')->name('tratamiento/registrar');
Route::any('tratamiento/editar','TratamientoController@Guardar')->name('tratamiento/editar');
Route::any('tratamiento/listado','TratamientoController@Listado')->name('tratamiento/listado');

//PESAJE
Route::any('pesaje/registrar','AnimalPesajeController@Guardar')->name('pesaje/registrar');
Route::any('pesaje/editar','AnimalPesajeController@Guardar')->name('pesaje/editar');
Route::any('pesaje/listado','AnimalPesajeController@Listado')->name('pesaje/listado');

//PRODUCCION
Route::any('produccion/registrar','AnimalProduccionController@Guardar')->name('produccion/registrar');
Route::any('produccion/editar','AnimalProduccionController@Guardar')->name('produccion/editar');
Route::any('produccion/listado','AnimalProduccionController@Listado')->name('produccion/listado');
//SITIO
Route::any('sitio/buscar_tercero_animal/{caracteres}','SitioController@BuscarTerceroAnimal')->name('sitio/buscar_tercero_animal');

