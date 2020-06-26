<?php

namespace App\Models;

use App\Models\Traits\Attribute\RendimientoCuartelAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class RendimientoCuartel extends Model
{
    //use SoftDeletes;
    use RendimientoCuartelAttribute;

    protected $table = 'rendimiento_cuarteles';

    //protected $dates = ['fecha_año'];

    protected $fillable = [
        'id',
        'cuartel_id',
        'empresa_id',
        'toneladas_brutas',
        'produccion',
        'descarte_bruto',
        'total_produccion',
        'exportacion',
        'descarte_produccion',
    ];

    public function cuartel()
    {
        return $this->belongsTo('App\Models\Cuartel', 'cuartel_id', 'id');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }
}
