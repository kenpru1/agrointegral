<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoRequerimiento extends Model
{
  //  use SoftDeletes;
    protected $table = 'estado_requerimiento';

    protected $fillable = [
        'id',
        'nombre',
        'class',
        'class_tablero',
    ];
}
