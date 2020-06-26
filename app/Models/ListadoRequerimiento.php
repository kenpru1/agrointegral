<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListadoRequerimiento extends Model {
	protected $table = 'listado_requerimientos';
	public $timestamps = false;

	protected $fillable = [
		'fecha_muestreo',
		'numero_muestra',
		'informe_recibido',
		'factura_laboratorio',
		'servicio_facturado',
	];

	public function getCreatedAtAttribute($date) {
		return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i');
	}

	public function getUpdatedAtAttribute($date) {
		return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i');
	}
}
