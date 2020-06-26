<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class TipoEnvio extends Model
{
  //  use SoftDeletes;

    protected $table    = 'tipo_envios';
    protected $fillable = [
        'id',
        'descripcion',

    ];

}
