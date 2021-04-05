<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SitioController extends Controller
{
    public function BuscarTerceroAnimal($caracteres)
    {
    	$sql_animal = "select 
    				   a.id_animal as id, 
    				   concat(a.referencia, ' - ', d.nombre) as nombre, 
    				   'animal' as tipo
    				   from animal a 
    				   left join dominio d on a.id_dominio_tipo = d.id_dominio
    				   where UPPER(a.referencia) like '%".$caracteres."%'
    				   order by id_animal desc
    				   limit 10";

    	$sql_tercero = "select 
    				   t.id_tercero as id, 
    				   concat(t.nombres,' ',t.apellidos,' - ',t.identificacion) as nombre, 
    				   'tercero' as tipo 
    				   from tercero t 
    				   where UPPER(t.identificacion) like '%".$caracteres."%'
    				   or    UPPER(t.nombres) like '%".$caracteres."%'
    				   or    UPPER(t.apellidos) like '%".$caracteres."%'
    				   or    UPPER(t.email) like '%".$caracteres."%'
    				   or    t.id_tercero = '".$caracteres."'
    				   order by id_tercero desc
    				   limit 10";

    	$response = array_merge(DB::select($sql_animal), DB::select($sql_tercero));
    	return response()->json($response);
    }
}
