<?php

namespace App\Models;

use App\Models\Traits\Attribute\OrdenTrabajoAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class OrdenTrabajo extends Model
{
  //  use SoftDeletes;
    use OrdenTrabajoAttribute;
    protected $table    = 'orden_trabajos';
    protected $dates    = ['fecha', 'fecha_entrega'];
    protected $fillable = [
        'id',
        'fecha',
        'cliente_id',
        'empresa_contacto_id',
        'validez',
        'fecha_entrega',
        'estado_presupuesto_id',
        'empresa_id',
    ];

    public function getNro()
    {
        $empresaUser = Auth::user()->empresaUser();
        $nro         = Correlativo::where('empresa_id', $empresaUser->id)->first();

        if ($nro->id == null) {
            $num              = new Correlativo();
            $num->orden_trabajo = 1;
            $num->empresa_id    = $empresaUser->id;
            $num->save();
            return "OT-1";

        } else {
            $nro->orden_trabajo = $nro->orden_trabajo + 1;
            $nro->save();
            return "OT-" . ($nro->orden_trabajo);
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

    public function trabajador()
    {
        return $this->belongsTo('App\Models\Trabajador', 'trabajador_id', 'id');
    }    

    public function usuario()
    {
        return $this->belongsTo('App\Models\Auth\User', 'user_id', 'id');
    }    
    public function empresaContacto()
    {
        return $this->belongsTo('App\Models\EmpresaContacto', 'empresa_contacto_id', 'id');
    }        

    public function detalleOrdenTrabajo()
    {
        return $this->hasMany('App\Models\DetalleOrdenTrabajo', 'orden_trabajo_id', 'id');
    }
    public function requerimientos()
    {
        return $this->hasOne('App\Models\Requerimiento', 'orden_trabajo_id', 'id');
    }        


}
