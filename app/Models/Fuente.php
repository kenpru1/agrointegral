<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Fuente extends Model
{
    //use SoftDeletes;

    protected $table    = 'fuentes';
    protected $fillable = [
        'id',
        'nombre',
    ];

}
