<?php

namespace App\Models;

use App\Models\Traits\Attribute\MantencionAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Mantencion extends Model
{
  //  use SoftDeletes;
    use MantencionAttribute;
    protected $table    = 'mantenciones';
    protected $dates    = ['fecha'];
    protected $fillable = [
        'id',
        'descripcion',
        'observaciones',
        'fecha',
        'costo',
        'iva',
        'total_iva',
        'maquinaria_id',
        'cliente_proveedor_id',
    ];

    public function maquinaria()
    {
        return $this->belongsTo('App\Models\Maquinaria', 'maquinaria_id', 'id');
    }
    public function cliente_proveedor()
    {
        return $this->belongsTo('App\Models\ClienteProveedor', 'cliente_proveedor_id', 'id');
    }

}
