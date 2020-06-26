<?php

namespace App\Models;

use App\Models\Traits\Attribute\FacturaAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Factura extends Model
{
    //use SoftDeletes;
    use FacturaAttribute;
    protected $table    = 'facturas';
    protected $dates    = ['fecha', 'fecha_entrega', 'fecha_vencimiento','deleted_at'];
  
    protected $fillable = [
        'id',
        'fecha',
        'cliente_id',
        'validez',
        'condicion_pago_id',
        'tipo_pago_id',
        'fuente_id',
        'fecha_entrega',
        'fecha_vencimiento',
        'nota_publica',
        'nota_privada',
        'sub_total',
        'porcentaje_descuento',
        'porcentaje_iva',
        'iva',
        'descuento',
        'estado_factura_id',
        'empresa_id',
    ];

    public function getNro()
    {
        $empresaUser = Auth::user()->empresaUser();
        $nro         = Correlativo::where('empresa_id', $empresaUser->id)->first();

        if ($nro->id == null) {
            $num             = new Correlativo();
            $num->factura    = 1;
            $num->empresa_id = $empresaUser->id;
            $num->save();
            return "FA-1";

        } else {
            $nro->factura = $nro->factura + 1;
            $nro->save();
            return "FA-" . ($nro->factura);
        }
    }

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Models\ClienteProveedor', 'cliente_id', 'id');
    }

    public function condicion_pago()
    {
        return $this->belongsTo('App\Models\CondicionPago', 'condicion_pago_id', 'id');
    }

    public function tipo_pago()
    {
        return $this->belongsTo('App\Models\TipoPago', 'tipo_pago_id', 'id');
    }

    public function fuente()
    {
        return $this->belongsTo('App\Models\Fuente', 'fuente_id', 'id');
    }

    public function estado_factura()
    {
        return $this->belongsTo('App\Models\EstadoFactura', 'estado_factura_id', 'id');
    }

    public function detalle_factura()
    {
        return $this->hasMany('App\Models\DetalleFactura', 'factura_id', 'id');
    }

    public function pago_factura()
    {
        return $this->hasMany('App\Models\PagoFactura', 'factura_id', 'id');
    }

}
