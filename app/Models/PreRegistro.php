<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreRegistro extends Model
{
    protected $table    = 'pre_registro';

     protected $fillable = [
        'id',
        'nombre',
        'celular',
        'email',
        'comuna_id',
        'provincia_id',
        'rubro',
    ];
}
