<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleGuiaDespacho extends Model
{
    protected $table    = 'detalle_guia_despacho';
    protected $fillable = [
        'factura_id',
        'producto_id',
        'cantidad',
        'precio_venta',
        'total',
        'desc_libre',

    ];

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto','producto_id','id');
    }

}
