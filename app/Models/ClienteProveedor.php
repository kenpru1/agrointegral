<?php

namespace App\Models;

use App\Models\Traits\Attribute\ClienteProveedorAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class ClienteProveedor extends Model
{
    protected $table = 'cliente_proveedor';

    use ClienteProveedorAttribute;
  //  use SoftDeletes;
  //  use SoftCascadeTrait;
    protected $dates    = ['deleted_at'];
  //  protected $softCascade = ['empresaContacto','oportunidades','presupuestos','guia_despachos'];
    protected $fillable = [
        'id',
        'nombre_razon',
        'rut',
        'email',
        'telefono',
        'direccion',
        'codigo_postal',
        'web',
        'proveedor',
        'cliente',
        'provincia_id',
        'comuna_id',
        'pais_id',
        'empresa_id',
        'observacion',

    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }

    public function actividades()
    {

        return $this->belongsToMany('App\Models\Actividad', 'actividad_cliente', 'cliente_id', 'actividad_id');
    }

    public function pais()
    {
        return $this->belongsTo('App\Models\Paises', 'pais_id', 'id');
    }

    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia', 'provincia_id', 'id');
    }

    public function comuna()
    {
        return $this->belongsTo('App\Models\Comuna', 'comuna_id', 'id');
    }

    public function empresaContacto()
    {
        return $this->hasMany('App\Models\EmpresaContacto', 'cliente_proveedor_id', 'id');
    }

    public function oportunidades()
    {
        return $this->hasMany('App\Models\Oportunidad', 'cliente_proveedor_id', 'id');
    }

    public function presupuestos()
    {
        return $this->hasMany('App\Models\Presupuesto', 'cliente_id', 'id');
    }

    public function guia_despachos()
    {
        return $this->hasMany('App\Models\GuiaDespacho', 'cliente_id', 'id');
    }
    public function grupos()
    {
        return $this->belongsTo('App\Models\Grupo', 'grupo_id', 'id');
    }    

}
