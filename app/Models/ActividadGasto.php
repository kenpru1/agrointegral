<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\ActividadGastoAttribute;
//use Illuminate\Database\Eloquent\SoftDeletes;

class ActividadGasto extends Model
{
  //  use SoftDeletes;
    use ActividadGastoAttribute;
    protected $table = 'actividad_gastos';

    protected $dates = ['fecha'];

    protected $fillable = [
        'id',
        'actividad_id',
        'fecha',
        'periodo',
        'nro_factura',
        'nro_comprobante',
        'cliente_proveedor_id',
        'rut',
        'neto',
        'porc_iva',
        'iva',
        'total',
        'descripcion'
    ];

    public function proveedor()
    {
        return $this->belongsTo('App\Models\ClienteProveedor','cliente_proveedor_id','id');
    }

   public function labores()
    {
        return $this->hasMany('App\Models\Labor','actividad_gasto_id','id');
    }


    public function actividad()
    {
        return $this->belongsTo('App\Models\Actividad','actividad_id','id');
    }
}
