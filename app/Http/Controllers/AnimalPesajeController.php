<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnimalPesaje;
use App\Animal;

class AnimalPesajeController extends Controller
{
	public function Listado()
    {
        $pesajes = AnimalPesaje::all();
        return view("pesaje.listado", compact(['pesajes']));
    }

    public function Guardar(Request $request)
    {
    	$post = $request->all();
        
    	$pesaje = new AnimalPesaje;
    	$pesaje->fecha = date('Y-m-d').'T'.date('H:i:s');
        $animales = Animal::all()->where('estado', 1);
        if($post) {
            $post = (object) $post;
            if(isset($post->pesaje)){
                $pesaje = AnimalPesaje::find($post->pesaje);
                if($pesaje == null){ echo "Acceso denegado"; die; }
                $pesaje->fecha = str_replace(" ", "T", $pesaje->fecha);
                $animal = $pesaje->animal;
            }
            if(isset($post->animal)){
                $animal = Animal::find($post->animal);
                if($animal == null){ echo "Acceso denegado"; die; }
                $pesaje->id_animal = $animal->id_animal;
            }
        }
    	if($request->except(['animal', 'pesaje'])){
            $pesaje->fill($request->except(['_token']));
            $pesaje->fecha = str_replace("T", " ", $pesaje->fecha);
            $pesaje->id_usuario_registra = session('id_usuario');
            $file = $request->file('soporte');
            $pesaje->updated_at = date('Y-m-d H:i:s');

            $animal = isset($post->id_animal) ? Animal::find($post->id_animal) : Animal::find($animal->id_animal);

            $pesaje->peso_anterior = $animal->peso; 
            if($pesaje->save()){
            	$animal->peso = $pesaje->peso_medido;
            	$animal->save();
                session()->flash('message', 'Pesaje guardado exitosamente');
            	return redirect()->route('animal/vista', $pesaje->id_animal);
            }
    	}

    	return view("pesaje.formulario", compact([
    		'pesaje', 'animales'
    	]));
    }
}
