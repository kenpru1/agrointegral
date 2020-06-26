<?php

namespace App\Models;

use App\Models\Traits\Attribute\OrdenLaboratorioAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrdenLaboratorio extends Model
{
    use OrdenLaboratorioAttribute;
    protected $table    = 'orden_laboratorios';
    protected $dates    = ['fecha', 'fecha_entrega'];
    protected $fillable = [
        'id',
        'numero',
        'fecha',
        'user_id',
        'cliente_id',
        'empresa_contacto_id',
        'trabajador_id',
        'laboratorio_id',
        'fecha_entrega',
        'empresa_id',
    ];

    public function getNro()
    {
        $empresaUser = Auth::user()->empresaUser();
        $nro         = Correlativo::where('empresa_id', $empresaUser->id)->first();

        if ($nro->id == null) {
            $num              = new Correlativo();
            $num->orden_laboratorio = 1;
            $num->empresa_id    = $empresaUser->id;
            $num->save();
            return "OT-1";

        } else {
            $nro->orden_laboratorio = $nro->orden_laboratorio + 1;
            $nro->save();
            return "OL-" . ($nro->orden_laboratorio);
        }
    }
    public function laboratorio()
    {
        return $this->belongsTo('App\Models\Laboratorio', 'laboratorio_id', 'id');
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

    public function detalleOrdenLaboratorio()
    {
        return $this->hasMany('App\Models\DetalleOrdenLaboratorio', 'orden_laboratorio_id', 'id');
    }
    public function requerimientos()
    {
        return $this->hasOne('App\Models\Requerimiento', 'orden_laboratorio_id', 'id');
    }        

}
