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

