<?php

namespace App\Models;

use App\Models\Traits\Attribute\RacionAttribute;
use Illuminate\Database\Eloquent\Model;

class Racion extends Model
{
    use RacionAttribute;
    protected $table    = 'raciones';
    protected $dates    = ['fecha'];
    protected $fillable = [
        'id',
        'nombre',
        'empresa_id',
    ];

    public function animal()
    {
        return $this->belongsTo('App\Models\Animal', 'animal_id', 'id');
    }

    public function tipo_racion()
    {
        return $this->belongsTo('App\Models\TipoRacion', 'tipo_racion_id', 'id');
    }

    public function trabajador()
    {
        return $this->belongsTo('App\Models\Trabajador', 'trabajador_id', 'id');
    }


}
