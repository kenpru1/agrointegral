<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class LaborCuartel extends Model
{
  //  use SoftDeletes;
    protected $table = 'labores_cuarteles';

    protected $fillable = [
        'id',
        'labor_id',
        'cuartel_id',
        'hectareas',
    ];

    public function cuartel()
    {
        return $this->belongsTo('App\Models\Cuartel', 'cuartel_id', 'id');
    }
}
