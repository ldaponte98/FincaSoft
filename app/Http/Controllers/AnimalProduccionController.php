<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnimalProduccion;
use App\Animal;

class AnimalProduccionController extends Controller
{
    public function Listado()
    {
        $producciones = AnimalProduccion::all();
        return view("produccion.listado", compact(['producciones']));
    }
    
    public function Guardar(Request $request)
    {
    	$post = $request->all();
        
    	$produccion = new AnimalProduccion;
    	$produccion->fecha_inicio = date('Y-m-d').'T'.date('H:i:s');
    	$produccion->fecha_fin = date('Y-m-d').'T'.date('H:i:s');
        $animales = Animal::all()->where('estado', 1);
        if($post) {
            $post = (object) $post;
            if(isset($post->produccion)){
                $produccion = AnimalProduccion::find($post->produccion);
                if($produccion == null){ echo "Acceso denegado"; die; }
                $produccion->fecha_inicio = str_replace(" ", "T", $produccion->fecha_inicio);
                $produccion->fecha_fin = str_replace(" ", "T", $produccion->fecha_fin);
            }
            if(isset($post->animal)){
                $animal = Animal::find($post->animal);
                if($animal == null){ echo "Acceso denegado"; die; }
                $produccion->id_animal = $animal->id_animal;
            }
        }
    	if($request->except(['animal', 'produccion'])){
            $produccion->fill($request->except(['_token']));
            $produccion->fecha_inicio = str_replace("T", " ", $produccion->fecha_inicio);
            $produccion->fecha_fin = str_replace("T", " ", $produccion->fecha_fin);
            $produccion->id_usuario_registra = session('id_usuario');
            $produccion->updated_at = date('Y-m-d H:i:s');
            if($produccion->save()){
                session()->flash('message', 'Producción guardado exitosamente');
            	return redirect()->route('animal/vista', $produccion->id_animal);
            }
    	}

    	return view("produccion.formulario", compact([
    		'produccion', 'animales'
    	]));
    }
}
