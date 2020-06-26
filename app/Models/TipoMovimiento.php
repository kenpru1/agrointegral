<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class TipoMovimiento extends Model
{
  //  use SoftDeletes;
    protected $table    = 'tipo_movimientos';
    protected $fillable = [
        'id',
        'descripcion',
    ];
}
