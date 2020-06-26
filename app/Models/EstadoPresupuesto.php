<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoPresupuesto extends Model
{
    //use SoftDeletes;
    protected $table    = 'estado_presupuesto';
    protected $fillable = [
        'id',
        'nombre',
        'class',
    ];

    public function presupuestos()
    {
        return $this->hasMany('App\Models\Presupuesto', 'estado_presupuesto_id', 'id');
    }    
}
