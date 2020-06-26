<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoOportunidad extends Model
{
  //  use SoftDeletes;
    protected $table = 'estado_oportunidad';

    protected $fillable = [
        'id',
        'nombre',
        'class',
        'class_tablero',
    ];
}
