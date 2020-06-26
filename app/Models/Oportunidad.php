<?php

namespace App\Models;

use App\Models\Traits\Attribute\OportunidadAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;



class Oportunidad extends Model
{
    use OportunidadAttribute;
  //  use SoftDeletes;

    protected $table = 'oportunidades';

    protected $dates = ['fecha_cierre','deleted_at'];

    protected $fillable = [
        'id',
        'empresa_id',
        'cliente_proveedor_id',
        'empresa_contacto_id',
        'titulo',
        'monto',
        'estado_oportunidad_id',
        'etapa_oportunidad_id',
        'motivo_perdida',
    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }

    public function clienteProveedor()
    {
        return $this->belongsTo('App\Models\ClienteProveedor', 'cliente_proveedor_id', 'id');
    }

    public function empresaContacto()
    {
        return $this->belongsTo('App\Models\EmpresaContacto', 'empresa_contacto_id', 'id');
    }

    public function estadoOportunidad()
    {
        return $this->belongsTo('App\Models\EstadoOportunidad', 'estado_oportunidad_id', 'id');
    }

    public function etapaOportunidad()
    {
        return $this->belongsTo('App\Models\EtapaOportunidad', 'etapa_oportunidad_id', 'id');
    }
}
