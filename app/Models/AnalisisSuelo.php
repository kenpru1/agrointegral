<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\AnalisisSueloAttribute;
//use Illuminate\Database\Eloquent\SoftDeletes;


class AnalisisSuelo extends Model
{
  //  use SoftDeletes;
    use AnalisisSueloAttribute;
    protected $table    = 'analisis_suelo';
    protected $dates = ['fecha'];
    protected $fillable = [
        'id',
        'fecha',
        'unidad_id',
        'cuartel_id',
        'prof_desde',
        'prof_hasta',
        'sector',
        'ph',
        'n',
        'p',
        'k',
        's',
        'mg',
        'na',
        'ca',
        'c',
        'nitro_organico',
        'no3',
        'rel_cn',
        'mat_organica',
        'arcilla',
        'arena',
        'limo',
        'cond_electrica',
        'humedad',
        'observaciones',
        'empresa_id',

    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }

    public function cuartel()
    {
        return $this->belongsTo('App\Models\Cuartel', 'cuartel_id', 'id');
    }

}
