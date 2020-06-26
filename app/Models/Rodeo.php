<?php

namespace App\Models;

use App\Models\Traits\Attribute\RodeoAttribute;
use Illuminate\Database\Eloquent\Model;


class Rodeo extends Model
{

    use RodeoAttribute;
    protected $table    = 'rodeos';
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
