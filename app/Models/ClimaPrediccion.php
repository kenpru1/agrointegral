<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClimaPrediccion extends Model
{
    protected $table = 'climas_predicciones';
    protected $dates = ['date'];

    protected $fillable = [
        'id',
        'day',
        'date',
        'low',
        'high',
        'text',
        'code',
        'clima_id',

    ];

     public function clima()
    {
        return $this->belongsTo('App\Models\Clima','clima_id','id');
    }

    public function clima_condicion()
    {
        return $this->belongsTo('App\Models\ClimaCondicion','code','id');
    }
}
