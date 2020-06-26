<?php

namespace App\Models;

use App\Models\Traits\Attribute\TipoProductoAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class TipoProducto extends Model
{
    //use SoftDeletes;
    use TipoProductoAttribute;
    protected $table    = 'tipo_productos';
    protected $fillable = [
        'id',
        'nombre',
    ];
}
