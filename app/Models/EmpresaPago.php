<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaPago extends Model
{
    protected $table    = 'empresa_pagos';
    protected $dates=['fecha_solicitud','fecha_pago','inicio_periodo','fin_periodo'];
    protected $fillable = [
        'id',
        'descripcion',
        'monto',
        'estado',
        'order_number',
        'fee',
        'taxes',
        'balance',
        'fecha_pago',
        'fecha_solicitud',
        'email_pagador',
        'empresa_id',
        'porc_iba',
        'monto_iva',
        'total',
        'inicio_periodo',
        'fin_periodo',
    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }
}
