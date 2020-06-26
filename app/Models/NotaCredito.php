<?php

namespace App\Models;

use App\Models\Traits\Attribute\NotaCreditoAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NotaCredito extends Model
{
    use NotaCreditoAttribute;
    protected $table = 'notas_credito';
     protected $dates = ['fecha'];
    protected $fillable = [
    	'id',
        'numero',
    	'factura_id',
    	'fecha'
    ];

    public function getNro()
    {
        $empresaUser = Auth::user()->empresaUser();
        $nro         = Correlativo::where('empresa_id', $empresaUser->id)->first();

        if ($nro->id == null) {
            $num             = new Correlativo();
            $num->nota_credito    = 1;
            $num->empresa_id = $empresaUser->id;
            $num->save();
            return "NC-1";

        } else {
            $nro->nota_credito = $nro->nota_credito + 1;
            $nro->save();
            return "NC-" . ($nro->nota_credito);
        }
    }

    public function factura()
    {
    	return $this->belongsTo('App\Models\Factura', 'factura_id', 'id');
    }
}
