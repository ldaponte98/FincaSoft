<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Animal;
use App\Tratamiento;

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

    public function Panel()
    {
        $top_produccion = DB::select("SELECT 
                                      a.id_animal, 
                                      a.imagen, 
                                      CONCAT(a.referencia,' - ', ta.nombre) as nombre, 
                                      ump.nombre as unidad_medida, 
                                      SUM(valor_produccion) as total 
                                      FROM animal_produccion ap 
                                      LEFT JOIN animal a USING(id_animal) 
                                      LEFT JOIN dominio ta ON ta.id_dominio = a.id_dominio_tipo 
                                      LEFT JOIN dominio ump ON ump.id_dominio = ap.id_dominio_unidad_medida 
                                      GROUP BY 1, 2, 3, 4 LIMIT 10");

        $prenados = Animal::where('estado', 1)
                          ->where('prenado', 1)
                          ->where('id_dominio_sexo', 25)
                          ->orderByDesc('fecha_deteccion_prenado')
                          ->limit(10)
                          ->get();

        $tratamientos = Tratamiento::where('estado', 1)
                          ->where('id_dominio_estado', 22)
                          ->orderBy('fecha', 'asc')
                          ->limit(10)
                          ->get();
        return view('sitio.panel', compact(['top_produccion', 'prenados', 'tratamientos']));
    }
}
