<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Caja;
class CajaController extends Controller
{
    public function Listado(Request $request)
    {
    	$post = $request->all();
    	
    	$fecha_inicio = date("Y-m-d");
		$fecha_fin = date("Y-m-d");
		$id_usuario_registra = 0;
		$cajas = Caja::whereBetween('created_at', [
			$fecha_inicio." 00:00:00", $fecha_fin." 23:59:59"]);
		
    	if($post){
    		$post = (object) $post;
    		$cajas = Caja::whereBetween('created_at', [
    			$post->fecha_inicio." 00:00:00", $post->fecha_fin." 23:59:59"]);
    		if($post->id_usuario_registra != 0){
    			$id_usuario_registra = $post->id_usuario_registra;
    		  	$cajas = $cajas->where('id_usuario_registra', $id_usuario_registra);	
    		}
    	}
    	$cajas = $cajas->orderBy('created_at', 'desc')->get();
    	$total_caja = 0;
		$total_ingresos = 0;
		$total_egresos = 0;
    	foreach ($cajas as $caja) {
    		if($caja->id_dominio_movimiento == 43 and $caja->estado == 1){ //INGRESOS
    			$total_caja += $caja->valor;
    			$total_ingresos += $caja->valor;
    		}
    		if ($caja->id_dominio_movimiento == 44 and $caja->estado == 1) { //EGRESOS
    			$total_caja -= $caja->valor;
    			$total_egresos += $caja->valor;
    		}
    		 
    	}
    	return view('caja.listado', compact([
    		'cajas', 'fecha_inicio', 'fecha_fin', 
    		'id_usuario_registra', 'total_caja', 'total_ingresos', 
    		'total_egresos'
    	]));
    }

    public function Guardar(Request $request)
    {
    	$post = $request->all();
        
    	$caja = new Caja;
        if($post) {
            $post = (object) $post;
            if(isset($post->caja)){
                $caja = Caja::find($post->caja);
                if($caja == null){ echo "Acceso denegado"; die; }
            }
        }
    	if($request->except(['caja'])){
            $caja->fill($request->except(['_token']));
            $caja->id_usuario_registra = session('id_usuario');
            $caja->updated_at = date('Y-m-d H:i:s');
            if($caja->save()){
                session()->flash('message', 'Contabilidad guardada exitosamente');
            	return redirect()->route('caja/listado');
            }
    	}

    	return view("caja.formulario", compact([
    		'caja'
    	]));
    }

    public function Anular(Request $request)
    {
    	$message = "";
    	$error = true;
    	$post = $request->all();
    	if($post){
    		$post = (object) $post;
    		$caja = Caja::find($post->id_caja);
    		if($caja){
    			if ($post->observaciones != "" and $post->observaciones != null) {
    				$caja->observaciones_anula = $post->observaciones;
    				$caja->estado = 0;
    				$caja->id_usuario_anula = session('id_usuario');
    				$caja->fecha_anula = date('Y-m-d H:i:s'); 
    				if ($caja->save()) {
    					$error = false; $message = "Documento anulado exitosamente";
    				}else{
    					$message = "Ocurrio un error al anular el documento: ".$caja->errors[0];
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
