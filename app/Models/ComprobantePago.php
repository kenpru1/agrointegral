<?php

namespace App\Models;

use App\Models\Traits\Attribute\ComprobantePagoAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Database\Eloquent\SoftDeletes;


class ComprobantePago extends Model
{
  //  use SoftDeletes;

    protected $table = 'comprobantes_pago';
     protected $dates = ['fecha_pago','deleted_at'];

    use ComprobantePagoAttribute;

    protected $fillable = [
        'id',
        'trabajador_id',
        'numero',
        'fecha_pago',
        'total',
    ];

    public function getNro()
    {
        $empresaUser = Auth::user()->empresaUser();
        $nro         = Correlativo::where('empresa_id', $empresaUser->id)->first();

        if ($nro->id == null) {
            $num              = new Correlativo();
            $num->comprobante = 1;
            $num->empresa_id  = $empresaUser->id;
            $num->save();
            return "CO-1";

        } else {
            $nro->comprobante = $nro->comprobante + 1;
            $nro->save();
            return "CO-" . ($nro->comprobante);
        }
    }

    public function trabajador()
    {
    	return $this->belongsTo('App\Models\Trabajador', 'trabajador_id', 'id');
    }

    public function detalle_comprobante()
    {
        return $this->hasMany('App\Models\DetalleComprobantePago', 'comprobante_pago_id', 'id');
    }
}
