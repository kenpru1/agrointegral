<?php

namespace App\Models;

use App\Models\Traits\Attribute\EspecieAttribute;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Especie extends Model
{
  //  use SoftDeletes;
    use EspecieAttribute;
    protected $table    = 'especies';
    protected $fillable = [
        'id',
        'nombre',
        'empresa_id',
    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }
}
