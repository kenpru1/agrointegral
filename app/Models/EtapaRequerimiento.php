<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class EtapaRequerimiento extends Model
{
  //  use SoftDeletes;
    protected $table = 'etapa_requerimiento';

    protected $fillable = [
        'id',
        'nombre',
        'class',
    ];
}
