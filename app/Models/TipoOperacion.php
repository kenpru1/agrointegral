<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class TipoOperacion extends Model
{
  //  use SoftDeletes;
    protected $table    = 'tipo_operaciones';
    protected $fillable = [
        'id',
        'descripcion',
    ];
}
