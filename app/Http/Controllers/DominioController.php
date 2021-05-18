<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dominio;
use App\Usuario;
use App\Perfil;
use App\Tercero;

class DominioController extends Controller
{
    public function Listado()
    {
        $dominios = Dominio::orderBy('id_padre', 'asc')->get();
        return view("dominio.listado", compact(['dominios']));
    }

    public function Guardar(Request $request)
    {
        $post = $request->all();
        $dominio = new Dominio;
        $message = null;
        if($post) {
            $post = (object) $post;
            if(isset($post->dominio)){
                $dominio = Dominio::find($post->dominio);
                if($dominio == null){ echo "Acceso denegado"; die; }
            }
        }
        if($request->except(['dominio'])){
            $post = (object) $post;
            $dominio->fill($request->except(['_token']));
            if($dominio->save()){
            	session()->flash('message', 'Dominio guardado exitosamente');
                return redirect()->route('dominio/listado');
            }else{
				$message = "Ocurrio un error al guardar el dominio: ".$dominio->errors[0];
            }
        }

        return view("dominio.formulario", compact([
            'dominio', 'message'
        ]));
    }
}
