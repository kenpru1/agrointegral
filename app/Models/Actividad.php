<?php

namespace App\Models;

use App\Models\Traits\Attribute\ActividadAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
class Actividad extends Model
{
    use ActividadAttribute;
  //  use SoftDeletes;
  //use SoftCascadeTrait;
    protected $table    = 'actividades';
    protected $dates    = ['fecha','deleted_at'];
    //protected $softCascade = ['gastos','clientes'];
    protected $fillable = [
        'id',
        'fecha',
        'comentarios',
        'horas',
        'minutos',
        'empresa_id',
    ];

    public function gastos()
    {

        return $this->hasMany('App\Models\ActividadGasto', 'actividad_id', 'id');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }

    public function clientes()
    {

        return $this->belongsToMany('App\Models\ClienteProveedor', 'actividad_cliente', 'actividad_id', 'cliente_id');
    }

    public function trabajadores()
    {

        return $this->belongsToMany('App\Models\Trabajador', 'actividad_trabajador', 'actividad_id', 'trabajador_id');
    }

    public function tipoActividades()
    {

        return $this->belongsToMany('App\Models\TipoActividad', 'actividad_tipo_actividad', 'actividad_id', 'tipo_actividad_id');
    }

    public function maquinarias()
    {

        return $this->belongsToMany('App\Models\Maquinaria', 'actividad_maquinaria', 'actividad_id', 'maquinaria_id');
    }

    public function campos()
    {

        return $this->belongsToMany('App\Models\Campo', 'actividad_campo', 'actividad_id', 'campo_id');
    }

    public function cuarteles()
    {

        return $this->belongsToMany('App\Models\Cuartel', 'actividad_cuartel', 'actividad_id', 'cuartel_id');
    }
}
