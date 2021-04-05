<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Animal;
use App\Vacuna;
use App\Usuario;
use App\Dominio;

class VacunaController extends Controller
{
    public function Guardar(Request $request)
    {
    	$post = $request->all();
    	$vacuna = new Vacuna;
        $animales = Animal::all()->where('estado', 1);
        $estados = Dominio::all()->where('id_padre', 20);
        if($post) {
            $post = (object) $post;
            
            if(isset($post->id_vacuna)){
                $vacuna = Vacuna::find($post->id_vacuna);
                if($vacuna == null){ echo "Acceso denegado"; die; }
                $animal = $vacuna->animal;
                $vacuna->fecha = str_replace(" ", "T", $vacuna->fecha);
            }
            if(isset($post->id_animal)){
                $animal = Animal::find($post->id_animal);
                if($animal == null){ echo "Acceso denegado"; die; }
                $vacuna->id_animal = $animal->id_animal;
            }
            
        }
    	if($request->except(['id_animal', 'id_vacuna'])){
            $vacuna->fill($request->except(['_token']));
            $vacuna->fecha = str_replace("T", " ", $vacuna->fecha);
            $vacuna->id_usuario_registra = session('id_usuario');
            $file = $request->file('soporte');
            if ($file) {   
                $ruta = '/files/';
                $rnd = rand(0, 9999);  //Generate random number between 0-9999
                $nombre = $rnd . '_' . date('Y-m-d-H-i-s') . '.' . $file->extension();
                $vacuna->soporte = $nombre;
                Storage::makeDirectory($ruta, 0777);
                
                Storage::disk('public')->put($ruta."/".$nombre,  \File::get($file));
            }
            $vacuna->updated_at = date('Y-m-d H:i:s');
            $vacuna->save();
            session()->flash('message', 'Vacuna guardada exitosamente');
            return redirect()->route('animal/vista', $vacuna->id_animal);
    	}

    	return view("vacuna.formulario", compact([
    		'vacuna',  'animales', 'estados'
    	]));
    }
}
