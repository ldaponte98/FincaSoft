<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $table = 'tratamiento';
    protected $primaryKey = 'id_tratamiento';

    protected $fillable = [
        'id_animal', 'nombre', 'descripcion', 
        'fecha','id_dominio_estado','id_usuario_registra', 
        'estado', 'id_dominio_tipo'
    ];

    public function tipo()
    {
        return $this->belongsTo(Dominio::class, 'id_dominio_tipo', 'id_dominio');
    }

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

     public function dosis()
    {
        return $this->hasMany(Tratamiento::class, 'id_tratamiento_padre', 'id_tratamiento');
    }
}
