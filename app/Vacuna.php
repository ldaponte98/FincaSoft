<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacuna extends Model
{
    protected $table = 'vacuna';
    protected $primaryKey = 'id_vacuna';

    protected $fillable = [
        'id_animal', 'nombre', 'descripcion', 'fecha','id_dominio_estado','id_usuario_registra', 'estado'
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'id_animal');
    }

    public function _estado()
    {
    	return $this->belongsTo(Dominio::class, 'id_dominio_estado', 'id_dominio');
    }

     public function usuario()
    {
    	return $this->belongsTo(Usuario::class, 'id_usuario_registra', 'id_usuario');
    }
}
