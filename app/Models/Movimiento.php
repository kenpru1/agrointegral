<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Movimiento extends Model
{
  //  use SoftDeletes;

    protected $table    = 'movimientos';
    protected $dates    = ['fecha','deleted_at'];
    protected $fillable = [
        'id',
        'fecha',
        'factura_id',
        'factura_recibida_id',
        'tipo_operacion_id',
        'tipo_movimiento_id',
        'tipo_entrada',
        'stock_id',
        'cantidad',
        'cliente_proveedor_id',
        'producto_id',
        'guia_despacho_id',
        'actividad_id',
        'user_id',
        'comentarios',

    ];

    public function guia_despacho()
    {
        return $this->belongsTo('App\Models\GuiaDespacho', 'guia_despacho_id', 'id');
    }

    public function factura()
    {
        return $this->belongsTo('App\Models\Factura', 'factura_id', 'id');
    }

    public function factura_recibida()
    {
        return $this->belongsTo('App\Models\FacturaRecibida', 'factura_recibida_id', 'id');
    }

    public function tipo_operacion()
    {
        return $this->belongsTo('App\Models\TipoOperacion', 'tipo_operacion_id', 'id');
    }

    public function actividad()
    {
        return $this->belongsTo('App\Models\Actividad', 'actividad_id', 'id');
    }

    public function tipo_movimiento()
    {
        return $this->belongsTo('App\Models\TipoMovimiento', 'tipo_movimiento_id', 'id');
    }

    public function stock()
    {
        return $this->belongsTo('App\Models\Stock', 'stock_id', 'id');
    }

    public function cliente_proveedor()
    {
        return $this->belongsTo('App\Models\ClienteProveedor', 'cliente_proveedor_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User', 'user_id', 'id');
    }

}
