<?php

namespace App\Models;

use App\Models\Traits\Attribute\FacturaRecibidaAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class FacturaRecibida extends Model
{
  //  use SoftDeletes;
    use FacturaRecibidaAttribute;

    protected $table = 'facturas_recibidas';

    protected $dates = ['fecha_emision', 'fecha_vence'];

    protected $fillable = [
        'id',
        'empresa_id',
        'ref',
        'ref_vendedor',
        'cliente_proveedor_id',
        'comuna_id',
        'codigo_postal',
        'tipo_pago_id',
        'monto_neto',
        'porcentaje_iva',
        'iva',
        'total',
        'excenta',
        'estado_factura_id',
        'factura_recibida_id',
    ];


   public function comuna()
    {
        return $this->belongsTo('App\Models\Comuna', 'comuna_id', 'id');
    }

    public function cliente_proveedor()
    {
        return $this->belongsTo('App\Models\ClienteProveedor', 'cliente_proveedor_id', 'id');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }

    public function tipo_pago()
    {
        return $this->belongsTo('App\Models\TipoPago', 'tipo_pago_id', 'id');
    }

    public function estado_factura()
    {
        return $this->belongsTo('App\Models\EstadoFactura', 'estado_factura_id', 'id');
    }

}
