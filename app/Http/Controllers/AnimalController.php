<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Animal;
use App\Dominio;
use App\Usuario;
use App\Tercero;
use App\Vacuna;

class AnimalController extends Controller
{
    public function Vista($id_animal)
    {
        $animal = Animal::find($id_animal);
        $vacunas = Vacuna::where('id_animal', $id_animal)->orderBy('fecha', 'desc')->get();

        $vacunas_by_month = [];
        $meses = ["Enero", "Fecbrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        foreach ($vacunas as $vacuna) {
            $num_mes = date('n', strtotime($vacuna->fecha));
            $mes = $meses[$num_mes - 1];
            $año = date('Y', strtotime($vacuna->fecha));
            $vacuna->dia_mes = date('d',strtotime($vacuna->fecha))." ".$mes;
            $vacunas_by_month[$mes." ".$año]['vacunas'][] = (object) $vacuna; 
        }
        //$vacunas_by_month = array_reverse($vacunas_by_month);
        //dd($vacunas_by_month);die;
        return view("animal.vista", compact(['animal', 'vacunas_by_month']));
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
    	return view("animal.formulario", compact([
    		'animal', 'propietario', 'tipos', 'razas', 'estados', 'origenes', 'tipos_identificacion'
    	]));
    }
}
