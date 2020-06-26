<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\GruposAttribute;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use Askedio\SoftCascade\Traits\SoftCascadeTrait;


class Grupo extends Model
{
    use GruposAttribute;
    //use SoftDeletes;
    //use SoftCascadeTrait;
    protected $table = 'grupos';
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
