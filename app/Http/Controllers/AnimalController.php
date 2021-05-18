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
    	$tipos = Dominio::all()->where('id_padre', 1)->where('estado', 1);
    	$razas = Dominio::all()->where('id_padre', 2)->where('estado', 1);
    	$estados = Dominio::all()->where('id_padre', 3)->where('estado', 1);
    	$origenes = Dominio::all()->where('id_padre', 4)->where('estado', 1);
    	$tipos_identificacion = Dominio::all()->where('id_padre', 16)->where('estado', 1);
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

    public function Listado(Request $request)
    {
        $post = $request->all();
        $animales = Animal::all();
        $id_dominio_raza = 0;
        $id_dominio_estado = 0;
        $prenado = -1;
        $id_tercero_propietario = 0;
        $propietarios = DB::select("SELECT distinct(t.id_tercero) as id_tercero, 
                                    CONCAT(t.nombres,' ', t.apellidos) as propietario
                                    FROM tercero t 
                                    INNER JOIN animal a ON t.id_tercero = a.id_tercero_propietario");
        $edad_inicio = "";
        $edad_fin = "";
        $id_usuario_registra = 0;
        $peso_inicio = "";
        $peso_fin = "";
        $id_dominio_origen = 0;
        $id_dominio_sexo = 0;
        if($post){
            $data = [];
            $post = (object) $post;
            $id_dominio_raza = isset($post->id_dominio_raza) ? $post->id_dominio_raza : null;
            $id_dominio_estado = isset($post->id_dominio_estado) ? $post->id_dominio_estado : null;
            $prenado = isset($post->prenado) ? $post->prenado : null;
            $id_tercero_propietario = isset($post->id_tercero_propietario) ? $post->id_tercero_propietario : null;
            $edad_inicio = isset($post->edad_inicio) ? $post->edad_inicio : null;
            $edad_fin = isset($post->edad_fin) ? $post->edad_fin : null;
            $id_usuario_registra = isset($post->id_usuario_registra) ? $post->id_usuario_registra : null;
            $peso_inicio = isset($post->peso_inicio) ? $post->peso_inicio : null;
            $peso_fin = isset($post->peso_fin) ? $post->peso_fin : null;
            $id_dominio_origen = isset($post->id_dominio_origen) ? $post->id_dominio_origen : null;
            $id_dominio_sexo = isset($post->id_dominio_sexo) ? $post->id_dominio_sexo : null;
            foreach ($animales as $animal) {
                $add = true;
                if($id_dominio_raza != 0) 
                    $add = $animal->id_dominio_raza == $id_dominio_raza ? true : false;
                if($id_dominio_estado != 0 and $add) 
                    $add = $animal->id_dominio_estado == $id_dominio_estado ? true : false;
                if($prenado != -1 and $add) 
                    $add = $animal->prenado == $prenado ? true : false;
                if($id_tercero_propietario != 0 and $add) 
                    $add = $animal->id_tercero_propietario == $id_tercero_propietario ? true : false;
                if($id_dominio_origen != 0 and $add) 
                    $add = $animal->id_dominio_origen == $id_dominio_origen ? true : false;
                if($id_usuario_registra != 0 and $add) 
                    $add = $animal->id_usuario_registra == $id_usuario_registra ? true : false;
                if($id_dominio_sexo != 0 and $add) 
                    $add = $animal->id_dominio_sexo == $id_dominio_sexo ? true : false;
                if($edad_inicio != null and $edad_fin != null and $add){
                    $add = ($animal->edad() != "No definida" and $animal->edad() >= $edad_inicio and $animal->edad() <= $edad_fin) ? true : false;
                }
                if($peso_inicio != null and $peso_fin != null and $add){
                    $add = ($animal->peso >= $peso_inicio and $animal->peso <= $peso_fin) ? true : false;
                }

                if($add) $data[] = $animal;
            }
            $animales = $data;
        }
        return view('animal.listado', compact([
            'animales', 'id_dominio_raza', 'id_dominio_estado', 
            'prenado', 'propietarios', 'id_tercero_propietario',
            'edad_inicio', 'edad_fin', 'id_usuario_registra',
            'peso_inicio', 'peso_fin', 'id_dominio_origen','id_dominio_sexo'
        ]));
    }


    public function GestionParto($id_animal)
    {
        $animal = Animal::find($id_animal);
        if($animal->prenado == 0) { echo "<h1>Animal no esta en proceso de parto</h1>"; die; }
        return view("animal.formulario_parto", compact(['animal']));
    }

    public function GuardarParto(Request $request)
    {
        $message = "";
        $error = true;
        $post = $request->all();
        if($post){
            $post = (object) $post;
            $animal = Animal::find($post->id_animal);
            if($animal){
                if (count($post->crias) > 0) {
                    foreach ($post->crias as $cria) {
                        $cria = (object) $cria;
                        $new_cria = $animal->replicate();
                        $new_cria->referencia = $cria->referencia;
                        $new_cria->id_dominio_sexo = $cria->id_dominio_sexo;
                        $new_cria->peso = $cria->peso;
                        $new_cria->color = $cria->color;
                        $new_cria->id_madre = $animal->id_animal;
                        $new_cria->id_padre = null;
                        $new_cria->id_dominio_estado = 45; //TETADO
                        $new_cria->fecha_nacimiento = date("Y-m-d");
                        $new_cria->prenado = 0;
                        $new_cria->fecha_deteccion_prenado = null;
                        $new_cria->id_dominio_origen = 14; //NACIDO EN FINCA
                        $new_cria->id_usuario_registra = session('id_usuario');
                        $new_cria->imagen = "";
                        $new_cria->estado = 1;
                        $new_cria->created_at = date("Y-m-d H:i:s");
                        $new_cria->updated_at = date("Y-m-d H:i:s");
                        $new_cria->save();
                    }

                    $animal->prenado = 0;
                    $animal->fecha_deteccion_prenado = null;
                    $animal->id_dominio_estado = 47; //AMAMANTANDO
                    $animal->save();

                    $error = false; $message = "Proceso de parto registrado exitosamente";
                }else{
                    $message = "Para finalizar el proceso de parto es necesario que registre a las crias del animal";
                }
            }else{
                $message = "Animal invalido";
            }
        }else{
            $message = "Información invalida";
        }

        return response()->json([
            'error' => $error,
            'message' => $message
        ]);
    }

    public function Anular(Request $request)
    {
        $message = "";
        $error = true;
        $post = $request->all();
        if($post){
            $post = (object) $post;
            $animal = Animal::find($post->id_animal);
            if($animal){
                if ($post->motivo != "" and $post->motivo != null) {
                    $animal->motivo_anulacion = $post->motivo;
                    $animal->estado = 0;
                    $animal->id_usuario_anula = session('id_usuario');
                    $animal->fecha_anula = date('Y-m-d H:i:s'); 
                    if ($animal->save()) {
                        $error = false; $message = "Animal dado de baja exitosamente";
                    }else{
                        $message = "Ocurrio un error al dar de baja al animal: ".$animal->errors[0];
                    }
                }else{
                    $message = "Las observaciones de la anulación son obligatorias";
                }
            }else{
                $message = "ID invalido";
            }
        }else{
            $message = "Información invalida";
        }

        return response()->json([
            'error' => $error,
            'message' => $message
        ]);
    }
}
