<?php

namespace App\Models;

use App\Models\Traits\Attribute\TipoCultivoAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class TipoCultivo extends Model
{
    use TipoCultivoAttribute;
//    use SoftDeletes;
//    use SoftCascadeTrait;
    protected $table    = 'tipos_cultivos';
    protected $dates       = ['deleted_at'];
   // protected $softCascade = ['cuarteles'];
    protected $fillable = [
        'id',
        'nombre',
        'estado',
    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }

    public function cuarteles()
    {
        return $this->hasMany('App\Models\Cuartel', 'tipo_cultivo_id', 'id');
    }

}
