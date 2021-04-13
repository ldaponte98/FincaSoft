<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimalPesaje extends Model
{
    protected $table = 'animal_pesaje';
    protected $primaryKey = 'id_animal_pesaje';

    protected $fillable = [
        'id_animal', 'peso_anterior', 'peso_medido', 
        'fecha', 'estado'
    ];

    public function animal()
    {
    	return $this->belongsTo(Animal::class, 'id_animal');
    }

    public function usuario()
    {
    	return $this->belongsTo(Usuario::class, 'id_usuario_registra', 'id_usuario');
    }
}
