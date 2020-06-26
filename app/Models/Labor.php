<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Labor extends Model
{
  //  use SoftDeletes;
    protected $table = 'labores';

    protected $fillable = [
        'id',
        'actividad_gasto_id',
        'labor',
        'neto',
        'iva',
        'total',
    ];

    public function labores_cuarteles()
    {
        return $this->hasMany('App\Models\LaborCuartel', 'labor_id', 'id');
    }

}
