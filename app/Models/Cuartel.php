<?php

namespace App\Models;

use App\Models\Traits\Attribute\CuartelAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Cuartel extends Model
{
    use CuartelAttribute;
  //  use SoftDeletes;
  //  use SoftCascadeTrait;
    protected $table       = 'cuarteles';
    protected $dates       = ['deleted_at'];
    //protected $softCascade = ['analisis_suelos', 'rendimiento_cuarteles'];
    protected $fillable    = [
        'id',
        'nombre',
        'propio',
        'productivo',
        'provincia_id',
        'comuna_id',
        'descripcion',
        'campo_id',
        'tipo_cultivo_id',
        'coordenadas',
        'ubiq_lat',
        'ubiq_lng',
        'tamanno',
    ];

    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia');
    }

    public function comuna()
    {
        return $this->belongsTo('App\Models\Comuna');
    }

    public function campo()
    {
        return $this->belongsTo('App\Models\Campo');
    }

    public function tipoCultivo()
    {
        return $this->belongsTo('App\Models\TipoCultivo');
    }

    public function actividades()
    {

        return $this->belongsToMany('App\Models\Actividad', 'actividad_cuartel', 'cuartel_id', 'actividad_id');
    }

    public function analisis_suelos()
    {
        return $this->hasMany('App\Models\AnalisisSuelo', 'cuartel_id', 'id');
    }

    public function rendimiento_cuarteles()
    {
        return $this->hasMany('App\Models\RendimientoCuartel', 'cuartel_id', 'id');
    }

}
