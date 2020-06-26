<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClimaCondicion extends Model
{
    protected $table = 'climas_condiciones';

    protected $fillable = [
        'id',
        'code',
        'description',
        'descripcion',
        'class_icon',
    ];
}
