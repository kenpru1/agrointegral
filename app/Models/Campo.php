<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\CampoAttribute;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use Askedio\SoftCascade\Traits\SoftCascadeTrait;


class Campo extends Model
{
    use CampoAttribute;
    //use SoftDeletes;
    //use SoftCascadeTrait;
    protected $table = 'campos';
    protected $dates = ['deleted_at'];
    //protected $softCascade = ['bodegas','cuarteles'];
    protected $fillable = [
        'id',
        'nombre',
        'propio',
        'provincia_id',
        'comuna_id',
        'trabajador_id',
        'descripcion',
        'tamanno',
        'empresa_id',
        'empresa_contacto_id'
    ];


    public function trabajador()
    {
        return $this->belongsTo('App\Models\Trabajador','trabajador_id','id');
    }

    public function clientes()
    {
        return $this->belongsTo('App\Models\ClienteProveedor','cliente_proveedor_id','id');
    }    

    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia','provincia_id','id');
    }

    public function comuna()
    {
        return $this->belongsTo('App\Models\Comuna','comuna_id','id');
    }

    public function cuarteles()
    {
        return $this->hasMany('App\Models\Cuartel', 'campo_id','id');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa','empresa_id','id');
    }

    public function actividades() {

        return $this->belongsToMany('App\Models\Actividad.php','actividad_campo','campo_id','actividad_id');
    }

    public function bodegas()
    {
        return $this->hasMany('App\Models\Bodega', 'campo_id','id');
    }

    public function clima()
    {
        return $this->hasOne('App\Models\Clima', 'campo_id','id');
    }

    





}
