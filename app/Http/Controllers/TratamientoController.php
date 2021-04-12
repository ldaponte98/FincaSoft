<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Animal;
use App\Tratamiento;
use App\Usuario;
use App\Dominio;

class tratamientoController extends Controller
{
    public function Guardar(Request $request)
    {
    	$post = $request->all();
        
    	$tratamiento = new Tratamiento;
        $animales = Animal::all()->where('estado', 1);
        $estados = Dominio::all()->where('id_padre', 20);

        if($post) {
            $post = (object) $post;
            
            if(isset($post->tratamiento)){
                $tratamiento = Tratamiento::find($post->tratamiento);
                if($tratamiento == null){ echo "Acceso denegado"; die; }
                $animal = $tratamiento->animal;
                $tratamiento->fecha = str_replace(" ", "T", $tratamiento->fecha);
            }
            if(isset($post->animal)){
                $animal = Animal::find($post->animal);
                if($animal == null){ echo "Acceso denegado"; die; }
                $tratamiento->id_animal = $animal->id_animal;
            }
            
        }
    	if($request->except(['animal', 'tratamiento'])){
            $tratamiento->fill($request->except(['_token']));
            $tratamiento->fecha = str_replace("T", " ", $tratamiento->fecha);
            $tratamiento->id_usuario_registra = session('id_usuario');
            $file = $request->file('soporte');
            if ($file) {   
                $ruta = '/files/';
                $rnd = rand(0, 9999);  //Generate random number between 0-9999
                $nombre = $rnd . '_' . date('Y-m-d-H-i-s') . '.' . $file->extension();
                $tratamiento->soporte = $nombre;
                Storage::makeDirectory($ruta, 0777);
                
                Storage::disk('public')->put($ruta."/".$nombre,  \File::get($file));
            }
            $tratamiento->updated_at = date('Y-m-d H:i:s');
            if($tratamiento->save()){
                if (isset($post->dosis)) {
                    //CONTAMOS CUANTAS DOSIS YA HAY REGISTRADAS
                    $cont = count($tratamiento->dosis); 
                    foreach ($post->dosis as $fecha_dosis) {
                        $cont++;
                        $new_dosis = $tratamiento->replicate();
                        $new_dosis->nombre = $new_dosis->nombre." - ".$cont." Dosis";
                        $new_dosis->fecha = str_replace(" ", "T", $fecha_dosis);
                        $fecha = date('Y-m-d H:i', strtotime($fecha_dosis));

                        $new_dosis->id_dominio_estado = $fecha > date('Y-m-d H:i') ? 22 /*PROGRAMADO*/ : 21 /*APLICADA*/;
                        $new_dosis->id_usuario_registra = session('id_usuario');
                        $new_dosis->id_tratamiento_padre = $tratamiento->id_tratamiento;
                        $new_dosis->save();
                    }
                }
            }

            session()->flash('message', 'Tratamiento guardada exitosamente');
            return redirect()->route('animal/vista', $tratamiento->id_animal);
    	}

    	return view("tratamiento.formulario", compact([
    		'tratamiento',  'animales', 'estados'
    	]));
    }
}
