<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tercero;

class TerceroController extends Controller
{
    public function Vista($id_tercero)
    {
        $tercero = Tercero::find($id_tercero);
        return view("tercero.vista", compact(['tercero']));
    }

    public function ValidarIdentificacion($identificacion)
    {
    	return response()->json(Tercero::where('identificacion', $identificacion)->first());
    }
}
