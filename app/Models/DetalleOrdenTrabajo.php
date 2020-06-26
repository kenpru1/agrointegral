<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleOrdenTrabajo extends Model
{
    protected $table    = 'detalle_orden_trabajo';
    protected $fillable = [
        'orden_compra_id',
        'tipo_muestra_id',
        'especi_fuente_id',
        'laboratorio_id',
        'variedad',
        'descripcion',
        'plazo_entrega',
        'trabajador_id',
        'campo_id',
        'cuartel_id',                        

    ];

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

    public function campo()
    {
        return $this->belongsTo('App\Models\Campo','campo_id','id');
    }
}
