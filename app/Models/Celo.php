<?php

namespace App\Models;

use App\Models\Traits\Attribute\CeloAttribute;
use Illuminate\Database\Eloquent\Model;

class Celo extends Model
{
	use CeloAttribute;
    protected $table    = 'celos';
    protected $dates = ['fecha_deteccion'];
    //protected $softCascade = ['comprobante_pagos'];
    protected $fillable = [
        'id',
        'animal_id',
        'fecha_deteccion',
        'observaciones'
        
    ];

    public function animal()
    {
        return $this->belongsTo('App\Models\Animal','animal_id','id');
    }
}
