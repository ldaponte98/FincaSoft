<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Animal;
use App\Dominio;
use App\Usuario;
use App\Tercero;
use App\Tratamiento;
use App\AnimalPesaje;
use App\AnimalProduccion;

class AnimalController extends Controller
{
    public function Vista($id_animal)
    {
        $animal = Animal::find($id_animal);
        $tratamientos = Tratamiento::where('id_animal', $id_animal)->orderBy('fecha', 'desc')->get();
        $pesajes = AnimalPesaje::where('id_animal', $id_animal)->orderBy('fecha', 'desc')->get();
        $producciones = AnimalProduccion::where('id_animal', $id_animal)->orderBy('fecha_inicio', 'desc')->get();

        $tratamientos_por_mes = [];
        $pesajes_por_mes = [];
        $producciones_por_mes = [];
        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

        foreach ($tratamientos as $tratamiento) {
            $num_mes = date('n', strtotime($tratamiento->fecha));
            $mes = $meses[$num_mes - 1];
            $año = date('Y', strtotime($tratamiento->fecha));
            $tratamiento->dia_mes = date('d',strtotime($tratamiento->fecha))." ".$mes;
            $tratamientos_por_mes[$mes." ".$año]['tratamientos'][] = (object) $tratamiento; 
        }

        foreach ($pesajes as $pesaje) {
            $num_mes = date('n', strtotime($pesaje->fecha));
            $mes = $meses[$num_mes - 1];
            $año = date('Y', strtotime($pesaje->fecha));
            $pesaje->dia_mes = date('d',strtotime($pesaje->fecha))." ".$mes;
            $pesajes_por_mes[$mes." ".$año]['pesajes'][] = (object) $pesaje; 
        }

        foreach ($producciones as $produccion) {
            $num_mes = date('n', strtotime($produccion->fecha_inicio));
            $mes = $meses[$num_mes - 1];
            $año = date('Y', strtotime($produccion->fecha_inicio));
            $produccion->dia_mes = date('d',strtotime($produccion->fecha_inicio))." ".$mes;
            $producciones_por_mes[$mes." ".$año]['producciones'][] = (object) $produccion; 
        }
        return view("animal.vista", compact(['animal', 'tratamientos_por_mes', 'pesajes_por_mes', 'producciones_por_mes']));
    }

    public function Guardar(Request $request)
    {
    	$post = $request->all();
    	$animal = new Animal;
    	$propietario = new Tercero;
        $propietario->imagen = "";
    	$animal->fecha_nacimiento = date('Y-m-d');
    	$animal->imagen = "";
    	$tipos = Dominio::all()->where('id_padre', 1);
    	$razas = Dominio::all()->where('id_padre', 2);
    	$estados = Dominio::all()->where('id_padre', 3);
    	$origenes = Dominio::all()->where('id_padre', 4);
    	$tipos_identificacion = Dominio::all()->where('id_padre', 16);
        if($post) {
            $post = (object) $post;
            if(isset($post->id)){
                $animal = Animal::find($post->id);
                if($animal == null){ echo "Acceso denegado"; die; }
                $propietario = $animal->propietario;
            }
        }
    	if($request->except(['id'])){
            $post = (object) $post;
            $datos_animal = $request->except(['_token']);
            $datos_propietario = $request->except(['_token']);
            $animal->fill($datos_animal);
            $propietario_busqueda = Tercero::where('identificacion', $post->identificacion)->first();
            if($propietario_busqueda) $propietario = $propietario_busqueda;
            $propietario->fill($datos_propietario);
            $animal->id_usuario_registra = session('id_usuario');

            if($animal->prenado == 1 and $post->tiempo_prenado != "" and $post->tiempo_prenado != null and $animal->fecha_deteccion_prenado == null){
                $animal->fecha_deteccion_prenado = date('Y-m-d', strtotime(date('Y-m-d')." -".$post->tiempo_prenado." days"));
            }
            if($animal->save() and $propietario->save()){
                $file_animal = $request->file('imagen_animal');
                $file_propietario = $request->file('imagen_propietario');
                $animal->id_tercero_propietario = $propietario->id_tercero;
                $animal->save();
                if ($file_animal) {   
                    $ruta = '/images/animales/';
                    $rnd = rand(0, 9999);  // generate random number between 0-9999
                    $nombre = $rnd . '_' . $animal->referencia . '.' . $file_animal->extension();
                    $animal->imagen = $nombre;
                    Storage::makeDirectory($ruta, 0777);
                    Storage::disk('public')->put($ruta."/".$nombre,  \File::get($file_animal));

                    //edito al animal
                    $animal->imagen = $nombre;
                    $animal->save();
                }

                if ($file_propietario) {   
                    $ruta = '/images/terceros/';
                    $rnd = rand(0, 9999);  // generate random number between 0-9999
                    $nombre = $rnd . '_' . $propietario->identificacion . '.' . $file_propietario->extension();
                    $animal->imagen = $nombre;
                    Storage::makeDirectory($ruta, 0777);
                    Storage::disk('public')->put($ruta."/".$nombre,  \File::get($file_propietario));

                    //edito al animal
                    $propietario->imagen = $nombre;
                    $propietario->save();
                }

                 $request->session()->flash('message', 'Información guardada exitosamente');
                return redirect()->route("animal/vista", ['id' => $animal->id_animal]);
            }
            
    	}

        $animal->tiempo_prenado = $animal->dias_prenado();

    	return view("animal.formulario", compact([
    		'animal', 'propietario', 'tipos', 'razas', 'estados', 'origenes', 'tipos_identificacion'
    	]));
    }
}
