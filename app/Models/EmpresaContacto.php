<?php

namespace App\Models;

use App\Models\Traits\Attribute\EmpresaContactoAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class EmpresaContacto extends Model
{
 //   use SoftDeletes;
    protected $table = 'empresa_contacto';

    use EmpresaContactoAttribute;

    protected $fillable = [
        'id',
        'nombres',
        'apellidos',
        'foto',
        'email',
        'celular',
        'cliente_proveedor_id',
        'user_empresa_id',
    ];

    public function clienteProveedor()
    {
        return $this->belongsTo('App\Models\ClienteProveedor', 'cliente_proveedor_id', 'id');
    }
}
