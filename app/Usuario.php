<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'id_perfil', 'usuario', 'clave', 'id_tercero'
    ];

    public function tercero()
    {
    	return $this->belongsTo(Tercero::class, 'id_tercero');
    }

     public function perfil()
    {
    	return $this->belongsTo(Perfil::class, 'id_perfil');
    }
}
