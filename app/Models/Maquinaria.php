<?php

namespace App\Models;

use App\Models\Traits\Attribute\MaquinariaAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Maquinaria extends Model
{
    use MaquinariaAttribute;
  //  use SoftDeletes;
   // use SoftCascadeTrait;
    protected $table    = 'maquinarias';
    protected $dates    = ['fecha_compra', 'fecha_inspeccion', 'fecha_seguro', 'venc_rev_tecnica','deleted_at'];
    //protected $softCascade = ['mantenciones'];
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'maquinaria_tipo_id',
        'marca',
        'patente',
        'modelo',
        'propietario',
        'fecha_compra',
        'valor_compra',
        'fecha_inspeccion',
        'fecha_seguro',
        'venc_rev_tecnica',
        'numero_roma',
        'empresa_id',
    ];

    public function tipo_maquinaria()
    {
        return $this->belongsTo('App\Models\TipoMaquinaria', 'maquinaria_tipo_id', 'id');
    }

    public function mantenciones()
    {
        return $this->hasMany('App\Models\Mantencion', 'maquinaria_id', 'id');
    }

    

    public function actividades()
    {

        return $this->belongsToMany('App\Models\Actividad', 'actividad_maquinaria', 'maquinaria_id', 'actividad_id');
    }

}
