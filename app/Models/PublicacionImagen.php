<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class PublicacionImagen extends Model
{
    //use SoftDeletes;

    protected $table    = 'publicacion_imagen';
    protected $fillable = [
        'id',
        'publicacion_id',
        'file_name',
        'original_name',
        'identificador',
        'user_id',
    ];


}
