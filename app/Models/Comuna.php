<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    protected $table = 'comunas';
    protected $fillable = [
        'id',
        'nombre',
        'provincia_id'
    ];
}
