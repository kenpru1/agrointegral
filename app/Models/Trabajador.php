<?php

namespace App\Models;

use App\Models\Traits\Attribute\TrabajadorAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
class Trabajador extends Model
{
    use TrabajadorAttribute;
    //use SoftDeletes;
    //use SoftCascadeTrait;
    protected $table    = 'trabajadores';
  //  protected $softCascade = ['comprobante_pagos'];
    protected $fillable = [
        'id',
        'nombre',
        'rut',
        'tipo_trabajador_id',
        'nivel_calificacion_id',
        'asesor',
        'email',
        'telefono',
        'direccion',
        'poblacion',
        'codigo_postal',
        'nacionalidad',
        'comentarios',
        'empresa_id',
    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }

    public function tipo_trabajador()
    {
        return $this->belongsTo('App\Models\TipoTrabajador', 'tipo_trabajador_id', 'id');
    }

    public function nivel_calificacion()
    {
        return $this->belongsTo('App\Models\NivelCalificacion', 'nivel_calificacion_id', 'id');
    }

    public function actividades()
    {

        return $this->belongsToMany('App\Models\Actividad', 'actividad_trabajador', 'trabajador_id', 'actividad_id');
    }

    public function comprobante_pagos()
    {
        return $this->hasMany('App\Models\ComprobantePago', 'trabajador_id', 'id');
    }


}
