<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
  //  use SoftDeletes;
    protected $table = 'stocks';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'bodega_id',
        'producto_id',
        'cantidad',

    ];

    public function bodega()
    {
        return $this->belongsTo('App\Models\Bodega', 'bodega_id', 'id');
    }

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto', 'producto_id', 'id');
    }

    public function movimientos()
    {
        return $this->hasMany('App\Models\Movimiento', 'stock_id', 'id');
    }
}
