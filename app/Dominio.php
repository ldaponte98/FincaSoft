<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dominio extends Model
{
    protected $table = 'dominio';
    protected $primaryKey = 'id_dominio';

    protected $fillable = [
        'nombre', 'descripcion', 'id_padre', 'estado'
    ];

    public function padre()
    {
        return $this->belongsTo(Dominio::class, 'id_padre', 'id_dominio');
    }
}
