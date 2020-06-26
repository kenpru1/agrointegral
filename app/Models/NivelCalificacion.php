<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class NivelCalificacion extends Model
{
//    use SoftDeletes;
    protected $table    = 'nivel_calificacion';
    protected $fillable = [
        'id',
        'nombre',
    ];
}
