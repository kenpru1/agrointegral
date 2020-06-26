<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePresupuesto extends Model
{
    protected $table    = 'detalle_presupuesto';
    protected $fillable = [
        'presupuesto_id',
        'producto_id',
        'especie_fuente_id',
        'tipo_muestra_id',
        'analisis_id',                        
        'laboratorio_id',
        'cantidad',
        'precio_venta',
        'total',
        'desc_libre',

    ];

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto','producto_id','id');
    }

    public function especieFuente()
    {
        return $this->belongsTo('App\Models\EspecieFuente','especie_fuente_id','id');
    }

    public function tipoMuestra()
    {
        return $this->belongsTo('App\Models\TipoMuestra','tipo_muestra_id','id');
    }

    public function analisis()
    {
        return $this->belongsTo('App\Models\Analisis','analisis_id','id');
    }

    public function laboratorio()
    {
        return $this->belongsTo('App\Models\Laboratorio','laboratorio_id','id');
    }
}
