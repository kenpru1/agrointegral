<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class TipoTrabajador extends Model
{
  //  use SoftDeletes;
    protected $table    = 'tipo_trabajadores';
    protected $fillable = [
        'id',
        'nombre',
    ];
}
