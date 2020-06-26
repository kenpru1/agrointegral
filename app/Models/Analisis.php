<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\AnalisisAttribute;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use Askedio\SoftCascade\Traits\SoftCascadeTrait;


class Analisis extends Model
{
    use AnalisisAttribute;
    //use SoftDeletes;
    //use SoftCascadeTrait;
    protected $table = 'analisis';
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
