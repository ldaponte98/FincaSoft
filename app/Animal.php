<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $table = 'animal';
    protected $primaryKey = 'id_animal';

    protected $fillable = [
        'referencia', 'id_dominio_tipo', 'id_dominio_raza',
        'fecha_nacimiento', 'id_dominio_estado', 'peso',
        'estado_corporal', 'id_dominio_origen', 'id_tercero_propietario',
        'id_usuario_registra', 'estado'
    ];

    public function tipo()
    {
        return $this->belongsTo(Dominio::class, 'id_dominio_tipo', 'id_dominio');
    }

    public function raza()
    {
    	return $this->belongsTo(Dominio::class, 'id_dominio_raza', 'id_dominio');
    }

    public function _estado()
    {
    	return $this->belongsTo(Dominio::class, 'id_dominio_estado', 'id_dominio');
    }

    public function origen()
    {
    	return $this->belongsTo(Dominio::class, 'id_dominio_origen', 'id_dominio');
    }

    public function propietario()
    {
    	return $this->belongsTo(Tercero::class, 'id_tercero_propietario', 'id_tercero');
    }

    public function url_imagen()
    {
        return $this->imagen == "" ? "https://app.clez.co/images/sinimagen.jpg" : config("global.url_imagenes")."animales/".$this->imagen;
    }
}
