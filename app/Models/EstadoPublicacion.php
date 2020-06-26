<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoPublicacion extends Model
{
  //  use SoftDeletes;
    protected $table    = 'estado_publicacion';
    protected $fillable = [
        'id',
        'descripcion',

    ];
}
