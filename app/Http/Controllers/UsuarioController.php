<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

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

                return redirect()->route("panel");
    		}	
    	}	
    	return back()->withErrors(['mensaje'=>$mensaje]);
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
