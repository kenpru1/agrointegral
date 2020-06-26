<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class PagoFactura extends Model
{
  //  use SoftDeletes;
    protected $table = 'pagos_facturas';

    protected $fillable = [
        'id',
        'factura_id',
        'tipo_pago_id',
        'fecha',
        'numero',
        'transmisor',
        'comentarios',
        'pago',
        'abono',
        'deuda',
    ];

    public function factura()
    {
        return $this->belongsTo('App\Models\Factura', 'factura_id', 'id');
    }

    public function tipo_pago()
    {
        return $this->belongsTo('App\Models\TipoPago', 'tipo_pago_id', 'id');
    }
}
