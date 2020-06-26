<?php

namespace App\Models;

use App\Models\Traits\Attribute\OrdenCompraAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class OrdenCompra extends Model
{
    use OrdenCompraAttribute;
  //  use SoftDeletes;
    protected $table    = 'orden_compra';
    protected $dates    = ['fecha','deleted_at'];
    protected $fillable = [
        'id',
        'numero',
        'fecha',
        'cliente_id',
        'nota_publica',
        'nota_privada',
        'sub_total',
        'porcentaje_iva',
        'iva',
        'empresa_id',
    ];

    public function getNro()
    {
        $empresaUser = Auth::user()->empresaUser();
        $nro         = Correlativo::where('empresa_id', $empresaUser->id)->first();

        if ($nro->id == null) {
            $num                = new Correlativo();
            $num->orden_compra = 1;
            $num->empresa_id    = $empresaUser->id;
            $num->save();
            return "ORD-1";

        } else {
            $nro->orden_compra = $nro->orden_compra + 1;
            $nro->save();
            return "ORD-" . ($nro->orden_compra);
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

    public function detalle_orden_trabajo()
    {
        return $this->hasMany('App\Models\Detalle_orden_trabajo', 'orden_trabajo_id', 'id');
    }

}
