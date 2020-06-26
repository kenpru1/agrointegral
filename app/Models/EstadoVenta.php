<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoVenta extends Model
{
  //  use SoftDeletes;
    protected $table    = 'estado_venta';
    protected $fillable = [
        'id',
        'nombre',
    ];
}
