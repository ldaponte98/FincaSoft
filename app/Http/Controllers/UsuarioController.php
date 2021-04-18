<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Perfil;
use App\Tercero;

class UsuarioController extends Controller
{
    public function ValidarLogin(Request $request)
    {
    	$post = (object) $request->all();
    	if ($post) {
    		$usuario = Usuario::where('usuario','=',$post->usuario)
    					->where('clave','=',md5($post->clave))
    					->first();
    		$mensaje = "Credenciales invalidas";
    		if ($usuario) {
                $session = [
                    'id_usuario' => $usuario->id_usuario,
                    'id_tercero_usuario' =>  $usuario->tercero->id_tercero,
                    'id_perfil' => $usuario->id_perfil,
                ];
    			session($session);

                return redirect()->route("sitio/panel");
    		}	
    	}	
    	return back()->withErrors(['mensaje'=>$mensaje]);
    }

    public function Listado()
    {
        $usuarios = Usuario::all();
        return view("usuario.listado", compact(['usuarios']));
    }

    public function Guardar(Request $request)
    {
        $post = $request->all();
        
        $usuario = new Usuario;
        $tercero = new Tercero;
        $message = null;
        if($post) {
            $post = (object) $post;
            if(isset($post->usuario)){
                $usuario = Usuario::find($post->usuario);
                if($usuario == null){ echo "Acceso denegado"; die; }
                $tercero = $usuario->tercero;
            }
        }
        if($request->except(['usuario'])){
            $post = (object) $post;
            $misma_clave = false;
            if($post->clave == $usuario->clave) $misma_clave = true;
            $tercero->fill($request->except(['_token']));
            $usuario->fill($request->except(['_token']));
            $identificacion_repetida = Tercero::where('identificacion', $post->identificacion)
                                              ->where('id_tercero', '<>', $tercero->id_tercero)
                                              ->first();
            if ($identificacion_repetida == null) {
                $usuario_repetido = Usuario::where('usuario', $post->nombre_usuario)
                                            ->where('id_usuario', '<>', $usuario->id_usuario)
                                            ->first();
                if ($usuario_repetido == null) {
                    $tercero->updated_at = date('Y-m-d H:i:s');
                    if($tercero->save()){
                        $usuario->usuario = $post->nombre_usuario;
                        if(!$misma_clave) $usuario->clave = md5($post->clave);
                        $usuario->id_tercero = $tercero->id_tercero;
                        $usuario->id_perfil = $post->id_perfil;
                        $usuario->updated_at = date('Y-m-d H:i:s');
                        if($usuario->save()){
                            session()->flash('message', 'Usuario guardado exitosamente');
                            return redirect()->route('usuario/listado');
                        }else{
                            $message = "Ocurrio un error al guardar el usuario: ".$usuario->errors[0];
                        }
                    }else{
                        $message = "Ocurrio un error al guardar el usuario: ".$tercero->errors[0];
                    }
                }else{
                    $message = "Ocurrio un error al guardar el usuario: Nombre de usuario ya existente en otro usuario";
                }
            }else{
                $message = "Ocurrio un error al guardar el usuario: Identificacion ya existente en otro usuario";
            }
        }

        return view("usuario.formulario", compact([
            'usuario', 'tercero', 'message'
        ]));
    }

    public function Panel()
    {
    	return view('sitio.panel');
    }

    public function CerrarSesion(Request $request)
    {
    	$request->session()->flush();
        return redirect('/');
    }
}
