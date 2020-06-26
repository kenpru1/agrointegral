<?php

namespace App\Models;

use App\Models\Traits\Attribute\AnimalAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Animal extends Model
{
    use AnimalAttribute;
    //use SoftDeletes;
    //use SoftCascadeTrait;
    protected $table    = 'animales';
    protected $dates = ['fecha_nacimiento','fecha_muerte','deleted_at'];
    //protected $softCascade = ['comprobante_pagos'];
    protected $fillable = [
        'id',
        'caravana',
        'nombre',
        'especie_id',
        'raza',
        'categoria_pedigree',
        'sexo_id',
        'fecha_nacimiento',
        'peso_nacer',
        'caravana_madre',
        'nombre_madre',
        'caravana_progenitor',
        'nombre_progenitor',
        'indice_corporal',
        'rodeo_id',
        'observaciones',
        'codigo_rfid',
        'fecha_muerte',
        'empresa_id'
    ];

    public function rodeo()
    {
        return $this->belongsTo('App\Models\Rodeo','rodeo_id','id');
    }

    public function especie()
    {
        return $this->belongsTo('App\Models\Especie','especie_id','id');
    }

    public function sanitarios()
    {
        return $this->hasMany('App\Models\Sanitario', 'animal_id', 'id');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }


}
