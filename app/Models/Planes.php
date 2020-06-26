<?php

namespace App\Models;

use App\Models\Traits\Attribute\PlanAttribute;
use Illuminate\Database\Eloquent\Model;


class Planes extends Model
{
	 use PlanAttribute;
  
    protected $table    = 'planes';
    protected $fillable = [
        'id',
        'nombre',
        'valor_uf',
        'cantidad_uf',
        'costo',
    ];
}
