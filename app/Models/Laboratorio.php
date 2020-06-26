<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\LaboratorioAttribute;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use Askedio\SoftCascade\Traits\SoftCascadeTrait;


class Laboratorio extends Model
{
    use LaboratorioAttribute;
    //use SoftDeletes;
    //use SoftCascadeTrait;
    protected $table = 'laboratorio';
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
