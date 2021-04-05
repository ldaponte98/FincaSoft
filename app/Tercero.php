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

    public function tipo_identificacion()
    {
        return $this->belongsTo(Dominio::class, 'id_dominio_tipo_identificacion', 'id_dominio');
    }

    public function animales()
    {
        return $this->hasMany(Animal::class, 'id_tercero_propietario', 'id_tercero');
    }

    public function url_imagen()
    {
        return $this->imagen == "" ? "https://app.clez.co/images/sinimagen.jpg" : config("global.url_imagenes")."terceros/".$this->imagen;
    }

    public function nombre_completo()
    {
    	return $this->nombres." ".$this->apellidos;
    }
}
