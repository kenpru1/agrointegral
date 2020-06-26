<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\BodegaAttribute;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Bodega extends Model
{
    //use SoftDeletes;
    //use SoftCascadeTrait;
    use BodegaAttribute;
    protected $table = 'bodegas';
    protected $dates = ['deleted_at'];
    //protected $softCascade = ['stocks'];
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'propio',
        'provincia_id',
        'campo_id',
        'direccion',
        'empresa_id',
        'ciudad'
    ];


    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia');
    }

    public function comuna()
    {
        return $this->belongsTo('App\Models\Comuna');
    }

    public function campo()
    {
        return $this->belongsTo('App\Models\Campo','campo_id','id');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }

    public function stocks()
    {
        return $this->hasMany('App\Models\Stock', 'bodega_id', 'id');
    }





}
