<?php

namespace App\Models;

use App\Models\Traits\Attribute\TipoMaquinariaAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class TipoMaquinaria extends Model
{
//    use SoftDeletes;
    use TipoMaquinariaAttribute;
    protected $table    = 'tipo_maquinarias';
    protected $fillable = [
        'id',
        'nombre',
        'empresa_id',
    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }

}
