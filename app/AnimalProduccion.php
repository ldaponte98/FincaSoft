<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimalProduccion extends Model
{
    protected $table = 'animal_produccion';
    protected $primaryKey = 'id_animal_produccion';

    protected $fillable = [
        'id_animal', 'id_dominio_unidad_medida', 'valor_produccion', 
        'fecha_inicio', 'fecha_fin', 'observaciones', 'id_dominio_concepto',
        'estado'
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'id_animal');
    }
        
    public function usuario()
    {
    	return $this->belongsTo(Usuario::class, 'id_usuario_registra', 'id_usuario');
    }

    public function concepto()
    {
        return $this->belongsTo(Dominio::class, 'id_dominio_concepto', 'id_dominio');
    }

    public function unidad_medida()
    {
        return $this->belongsTo(Dominio::class, 'id_dominio_unidad_medida', 'id_dominio');
    }
}
