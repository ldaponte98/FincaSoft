<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $table = 'animal';
    protected $primaryKey = 'id_animal';

    public function raza()
    {
    	return $this->belongsTo(Dominio::class, 'id_dominio_raza', 'id_dominio');
    }

    public function estado()
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
}
