<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'caja';
    protected $primaryKey = 'id_caja';

    protected $fillable = [
        'id_dominio_movimiento', 'id_usuario_registra', 'valor',
        'concepto', 'observaciones', 'estado'
    ];

    public function movimiento()
    {
        return $this->belongsTo(Dominio::class, 'id_dominio_movimiento', 'id_dominio');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_registra', 'id_usuario');
    }

    public function usuario_anula()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_anula', 'id_usuario');
    }
}
