<?php

namespace App\Models;

use App\Models\Traits\Attribute\TipoActividadAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class TipoActividad extends Model
{
    use TipoActividadAttribute;
  //  use SoftDeletes;
  //  use SoftCascadeTrait;
    protected $table    = 'tipo_actividades';
    protected $dates       = ['deleted_at'];
    //protected $softCascade = ['actividades'];
    protected $fillable = [
        'id',
        'nombre',
        'empresa_id',
    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }

    public function actividades()
    {

        return $this->belongsToMany('App\Models\Actividad', 'actividad_tipo_actividad', 'tipo_actividad_id', 'actividad_id');
    }

}
