<?php

namespace App\Models;

use App\Models\Traits\Attribute\SanitarioAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Sanitario extends Model
{
	use SanitarioAttribute;
  //  use SoftDeletes;
   // use SoftCascadeTrait;
    protected $table = 'sanitarios';
    protected $dates = ['deleted_at','fecha_inicio','fecha_termino'];
    // protected $softCascade = ['cuarteles'];
    protected $fillable = [
        'id',
        'labor_id',
        'fecha_inicio',
        'fecha_termino',
        'tipo_sanitario_id',
        'nombre',
        'tratamiento_utilizado',
        'dias',
        'comentario',
        'trabajador_id',
    ];

    public function tipo_sanitario()
    {
        return $this->belongsTo('App\Models\TipoSanitario','tipo_sanitario_id','id');
    }

    public function trabajador()
    {
        return $this->belongsTo('App\Models\Trabajador','trabajador_id','id');
    }

    public function animal()
    {
        return $this->belongsTo('App\Models\Animal','animal_id','id');
    }

    
}
