<?php

namespace App\Models;

use App\Models\Traits\Attribute\PublicacionAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use \Askedio\SoftCascade\Traits\SoftCascadeTrait;


class Publicacion extends Model
{
    use PublicacionAttribute;
  //  use SoftDeletes;
   // use SoftCascadeTrait;
    protected $table    = 'publicaciones';
    protected $dates       = ['deleted_at'];
   // protected $softCascade = ['publicacion_imagen'];
    protected $fillable = [
        'id',
        'titulo',
        'precio',
        'descripcion',
        'clasificacion',
        'producto_id',
        'tipo_actividad_id',
        'otro',
        'anno_fabricacion',
        'modelo',
        'comuna_id',
        'provincia_id',
        'cantidad',
        'tipo_envio_id',
        'orden_minima',
        'estado_publicacion_id',
        'contacto',
        'telefono',
        'email',
        'empresa_id',
    ];

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto', 'producto_id', 'id');
    }

    public function tipo_actividad()
    {
        return $this->belongsTo('App\Models\TipoActividad', 'tipo_actividad_id', 'id');
    }

    public function publicacion_imagen()
    {
        return $this->hasMany('App\Models\PublicacionImagen', 'publicacion_id', 'id');
    }

    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia', 'provincia_id', 'id');
    }

    public function comuna()
    {
        return $this->belongsTo('App\Models\Comuna', 'comuna_id', 'id');
    }

    public function tipo_envio()
    {
        return $this->belongsTo('App\Models\TipoEnvio', 'tipo_envio_id', 'id');
    }

}
