<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class EmpresaUser extends Model
{
  //  use SoftDeletes;
    protected $table    = 'empresa_user';
    protected $fillable = [
        'id',
        'empresa_id',
        'user_id',

    ];

    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User', 'id', 'user_id');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'id', 'empresa_id');
    }

}
