<?php

namespace App\Models;

use App\Models\Traits\Attribute\RequerimientoAttribute;
use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\SoftDeletes;

class Requerimiento extends Model {
	use RequerimientoAttribute;
	//  use SoftDeletes;

	protected $table = 'requerimientos';

	protected $dates = ['fecha_cierre', 'deleted_at'];

	protected $fillable = [
		'id',
		'empresa_id',
		'cliente_proveedor_id',
		'empresa_contacto_id',
		'titulo',
		'monto',
		'estado_requerimiento_id',
		'etapa_requerimiento_id',
		'motivo_perdida',
	];

	public function empresa() {
		return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
	}

	public function clienteProveedor() {
		return $this->belongsTo('App\Models\ClienteProveedor', 'cliente_proveedor_id', 'id');
	}

	public function empresaContacto() {
		return $this->belongsTo('App\Models\EmpresaContacto', 'empresa_contacto_id', 'id');
	}

	public function estadoRequerimiento() {
		return $this->belongsTo('App\Models\EstadoRequerimiento', 'estado_requerimiento_id', 'id');
	}

	public function etapaRequerimiento() {
		return $this->belongsTo('App\Models\EtapaRequerimiento', 'etapa_requerimiento_id', 'id');
	}

	public function presupuestos() {
		return $this->belongsTo('App\Models\Presupuesto', 'presupuesto_id', 'id');
	}

	public function ordenTrabajos() {
		return $this->belongsTo('App\Models\OrdenTrabajo', 'orden_trabajo_id', 'id');
	}

	public function ordenLaboratorios() {
		return $this->belongsTo('App\Models\OrdenLaboratorio', 'orden_laboratorio_id', 'id');
	}

	public function detalleRequerimiento() {
		return $this->hasMany('App\Models\DetalleRequerimiento', 'requerimiento_id', 'id');
	}

	public function detalleOrdenTrabajo() {
		return $this->hasMany('App\Models\DetalleOrdenTrabajo', 'orden_trabajo_id', 'orden_trabajo_id');
	}
	public function detalleOrdenLaboratorio() {
		return $this->hasMany('App\Models\DetalleOrdenLaboratorio', 'orden_laboratorio_id', 'orden_laboratorio_id');
	}

}
