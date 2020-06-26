<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class CondicionPago extends Model
{
  //  use SoftDeletes;

    protected $table    = 'condiciones_pago';
    protected $fillable = [
        'id',
        'nombre',
    ];

}
