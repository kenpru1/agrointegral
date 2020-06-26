<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\CorrelativoAttribute;

class Correlativo extends Model
{
	use CorrelativoAttribute;
    protected $table = 'correlativos';
    protected $fillable = [
        'id',
        'presupuesto',
        'factura',
        'comprobante',
        'nota_credito',
        'guia_despacho',
        
    ];


    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }
}
