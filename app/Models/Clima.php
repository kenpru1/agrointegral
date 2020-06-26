<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clima extends Model
{
    protected $table = 'climas';
    protected $dates = ['pubDate'];

    protected $fillable = [
        'id',
        'location_city',
        'location_region',
        'location_country',
        'location_lat',
        'location_long',
        'location_timezone_id',
        'wind_chill',
        'wind_direction',
        'wind_speed',
        'atmosphere_humidity',
        'atmosphere_visibility',
        'atmosphere_pressure',
        'astronomy_sunrise',
        'astronomy_sunset',
        'condition_text',
        'condition_code',
        'condition_temperature',
        'pubDate',
        'campo_id',

    ];

    public function clima_condicion()
    {
        return $this->belongsTo('App\Models\ClimaCondicion', 'condition_code', 'id');
    }

    public function clima_predicciones()
    {

        return $this->hasMany('App\Models\ClimaPrediccion', 'clima_id', 'id');
    }
}
