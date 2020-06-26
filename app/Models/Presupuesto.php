<?php

namespace App\Models;

use App\Models\Traits\Attribute\PresupuestoAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Presupuesto extends Model
{
  //  use SoftDeletes;
    use PresupuestoAttribute;
    protected $table    = 'presupuestos';
    protected $dates    = ['fecha', 'fecha_entrega'];
    protected $fillable = [
        'id',
        'fecha',
        'cliente_id',
        'validez',
        'condicion_pago_id',
        'tipo_pago_id',
        'fuente_id',
        'fecha_entrega',
        'nota_publica',
        'nota_privada',
        'sub_total',
        'porcentaje_descuento',
        'porcentaje_iva',
        'iva',
        'descuento',
        'estado_presupuesto_id',
        'empresa_id',
    ];

    public function getNro()
    {
        $empresaUser = Auth::user()->empresaUser();
        $nro         = Correlativo::where('empresa_id', $empresaUser->id)->first();

        if ($nro->id == null) {
            $num              = new Correlativo();
            $num->presupuesto = 1;
            $num->empresa_id  = $empresaUser->id;
            $num->save();
            return "PR-1";

        } else {
            $nro->presupuesto = $nro->presupuesto + 1;
            $nro->save();
            return "PR-" . ($nro->presupuesto);
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

    public function usuario()
    {
        return $this->belongsTo('App\Models\Auth\User', 'user_id', 'id');
    }    
    public function empresaContacto()
    {
        return $this->belongsTo('App\Models\EmpresaContacto', 'empresa_contacto_id', 'id');
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

    public function estado_presupuesto()
    {
        return $this->belongsTo('App\Models\EstadoPresupuesto', 'estado_presupuesto_id', 'id');
    }

    public function detalle_presupuesto()
    {
        return $this->hasMany('App\Models\DetallePresupuesto', 'presupuesto_id', 'id');
    }
    public function requerimientos()
    {
        return $this->hasOne('App\Models\Requerimiento', 'presupuesto_id', 'id');
    }    


}
