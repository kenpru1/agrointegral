<?php

namespace App\Models;

use App\Models\Traits\Attribute\GuiaDespachoAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class GuiaDespacho extends Model
{
    use GuiaDespachoAttribute;
  //  use SoftDeletes;
    protected $table    = 'guia_despachos';
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
            $num->guia_despacho = 1;
            $num->empresa_id    = $empresaUser->id;
            $num->save();
            return "GD-1";

        } else {
            $nro->guia_despacho = $nro->guia_despacho + 1;
            $nro->save();
            return "GD-" . ($nro->guia_despacho);
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

    public function detalle_guia_despacho()
    {
        return $this->hasMany('App\Models\DetalleGuiaDespacho', 'guia_despacho_id', 'id');
    }

}
