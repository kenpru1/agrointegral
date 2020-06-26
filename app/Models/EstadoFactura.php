<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoFactura extends Model
{
  //  use SoftDeletes;
    protected $table    = 'estado_factura';
    protected $fillable = [
        'id',
        'nombre',
        'class',
    ];
}
