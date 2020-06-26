<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\EspecieFuenteAttribute;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use Askedio\SoftCascade\Traits\SoftCascadeTrait;


class EspecieFuente extends Model
{
    use EspecieFuenteAttribute;
    //use SoftDeletes;
    //use SoftCascadeTrait;
    protected $table = 'especies_fuentes';
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
