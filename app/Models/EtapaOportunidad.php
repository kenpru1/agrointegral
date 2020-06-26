<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class EtapaOportunidad extends Model
{
  //  use SoftDeletes;
    protected $table = 'etapa_oportunidad';

    protected $fillable = [
        'id',
        'nombre',
        'class',
    ];
}
