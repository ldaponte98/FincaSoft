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
        'id_usuario_registra', 'estado', 'prenado', 'fecha_deteccion_prenado',
        'id_madre', 'id_padre', 'color', 'id_dominio_sexo'
    ];

    public $tiempo_prenado = 0;

    public function tipo()
    {
        return $this->belongsTo(Dominio::class, 'id_dominio_tipo', 'id_dominio');
    }

    public function sexo()
    {
        return $this->belongsTo(Dominio::class, 'id_dominio_sexo', 'id_dominio');
    }

    public function raza()
    {
    	return $this->belongsTo(Dominio::class, 'id_dominio_raza', 'id_dominio');
    }

    public function _estado()
    {
    	return $this->belongsTo(Dominio::class, 'id_dominio_estado', 'id_dominio');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_registra', 'id_usuario');
    }

    public function origen()
    {
    	return $this->belongsTo(Dominio::class, 'id_dominio_origen', 'id_dominio');
    }

    public function propietario()
    {
    	return $this->belongsTo(Tercero::class, 'id_tercero_propietario', 'id_tercero');
    }

     public function vacunas()
    {
        return $this->hasMany(Vacuna::class, 'id_animal');
    }

    public function padre()
    {
        return $this->belongsTo(Animal::class, 'id_padre', 'id_animal');
    }

    public function madre()
    {
        return $this->belongsTo(Animal::class, 'id_madre', 'id_animal');
    }

     public function hijos()
    {
        return Animal::where('id_padre', $this->id_animal)->orWhere('id_madre', $this->id_animal)->get();
    }

    public function url_imagen()
    {
        return $this->imagen == "" ? "https://app.clez.co/images/sinimagen.jpg" : config("global.url_imagenes")."animales/".$this->imagen;
    }

    public function dias_restantes_parir()
    {
        $dias_gestacion = 283;
        if ($this->fecha_deteccion_prenado != null) {
            $fecha_actual = new \DateTime(date('Y-m-d'));
            $fecha_deteccion_prenado = new \DateTime($this->fecha_deteccion_prenado);
            $diferencia = $fecha_actual->diff($fecha_deteccion_prenado);
            $dias = $diferencia->days;
            return $dias_gestacion >= $dias ? $dias_gestacion - $dias : 0;
        }else{
            return $dias_gestacion;
        }
    }

    public function dias_prenado()
    {
        if ($this->fecha_deteccion_prenado) {
           $fecha_actual = new \DateTime(date('Y-m-d'));
            $fecha_deteccion_prenado = new \DateTime($this->fecha_deteccion_prenado);
            $diferencia = $fecha_actual->diff($fecha_deteccion_prenado);
            return $diferencia->days;
        }else{
            return 0;
        }
    }

    public function edad()
    {
        if ($this->fecha_nacimiento) {
            $fecha_actual = new \DateTime(date('Y-m-d'));
            $fecha_nacimiento = new \DateTime($this->fecha_nacimiento);
            $diferencia = $fecha_actual->diff($fecha_nacimiento);
            return $diferencia->y;
        }else{
            return "No definida";
        }
    }
}
