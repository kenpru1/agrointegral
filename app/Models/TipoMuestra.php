<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\TipoMuestrasAttribute;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use Askedio\SoftCascade\Traits\SoftCascadeTrait;


class TipoMuestra extends Model
{
    use TipoMuestrasAttribute;
    //use SoftDeletes;
    //use SoftCascadeTrait;
    protected $table = 'tipo_muestras';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'nombre',
        'empresa_id'
    ];


    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa','empresa_id','id');
    }


}
