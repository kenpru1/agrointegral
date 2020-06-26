<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Requerimiento\ManageRequerimientoRequest;
use App\Http\Requests\Backend\Requerimiento\StoreRequerimientoRequest;
use App\Http\Requests\Backend\Requerimiento\UpdateRequerimientoRequest;
use App\Models\Analisis;
use App\Models\Auth\User;
use App\Models\Campo;
use App\Models\ClienteProveedor;
use App\Models\DetalleRequerimiento;
use App\Models\EmpresaContacto;
use App\Models\EspecieFuente;
use App\Models\EtapaRequerimiento;
use App\Models\Laboratorio;
use App\Models\ListadoRequerimiento;
use App\Models\OrdenLaboratorio;
use App\Models\OrdenTrabajo;
use App\Models\Presupuesto;
use App\Models\Requerimiento;
use App\Models\TipoMuestra;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequerimientosController extends Controller {
	public function index() {
		$empresaUser = User::find(Auth::id())->empresas()->first();

		if ($empresaUser != null) {
			if (auth()->user()->hasRole('administrator')) {
				$requerimientos = Requerimiento::orderBy('id', 'desc')->get();
			} else {
				$requerimientos = Requerimiento::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();
			}

			return view('backend.requerimientos.index', compact('requerimientos'));

		} else {
			return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
		}
	}

	public function create(ManageRequerimientoRequest $request) {
		$empresaUser = User::find(Auth::id())->empresas()->first();

		$cliProvs = ClienteProveedor::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

		$tipoMuestras = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$analisis = Analisis::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$especies = EspecieFuente::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$campos = Campo::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$muestras = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$laboratorios = Laboratorio::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		return view('backend.requerimientos.create', compact('cliProvs', 'tipoMuestras', 'analisis', 'especies', 'campos', 'muestras', 'laboratorios'));
	}

	public function store(StoreRequerimientoRequest $request) {
		try
		{
			DB::beginTransaction();
			$input = $request->all();
			$empresaUser = User::find(Auth::id())->empresas()->first();

			$requerimiento = new Requerimiento();
			$requerimiento->empresa_id = $empresaUser->id;
			$requerimiento->cliente_proveedor_id = $request->input('cliente_proveedor_id');
			$requerimiento->empresa_contacto_id = $request->input('empresa_contacto_id');
			$requerimiento->titulo = $request->input('titulo');
			$requerimiento->monto = $request->input('monto');
			$requerimiento->fecha_cierre = $request->input('fecha_cierre');
			$requerimiento->tipo_muestra_id = $request->input('tipo_muestra_id');
			$requerimiento->analisis_id = $request->input('analisis_id');
			$requerimiento->numero_muestra = $request->input('numero_muestra');

			$requerimiento->etapa_requerimiento_id = 1;
			$requerimiento->save();

			for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {
				$detalle = new DetalleRequerimiento();
				$detalle->requerimiento_id = $requerimiento->id;
				$detalle->tipo_muestra_id = $input['muestra_array'][$i];
				$detalle->especie_fuente_id = $input['especie_array'][$i];
				$detalle->analisis_id = $input['analisis_array'][$i];
				$detalle->laboratorio_id = $input['laboratorio_array'][$i];
				$detalle->campo_id = $input['campo_array'][$i];
				$detalle->cuartel_id = $input['cuartel_array'][$i];
				$detalle->plazo_entrega = $input['plazo_array'][$i];
				$detalle->variedad = $input['variedad_array'][$i];
				$detalle->descripcion = $input['descripcion_array'][$i];

				$detalle->save();

			}

			DB::commit();

			return redirect()->route('admin.requerimientos.index')->withFlashSuccess('Registro creado con éxito');

		} catch (\Exception $e) {
			DB::rollback();
			dd($e);

			return redirect()->route('admin.requerimientos.index')->withFlashSuccess('Error Inesperado');
		}
	}

	public function edit(ManageRequerimientoRequest $request, Requerimiento $requerimiento) {
		$empresaUser = User::find(Auth::id())->empresas()->first();

		$cliProvs = ClienteProveedor::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

		$contactos = EmpresaContacto::where('cliente_proveedor_id', $requerimiento->cliente_proveedor_id)->orderBy('id', 'asc')->get()->pluck('nombre_and_apellido', 'id');

		$tipoMuestras = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$analisis = Analisis::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$presupuestos = Presupuesto::where('empresa_id', $empresaUser->id)
			->with('requerimientos')->doesntHave('requerimientos')
			->orderBy('id', 'asc')->get()->pluck('numero_and_nombre', 'id');

		$ordenTrabajos = OrdenTrabajo::where('empresa_id', $empresaUser->id)
			->with('requerimientos')->doesntHave('requerimientos')
			->orderBy('id', 'asc')->get()->pluck('numero_and_nombre', 'id');

		$ordenLaboratorios = OrdenLaboratorio::where('empresa_id', $empresaUser->id)
			->with('requerimientos')->doesntHave('requerimientos')
			->orderBy('id', 'asc')->get()->pluck('numero_and_nombre', 'id');

		$etapas = EtapaRequerimiento::orderBy('id', 'asc')->pluck('nombre', 'id');

		$especies = EspecieFuente::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$campos = Campo::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$muestras = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$laboratorios = Laboratorio::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		return view('backend.requerimientos.edit', compact('cliProvs', 'contactos', 'requerimiento', 'etapas', 'tipoMuestras', 'analisis', 'presupuestos', 'ordenTrabajos', 'ordenLaboratorios', 'especies', 'campos', 'muestras', 'laboratorios'));
	}

	public function update(UpdateRequerimientoRequest $request, Requerimiento $requerimiento) {
		try
		{
			DB::beginTransaction();

			$input = $request->all();
			$empresaUser = User::find(Auth::id())->empresas()->first();

			//dd($request);

			$requerimiento->empresa_id = $empresaUser->id;
			$requerimiento->cliente_proveedor_id = $request->input('cliente_proveedor_id');
			$requerimiento->empresa_contacto_id = $request->input('empresa_contacto_id');
			$requerimiento->titulo = $request->input('titulo');
			$requerimiento->monto = $request->input('monto');
			$requerimiento->fecha_cierre = $request->input('fecha_cierre');
			$requerimiento->tipo_muestra_id = $request->input('tipo_muestra_id');
			$requerimiento->analisis_id = $request->input('analisis_id');
			$requerimiento->numero_muestra = $request->input('numero_muestra');

			DB::table('detalle_requerimiento')->where('requerimiento_id', $requerimiento->id)->delete();

			for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {

				$detalle = new DetalleRequerimiento();

				$detalle->requerimiento_id = $requerimiento->id;
				$detalle->tipo_muestra_id = $input['muestra_array'][$i];
				$detalle->especie_fuente_id = $input['especie_array'][$i];
				$detalle->analisis_id = $input['analisis_array'][$i];
				$detalle->laboratorio_id = $input['laboratorio_array'][$i];
				$detalle->campo_id = $input['campo_array'][$i];
				$detalle->cuartel_id = $input['cuartel_array'][$i];
				$detalle->plazo_entrega = $input['plazo_array'][$i];
				$detalle->variedad = $input['variedad_array'][$i];
				$detalle->descripcion = $input['descripcion_array'][$i];

				$detalle->save();

			}

			$cambioEtapa = $request->input('etapa_requerimiento_id') - $requerimiento->etapa_requerimiento_id;

			if (($requerimiento->presupuesto_id == null) && ($request->input('etapa_requerimiento_id') == 2)) {
				return redirect()->back()->withFlashDanger('No hay cotización asociada al requerimiento');

			} else {
				$requerimiento->etapa_requerimiento_id = $request->input('etapa_requerimiento_id');
			}
			if (($requerimiento->orden_trabajo_id == null) && ($request->input('etapa_requerimiento_id') == 4)) {
				return redirect()->back()->withFlashDanger('No hay orden de trabajo asociada al requerimiento');

			} else {
				$requerimiento->etapa_requerimiento_id = $request->input('etapa_requerimiento_id');
			}
			if (($requerimiento->orden_laboratorio_id == null) && ($request->input('etapa_requerimiento_id') == 5)) {
				return redirect()->back()->withFlashDanger('No hay orden de laboratorio asociada al requerimiento');

			} else {
				$requerimiento->etapa_requerimiento_id = $request->input('etapa_requerimiento_id');
			}

			if ($cambioEtapa == 1) {

				$requerimiento->etapa_requerimiento_id = $request->input('etapa_requerimiento_id');

			} elseif ($cambioEtapa > 1) {
				return redirect()->back()->withFlashDanger('No puede cambiar de etapa,  faltan documentos por asociar');

			} elseif (($cambioEtapa < 0) && ($request->input('etapa_requerimiento_id') == 2) && ($request->input('etapa_requerimiento_id') == 5) && ($request->input('etapa_requerimiento_id') == 7)) {
				return redirect()->back()->withFlashDanger('No puede cambiar de etapa');
			}

			//$Requerimiento->etapa_oportunidad_id = $request->input('etapa_oportunidad_id');
			$requerimiento->save();

			DB::commit();

			return redirect()->route('admin.requerimientos.index')->withFlashSuccess('Registro editado con éxito');

		} catch (\Exception $e) {
			dd($e);
			DB::rollback();

			return redirect()->route('admin.requerimientos.index')->withFlashSuccess('Error Inesperado');
		}
	}

	public function show(ManageRequerimientoRequest $request, Requerimiento $requerimiento) {
		$empresaUser = User::find(Auth::id())->empresas()->first();

		$cliProvs = ClienteProveedor::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

		$contactos = $empresaUser->empresaContacto->pluck('nombres', 'id');

		$tipoMuestras = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$analisis = Analisis::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$etapas = EtapaRequerimiento::orderBy('id', 'asc')->pluck('nombre', 'id');

		return view('backend.requerimientos.show', compact('cliProvs', 'contactos', 'requerimiento', 'etapas', 'tipoMuestras', 'analisis'));
	}

	public function destroy(ManageRequerimientoRequest $request, Requerimiento $requerimiento) {
		try
		{

			DB::beginTransaction();
			$requerimiento->delete();
			DB::commit();

			return redirect()->route('admin.requerimientos.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->route('admin.requerimientos.index')->withFlashSuccess('Error Inesperado');
		}
	}

	public function getContactos(Request $request) {
		try
		{
			$contactos = EmpresaContacto::where('cliente_proveedor_id', $request['cliente_proveedor_id'])->get();

			return response()->json($contactos);
		} catch (\Exception $e) {
			return response()->json('Error Inesperado', 404);
		}
	}

	public function changeCotizada(ManageRequerimientoRequest $request, Requerimiento $requerimiento) {

		$empresaUser = User::find(Auth::id())->empresas()->first();

		$cliProvs = ClienteProveedor::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

		$presupuestos = Presupuesto::where('empresa_id', $empresaUser->id)
			->with('requerimientos')->doesntHave('requerimientos')
			->orderBy('id', 'asc')->get()->pluck('numero_and_nombre', 'id');

		$contactos = $empresaUser->empresaContacto->pluck('nombres', 'id');

		$etapas = EtapaRequerimiento::orderBy('id', 'asc')->pluck('nombre', 'id');

		$tipoMuestras = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$analisis = Analisis::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		return view('backend.requerimientos.changeCotizada', compact('cliProvs', 'contactos', 'etapas', 'requerimiento', 'presupuestos', 'tipoMuestras', 'analisis'));
	}

	public function putCotizada(Request $request) {
		try
		{

			DB::beginTransaction();

			$requerimiento = Requerimiento::where('presupuesto_id', $request['presupuesto_id'])->whereNotNull('presupuesto_id')->first();

			if ($requerimiento != null) {

				return redirect()->back()->withFlashDanger('Nro. Cotización ya fue asociada a otro requerimiento');
			}

			$requerimiento = Requerimiento::where('id', $request['requerimiento_id'])->first();

			if ($requerimiento->etapa_requerimiento_id < 3) {

				$requerimiento->presupuesto_id = $request['presupuesto_id'];
				if ($requerimiento->etapa_requerimiento_id < 2) {
					$requerimiento->etapa_requerimiento_id = 2;
				}
			} else {
				return redirect()->back()->withFlashDanger('Nro. Cotización ya fue procesada, no puede cambiarla');
			}

			if ($request['presupuesto_id'] == null) {
				$requerimiento->etapa_requerimiento_id = 1;
			}

			$requerimiento->update();

			DB::commit();

			if ($request['presupuesto_id'] != null) {
				$mensaje = "Nro. Cotización asociado con éxito al requerimiento";
				return response()->json(array('message' => $mensaje), 200);
			} else {
				$mensaje = "Nro. Cotización ya no esta asociada a requerimiento";

				return Response()->json(array('message' => $mensaje), 200);
			}

		} catch (\Exception $e) {
			// dd($e);

			DB::rollback();
			return Response()->json(array('message' => 'Error Inesperado...'), 401);

			//return response()->json('Error Inesperado', 404);
		}
	}

	public function changeOrdenTrabajo(ManageRequerimientoRequest $request, Requerimiento $requerimiento) {

		$empresaUser = User::find(Auth::id())->empresas()->first();

		$cliProvs = ClienteProveedor::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

		$ordenTrabajos = OrdenTrabajo::where('empresa_id', $empresaUser->id)
			->with('requerimientos')->doesntHave('requerimientos')
			->orderBy('id', 'asc')->get()->pluck('numero_and_nombre', 'id');

		$contactos = $empresaUser->empresaContacto->pluck('nombres', 'id');

		$etapas = EtapaRequerimiento::orderBy('id', 'asc')->pluck('nombre', 'id');

		$tipoMuestras = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$analisis = Analisis::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		return view('backend.requerimientos.changeOrdenTrabajo', compact('cliProvs', 'contactos', 'etapas', 'requerimiento', 'ordenTrabajos', 'tipoMuestras', 'analisis'));
	}

	public function putOrdenTrabajo(Request $request) {
		try
		{

			DB::beginTransaction();

			$requerimiento = Requerimiento::where('orden_trabajo_id', $request['orden_trabajo_id'])->whereNotNull('orden_trabajo_id')->first();

			if ($requerimiento != null) {

				return redirect()->back()->withFlashDanger('Nro. Orden de Trabajo ya fue asociada a otro requerimiento');
			}

			$requerimiento = Requerimiento::where('id', $request['requerimiento_id'])->first();

			$presupuestos = Presupuesto::where('id', $requerimiento->presupuesto_id)->first();

			if ($requerimiento->etapa_requerimiento_id < 5) {

				$requerimiento->orden_trabajo_id = $request['orden_trabajo_id'];
				if ($requerimiento->etapa_requerimiento_id < 3) {
					$requerimiento->etapa_requerimiento_id = 3;
				}
			} else {
				return redirect()->back()->withFlashDanger('Nro. Orden de Trabajo ya fue procesada, no puede cambiarla');
			}

			if ($request['orden_trabajo_id'] == null) {
				$requerimiento->etapa_requerimiento_id = 2;
			}

			$presupuestos->estado_presupuesto_id = 2;

			$presupuestos->save();

			$requerimiento->orden_trabajo_id = $request['orden_trabajo_id'];

			$requerimiento->update();

			DB::commit();
			if ($request['orden_trabajo_id'] != null) {
				$mensaje = "Nro. Orden de Trabajo asociada con éxito al requerimiento";
				return response()->json(array('message' => $mensaje), 200);
			} else {
				$mensaje = "Nro. Orden de Trabajo ya no esta asociada a requerimiento";

				return Response()->json(array('message' => $mensaje), 200);
			}

		} catch (\Exception $e) {
			//dd($e);

			DB::rollback();
			return Response()->json(array('message' => 'Error Inesperado...'), 401);

			//return response()->json('Error Inesperado', 404);
		}
	}

	public function changeOrdenLaboratorio(ManageRequerimientoRequest $request, Requerimiento $requerimiento) {

		$empresaUser = User::find(Auth::id())->empresas()->first();

		$cliProvs = ClienteProveedor::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

		$ordenLaboratorios = OrdenLaboratorio::where('empresa_id', $empresaUser->id)
			->with('requerimientos')->doesntHave('requerimientos')
			->orderBy('id', 'asc')->get()->pluck('numero_and_nombre', 'id');

		$contactos = $empresaUser->empresaContacto->pluck('nombres', 'id');

		$etapas = EtapaRequerimiento::orderBy('id', 'asc')->pluck('nombre', 'id');

		$tipoMuestras = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$analisis = Analisis::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		return view('backend.requerimientos.changeOrdenLaboratorio', compact('cliProvs', 'contactos', 'etapas', 'requerimiento', 'ordenLaboratorios', 'tipoMuestras', 'analisis'));
	}

	public function putOrdenLaboratorio(Request $request) {
		try
		{

			DB::beginTransaction();

			$requerimiento = Requerimiento::where('orden_laboratorio_id', $request['orden_laboratorio_id'])->whereNotNull('orden_laboratorio_id')->first();

			if ($requerimiento != null) {

				return redirect()->back()->withFlashDanger('Nro. Orden de Laboratorio ya fue asociada a otro requerimiento');
			}

			$requerimiento = Requerimiento::where('id', $request['requerimiento_id'])->first();

			if ($requerimiento->etapa_requerimiento_id < 6) {

				$requerimiento->orden_laboratorio_id = $request['orden_laboratorio_id'];
				if ($requerimiento->etapa_requerimiento_id < 6) {
					$requerimiento->etapa_requerimiento_id = 5;
				}

			} else {
				return redirect()->back()->withFlashDanger('Nro. Orden de Laboratorio ya fue procesada, no puede cambiarla');
			}

			if ($request['orden_laboratorio_id'] == null) {
				$requerimiento->etapa_requerimiento_id = 4;
			}

			$requerimiento->update();

			DB::commit();
			if ($request['orden_laboratorio_id'] != null) {
				$mensaje = "Nro. Orden Laboratorio asociada con éxito al requerimiento";
				return response()->json(array('message' => $mensaje), 200);
			} else {
				$mensaje = "Nro. Orden Laboratorio ya no esta asociada a requerimiento";

				return Response()->json(array('message' => $mensaje), 200);
			}

		} catch (\Exception $e) {
			//dd($e);

			DB::rollback();
			return Response()->json(array('message' => 'Error Inesperado...'), 401);

			//return response()->json('Error Inesperado', 404);
		}
	}

	public function tablero() {
		$empresaUser = User::find(Auth::id())->empresas()->first();

		if ($empresaUser != null) {
			if (auth()->user()->hasRole('administrator')) {
				$requerimientos = Requerimiento::orderBy('id', 'desc')->get();

				$registradas = Requerimiento::where('etapa_requerimiento_id', 1)->orderBy('id', 'desc')->get();

				$cotizadas = Requerimiento::where('etapa_requerimiento_id', 2)->orderBy('id', 'desc')->get();

				$aprobadas = Requerimiento::where('etapa_requerimiento_id', 3)->orderBy('id', 'desc')->get();

				$tomaMuestras = Requerimiento::where('etapa_requerimiento_id', 4)->orderBy('id', 'desc')->get();

				$enviadas = Requerimiento::where('etapa_requerimiento_id', 5)->orderBy('id', 'desc')->get();

				$recibidas = Requerimiento::where('etapa_requerimiento_id', 6)->orderBy('id', 'desc')->get();

			} else {
				$requerimientos = Requerimiento::where('empresa_id', $empresaUser->id)->
					where('motivo_perdida', null)->orderBy('id', 'desc')->get();

				$registradas = Requerimiento::where('empresa_id', $empresaUser->id)
					->where('etapa_requerimiento_id', 1)
					->where('motivo_perdida', null)->orderBy('id', 'desc')->get();

				$cotizadas = Requerimiento::where('empresa_id', $empresaUser->id)
					->where('etapa_requerimiento_id', 2)
					->where('motivo_perdida', null)->orderBy('id', 'desc')->get();

				$aprobadas = Requerimiento::where('empresa_id', $empresaUser->id)
					->where('etapa_requerimiento_id', 3)->orderBy('id', 'desc')->get();

				$tomaMuestras = Requerimiento::where('empresa_id', $empresaUser->id)
					->where('etapa_requerimiento_id', 4)
					->where('motivo_perdida', null)->orderBy('id', 'desc')->get();

				$enviadas = Requerimiento::where('empresa_id', $empresaUser->id)
					->where('etapa_requerimiento_id', 5)
					->where('motivo_perdida', null)->orderBy('id', 'desc')->get();

				$recibidas = Requerimiento::where('empresa_id', $empresaUser->id)
					->where('etapa_requerimiento_id', 6)
					->where('motivo_perdida', null)->orderBy('id', 'desc')->get();

				//dd($establecidos);
			}

			return view('backend.requerimientos.tablero', compact('requerimientos', 'registradas', 'cotizadas', 'aprobadas', 'tomaMuestras', 'enviadas', 'recibidas'));

		} else {
			return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
		}

	}

	public function perdida(Request $request, Requerimiento $Requerimiento) {
		try
		{
			DB::beginTransaction();

			//$Requerimiento->etapa_requerimiento_id = 6;
			$Requerimiento->motivo_perdida = 'Archivado';
			$Requerimiento->save();

			DB::commit();

			return redirect()->route('admin.requerimientos.tablero')->withFlashSuccess('El requerimiento ha sido archivado');
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->route('admin.requerimientos.tablero')->withFlashDanger('Error Inesperado');
		}
	}

	public function changeToTablero(Request $request) {
		try
		{

			$completado = false;
			DB::beginTransaction();
			$requerimiento = Requerimiento::where('id', $request['requerimiento'])->first();

			switch ($request['new_tablero']) {
			case 'registrada':
				if (($requerimiento->presupuesto_id == null)) {
					$requerimiento->etapa_requerimiento_id = 1;
					$completado = true;
				} else {
					if ($requerimiento->etapa_requerimiento_id > 1) {
						$mensaje = 'Requerimiento ya tiene Cotización Asociada';
						return Response()->json(array('message' => $mensaje), 404);
					} else {
						$mensaje = 'No puede cambiar de la etapa ' . strtoupper($request['old_tablero']) . ' a la etapa ' . strtoupper($request['new_tablero']) . ' por falta de documentos';
						return Response()->json(array('message' => $mensaje), 404);
					}
				}
				break;
			case 'cotizada':
				if (($requerimiento->presupuesto_id != null) && ($requerimiento->orden_trabajo_id == null) && ($requerimiento->orden_laboratorio_id == null)) {
					$requerimiento->etapa_requerimiento_id = 2;
					$completado = true;
				} else {
					if ($request['old_tablero'] == "registrada") {
						$mensaje = 'Requerimiento no posee Cotización Asociada';
						return Response()->json(array('message' => $mensaje), 404);
					} elseif ($requerimiento->etapa_requerimiento_id > 3) {
						$mensaje = 'No puede cambiar de la etapa ' . strtoupper($request['old_tablero']) . ' a la etapa ' . strtoupper($request['new_tablero']) . ' ';
						return Response()->json(array('message' => $mensaje), 404);
					}
				}
				break;

			case 'aprobada':
				if (($requerimiento->presupuesto_id != null) && ($requerimiento->orden_trabajo_id == null) && ($requerimiento->orden_laboratorio_id == null)) {
					$requerimiento->etapa_requerimiento_id = 3;
					$completado = true;
				} else {

					if ($requerimiento->etapa_requerimiento_id < 2) {
						$mensaje = 'Requerimiento no tiene Orden de Trabajo Asociada';
						return Response()->json(array('message' => $mensaje), 404);
					} elseif ($requerimiento->etapa_requerimiento_id > 4) {
						$mensaje = 'No puede cambiar de la etapa ' . strtoupper($request['old_tablero']) . ' a la etapa ' . strtoupper($request['new_tablero']) . ' ';
						return Response()->json(array('message' => $mensaje), 404);
					} elseif ($request['old_tablero'] == 'muestra') {
						$mensaje = 'Requerimiento ya tiene una Orden de Trabajo Activa';
						return Response()->json(array('message' => $mensaje), 404);
					}

				}

				break;
			case 'muestra':
				if (($requerimiento->presupuesto_id != null) && ($requerimiento->orden_trabajo_id != null) && ($requerimiento->orden_laboratorio_id == null)) {
					$requerimiento->etapa_requerimiento_id = 4;
					$completado = true;

				} else {
					if ($requerimiento->etapa_requerimiento_id < 3) {
						$mensaje = 'Requerimiento no tiene Orden de Trabajo Asociada';
						return Response()->json(array('message' => $mensaje), 404);
					} elseif ($requerimiento->etapa_requerimiento_id > 4) {
						$mensaje = 'No puede cambiar de la etapa ' . strtoupper($request['old_tablero']) . ' a la etapa ' . strtoupper($request['new_tablero']) . ' ';
						return Response()->json(array('message' => $mensaje), 404);
					}
				}
				break;
			case 'enviada_laboratorio':
				if (($requerimiento->presupuesto_id != null) && ($requerimiento->orden_trabajo_id != null) && ($requerimiento->orden_laboratorio_id != null)) {
					$requerimiento->etapa_requerimiento_id = 5;
					$completado = true;
				} else {
					if ($requerimiento->etapa_requerimiento_id < 5) {
						$mensaje = 'Requerimiento no tiene Orden de Laboratorio Asociada';
						return Response()->json(array('message' => $mensaje), 404);
					} elseif ($requerimiento->etapa_requerimiento_id > 6) {
						$mensaje = 'No puede cambiar de la etapa ' . strtoupper($request['old_tablero']) . ' a la etapa ' . strtoupper($request['new_tablero']) . ' ';
						return Response()->json(array('message' => $mensaje), 404);
					}
				}
				break;
			case 'informes_recibidos':
				if (($requerimiento->presupuesto_id != null) && ($requerimiento->orden_trabajo_id != null) && ($requerimiento->orden_laboratorio_id != null)) {
					$requerimiento->etapa_requerimiento_id = 6;
					$completado = true;
				} else {
					$mensaje = 'No puede cambiar de la etapa ' . strtoupper($request['old_tablero']) . ' a la etapa ' . strtoupper($request['new_tablero']) . ' por falta de documentos';
					return Response()->json(array('message' => $mensaje), 404);
				}
				break;

			default:
				return Response()->json(array('message' => 'Error Inesperado...'), 401);
			}

			if ($completado = true) {

				$requerimiento->save();

				DB::commit();

				$data = $this->updateMontos($request['old_tablero'], $request['new_tablero'], $requerimiento->id);

				return response()->json($data);
			}

		} catch (\Exception $e) {
			//dd($e);
			DB::rollback();
			return $e;
		}
	}

	function updateMontos($old_tablero, $new_tablero, $id) {
		$data = array();
		$old_etapa = EtapaRequerimiento::where('nombre', 'like', '%' . $old_tablero . '%')->first();
		$new_etapa = EtapaRequerimiento::where('nombre', 'like', '%' . $new_tablero . '%')->first();

		$start_requerimientos = Requerimiento::where('etapa_requerimiento_id', $old_etapa->id)->get();
		$receive_requerimientos = Requerimiento::where('etapa_requerimiento_id', $new_etapa->id)->get();

		$total_start = 0;
		$total_receive = 0;

		$requerimiento = Requerimiento::where('id', $id)->first();

		foreach ($start_requerimientos as $start) {
			$total_start = $total_start + $start->monto;
		}

		foreach ($receive_requerimientos as $receive) {
			$total_receive = $total_receive + $receive->monto;
		}

		$data = [
			'total_start' => $total_start,
			'total_receive' => $total_receive,
			'old_tablero' => $old_tablero,
			'new_tablero' => $new_tablero,
			'requerimiento' => $requerimiento->orden_trabajo_id,
		];

		return $data;

	}

	public function listarDashboard() {
		$empresaUser = User::find(Auth::id())->empresas()->first();

		if ($empresaUser != null) {
			if (auth()->user()->hasRole('administrator')) {
				$requerimientos = Requerimiento::orderBy('id', 'desc')->get();

			} else {
				$requerimientos = Requerimiento::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();
			}

			return view('backend.requerimientos.lista', compact('requerimientos'));

		} else {
			return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
		}
	}

	public function cargarData(Request $request) {
		$empresaUser = User::find(Auth::id())->empresas()->first();

		$data = ListadoRequerimiento::where('empresa_id', '=', $empresaUser->id)
			->orderBy('requerimiento', 'desc')
			->get();

		return DataTables::of($data)->make(true);
		//return response()->json($clientes);

	}

	public function guardarData(Request $request) {

		//$datos = $request->data;

		//foreach ($datos as $key => $data) {
		//	$id = $key;
		//	//$contenido = $data['telefono'];
		//	foreach ($data as $clave => $value) {
		//		$campo = $clave;
		//		$contenido = $value;
		//	}
		//}

		ListadoRequerimiento::where('requerimiento', '=', $request->requerimiento)->update(['fecha_muestreo' => $request->fecha_muestreo, 'numero_muestra' => $request->numero_muestra, 'factura_laboratorio' => $request->factura_laboratorio, 'informe_recibido' => $request->informe_recibido, 'servicio_facturado' => $request->servicio_facturado]);

		$empresaUser = User::find(Auth::id())->empresas()->first();

		$data = ListadoRequerimiento::where('empresa_id', '=', $empresaUser->id)
			->orderBy('requerimiento', 'desc')
			->get();

		return DataTables::of($data)->make(true);
		//return response()->json($clientes);

	}

}
