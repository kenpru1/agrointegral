<?php

namespace App\Models;

use App\Models\Traits\Attribute\TipoRacionAttribute;
use Illuminate\Database\Eloquent\Model;

class TipoRacion extends Model
{
    use TipoRacionAttribute;
    protected $table    = 'tipo_raciones';
    protected $fillable = [
        'id',
        'descripcion',
        'empresa_id',
    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }
}
