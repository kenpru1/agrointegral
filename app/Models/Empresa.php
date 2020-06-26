<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    //  use SoftDeletes;
    protected $table    = 'empresas';
    protected $fillable = [
        'id',
        'nombre',
        'rut_dni',
        'direccion',
        'comuna',
        'ciudad',
        'pais_id',
        'codigo_postal',
        'email',
        'plan_id',
        'facturacion',
        'giro',
        'logo',
    ];

    public static function mainCompany()
    {
        $company = Empresa::where('id', 1)->first();
        return $company;
    }

    public function pagos()
    {
        return $this->hasMany('App\Models\EmpresaPago', 'empresa_id', 'id');
    }

    public function plan()
    {
        return $this->belongsTo('App\Models\Planes', 'plan_id', 'id');
    }

    public function users()
    {

        return $this->belongsToMany('App\Models\Auth\User', 'empresa_user', 'empresa_id', 'user_id');
    }

    public function empresaContacto()
    {
        return $this->hasManyThrough(
            'App\Models\EmpresaContacto',
            'App\Models\ClienteProveedor',
            'empresa_id',
            'cliente_proveedor_id',
            'id',
            'id'
        );
    }

    public function empresaComprobantes()
    {
        return $this->hasManyThrough(
            'App\Models\ComprobantePago',
            'App\Models\Trabajador',
            'empresa_id',
            'trabajador_id',
            'id',
            'id'
        )->orderBy('id', 'desc');
    }

    public function empresaCuarteles()
    {
        return $this->hasManyThrough(
            'App\Models\Cuartel',
            'App\Models\Campo',
            'empresa_id',
            'campo_id',
            'id',
            'id'
        );
    }

    public function empresaNotasCredito()
    {
        return $this->hasManyThrough(
            'App\Models\NotaCredito',
            'App\Models\Factura',
            'empresa_id',
            'factura_id',
            'id',
            'id'
        )->orderBy('id', 'desc');
    }
}
