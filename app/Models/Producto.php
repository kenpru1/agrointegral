<?php

namespace App\Models;

use App\Models\Traits\Attribute\ProductoAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Producto extends Model
{
    //use SoftDeletes;
    //use SoftCascadeTrait;
    use ProductoAttribute;
    protected $table    = 'productos';
    protected $dates = ['deleted_at'];
    //protected $softCascade = ['stock'];
    protected $fillable = [
        'id',
        'nombre',
        'unidad_id',
        'composicion',
        'cliente_proveedor_id',
        'ficha_tecnica',
        'estado_venta_id',
        'precio_venta',
        'precio_compra',
        'tipo_producto_id',
        'producto_id',
        'empresa_id',
    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }

    public function unidad()
    {
        return $this->belongsTo('App\Models\Unidad', 'unidad_id', 'id');
    }

    public function estado_venta()
    {
        return $this->belongsTo('App\Models\EstadoVenta', 'estado_venta_id', 'id');
    }

    public function tipo_producto()
    {
        return $this->belongsTo('App\Models\TipoProducto', 'tipo_producto_id', 'id');
    }

    public function movimientos()
    {
        return $this->hasMany('App\Models\Movimiento', 'producto_id', 'id');
    }

    public function stock()
    {
        return $this->hasMany('App\Models\Stock', 'producto_id', 'id');
    }
}
