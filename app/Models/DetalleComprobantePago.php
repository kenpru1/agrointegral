<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleComprobantePago extends Model
{
    protected $table = 'detalle_comprobantes';

    protected $fillable = [
        'id',
        'comprobante_pago_id',
        'trabajo_realizado',
        'total',
    ];

    public function comprobante_pago()
    {
    	return $this->belongsTo('App\Models\ComprobantePago', 'comprobante_pago_id', 'id');
    }
}
