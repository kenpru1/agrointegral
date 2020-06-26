<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class TipoSanitario extends Model
{
	//use SoftDeletes;
  //  use SoftCascadeTrait;
    protected $table    = 'tipo_sanitario';
    protected $dates       = ['deleted_at'];
   // protected $softCascade = ['cuarteles'];
    protected $fillable = [
        'id',
        'nombre',
        
    ];
}
