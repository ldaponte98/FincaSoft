<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use App\Dominio;
use App\Usuario;
use App\Tercero;

class AnimalController extends Controller
{
    public function Guardar(Request $request)
    {
    	$post = (object) $request->all();
    	$animal = new Animal;
    	$propietario = new Tercero;
    	$animal->fecha_nacimiento = date('Y-m-d');
    	$animal->imagen = "https://app.clez.co/images/sinimagen.jpg";
    	$tipos = Dominio::all()->where('id_padre', 1);
    	$razas = Dominio::all()->where('id_padre', 2);
    	$estados = Dominio::all()->where('id_padre', 3);
    	$origenes = Dominio::all()->where('id_padre', 4);
    	$tipos_identificacion = Dominio::all()->where('id_padre', 16);

    	if($post){

    	}
    	return view("animal.formulario", compact([
    		'animal', 'propietario', 'tipos', 'razas', 'estados', 'origenes', 'tipos_identificacion'
    	]));
    }
}
