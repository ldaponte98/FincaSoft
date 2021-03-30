<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tercero extends Model
{
    protected $table = 'tercero';
    protected $primaryKey = 'id_tercero';

    protected $fillable = [
        'id_dominio_tipo_identificacion', 'identificacion', 'nombres',
        'apellidos', 'email', 'telefono', 'estado'
    ];

    public function url_imagen()
    {
        return $this->imagen == "" ? "https://app.clez.co/images/sinimagen.jpg" : config("global.url_imagenes")."terceros/".$this->imagen;
    }

    public function nombre_completo()
    {
    	return $this->nombres." ".$this->apellidos;
    }
}
