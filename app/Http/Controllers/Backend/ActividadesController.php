<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Actividad\StoreActividadRequest;
use App\Http\Requests\Backend\Actividad\StoreGastoRequest;
use App\Http\Requests\Backend\Actividad\UpdateActividadRequest;
use App\Models\Actividad;
use App\Models\ActividadGasto;
use App\Models\Campo;
use App\Models\ClienteProveedor;
use App\Models\Cuartel;
use App\Models\Empresa;
use App\Models\FacturaRecibida;
use App\Models\Labor;
use App\Models\LaborCuartel;
use App\Models\Maquinaria;
use App\Models\TipoActividad;
use App\Models\Trabajador;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActividadesController extends Controller
{

/*************Gastos******************/

    public function nuevo_gasto(Actividad $actividad)
    {

        $empresaUser = Auth::user()->empresaUser();

        $facturado   = ['1' => 'Con Factura', '0' => 'Sin Factura'];
        $proveedores = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('proveedor', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');
        $facturas    = FacturaRecibida::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('ref', 'id');

        return view('backend.actividades_campos.nuevo_gasto', compact('actividad', 'facturado', 'proveedores', 'facturas'));

    }

    public function guardar_gasto(StoreGastoRequest $request, Actividad $actividad)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();

            $gasto                       = new ActividadGasto();
            $gasto->actividad_id         = $actividad->id;
            $gasto->nro_factura          = $request->input('nro_factura');
            $gasto->nro_comprobante      = $request->input('nro_comprobante');
            $gasto->cliente_proveedor_id = $request->input('cliente_proveedor_id');
            $gasto->fecha                = $request->input('fecha');
            $gasto->periodo              = $request->input('periodo');
            $gasto->neto                 = $request->input('neto_total');
            $gasto->iva                  = $request->input('iva_total');
            $gasto->porc_iva             = $request->input('porc_iva');
            $gasto->total                = $request->input('total_labores');
            $gasto->descripcion          = $request->input('descripcion');
            $gasto->save();

            for ($i = 0; $i < (intval($input['numero_labores'])); $i++) {

                $labor                     = new Labor();
                $labor->actividad_gasto_id = $gasto->id;
                $labor->labor              = $input['labor_array'][$i];
                $labor->neto               = $input['neto_array'][$i];
                $labor->iva                = $input['iva_array'][$i];
                $labor->total              = $input['total_tabla_array'][$i];
                $labor->save();

                //se recorren cuarteles para equivalencia con el request que llega en cuanto a labor y cuartel
                foreach ($actividad->cuarteles as $cuartel) {
                    $labCua           = new LaborCuartel();
                    $labCua->labor_id = $labor->id;
                    $idenRequest      = ($i + 1) . '-' . $cuartel->id;

                    if ($request->input($idenRequest) != null) {

                        $labCua->cuartel_id = $cuartel->id;
                        $labCua->hectareas  = $request->input($idenRequest);

                    }

                    $labCua->save();

                }

            }
            DB::commit();
            return redirect()->route('admin.actividades_campos.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->route('admin.actividades_campos.index')->withFlashSuccess('Error Inesperado');
        }

    }

    public function edit_gasto($id)
    {

        $empresaUser = Auth::user()->empresaUser();

        $facturado      = ['1' => 'Con Factura', '0' => 'Sin Factura'];
        $proveedores    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('proveedor', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');
        $facturas       = FacturaRecibida::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('ref', 'id');
        $actividadGasto = ActividadGasto::find($id);

        $actividad = Actividad::find($actividadGasto->actividad_id);

        $proveedor = ClienteProveedor::find($actividadGasto->cliente_proveedor_id);

        return view('backend.actividades_campos.edit_gasto', compact('actividadGasto', 'actividad', 'facturado', 'proveedores', 'facturas', 'proveedor'));

    }

    public function update_gasto(Request $request, ActividadGasto $gasto)
    {
        //dd($request);
        try {
            DB::beginTransaction();
            $input = $request->all();

            $gasto->nro_factura          = $request->input('nro_factura');
            $gasto->nro_comprobante      = $request->input('nro_comprobante');
            $gasto->cliente_proveedor_id = $request->input('cliente_proveedor_id');
            $gasto->fecha                = $request->input('fecha');
            $gasto->periodo              = $request->input('periodo');
            $gasto->neto                 = $request->input('neto_total');
            $gasto->iva                  = $request->input('iva_total');
            $gasto->porc_iva             = $request->input('porc_iva');
            $gasto->total                = $request->input('total_labores');
            $gasto->descripcion          = $request->input('descripcion');
            $gasto->save();

            DB::table('labores')->where('actividad_gasto_id', $gasto->id)->delete();
            for ($i = 0; $i < (intval($input['numero_labores'])); $i++) {
                if (isset($input['labor_array'][$i])) {
                    $labor                     = new Labor();
                    $labor->actividad_gasto_id = $gasto->id;
                    $labor->labor              = $input['labor_array'][$i];
                    $labor->neto               = $input['neto_array'][$i];
                    $labor->iva                = $input['iva_array'][$i];
                    $labor->total              = $input['total_tabla_array'][$i];
                    $labor->save();

                    //se recorren cuarteles para equivalencia con el request que llega en cuanto a labor y cuartel
                    foreach ($gasto->actividad->cuarteles as $cuartel) {
                        $labCua           = new LaborCuartel();
                        $labCua->labor_id = $labor->id;
                        $idenRequest      = ($i + 1) . '-' . $cuartel->id;

                        if ($request->input($idenRequest) != null) {

                            $labCua->cuartel_id = $cuartel->id;
                            $labCua->hectareas  = $request->input($idenRequest);

                        }

                        $labCua->save();

                    }
                }

            }
            DB::commit();
            return redirect()->route('admin.actividades_campos.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->route('admin.actividades_campos.index')->withFlashSuccess('Error Inesperado');
        }

    }

    

    public function show_gasto($id)
    {

        $empresaUser = Auth::user()->empresaUser();

        $facturado      = ['1' => 'Con Factura', '0' => 'Sin Factura'];
        $proveedores    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('proveedor', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');
        $facturas       = FacturaRecibida::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('ref', 'id');
        $actividadGasto = ActividadGasto::find($id);
        $actividad      = Actividad::find($actividadGasto->actividad_id);

        $proveedor = ClienteProveedor::find($actividadGasto->cliente_proveedor_id);

        return view('backend.actividades_campos.show_gasto', compact('actividadGasto', 'actividad', 'facturado', 'proveedores', 'facturas', 'proveedor'));

    }

    public function destroy_gasto(ActividadGasto $gasto)
    {
        
        try {
            DB::beginTransaction();
            $gasto->delete();
            DB::commit();
            return redirect()->route('admin.actividades_campos.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.actividades_campos.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        
        }

    }

    public function getRut(Request $request)
    {

        try {

            $proveedor = ClienteProveedor::find($request['cliente_proveedor_id']);
            return response()->json($proveedor);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }
/*************Gastos******************/

    public function index()
    {

        $empresaUser = Auth::user()->empresaUser();
        if (auth()->user()->hasRole('administrator')) {

            $actividades = Actividad::whereHas('campos', function ($query) use ($empresaUser) {
                $query->where('campos.id', '!=', 0);
            })->orderBy('id', 'desc')->get();

        } else {
            $actividades = Actividad::whereHas('campos', function ($query) use ($empresaUser) {
                $query->where('campos.id', '!=', 0)->where('actividades.empresa_id', $empresaUser->id);
            })->orderBy('id', 'desc')->get();

        }
        return view('backend.actividades_campos.index', compact('actividades'));
    }

    public function create()
    {
        $empresaUser     = Auth::user()->empresaUser();
        $tipoActividades = TipoActividad::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $empresas        = "";
        if (auth()->user()->hasRole('administrator')) {
            $empresas     = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
            $trabajadores = Trabajador::orderBy('nombre', 'asc')->pluck('nombre', 'id');
            $maquinarias  = Maquinaria::orderBy('nombre', 'asc')->pluck('nombre', 'id');
            $campos       = Campo::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        } else {
            $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
            $maquinarias  = Maquinaria::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
            $campos       = Campo::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        }

        return view('backend.actividades_campos.create', compact('trabajadores', 'tipoActividades', 'maquinarias', 'campos', 'empresas'));
    }

    public function store(StoreActividadRequest $request)
    {
        try {
            DB::beginTransaction();

            $empresaUser = Auth::user()->empresaUser();

            $trabajadores    = $request->input('trabajadores_array');
            $tipoActividades = $request->input('tipo_actividades_array');
            $maquinarias     = $request->input('maquinarias_array');
            $campos          = $request->input('campo_id');
            $cuarteles       = $request->input('cuarteles_array');

            $actividad              = new Actividad();
            $actividad->fecha       = $request->input('fecha');
            $actividad->horas       = $request->input('horas');
            $actividad->minutos     = $request->input('minutos');
            $actividad->comentarios = $request->input('comentarios');

            if (auth()->user()->hasRole('administrator')) {
                $actividad->empresa_id = $request->input('empresa_id');
            } else {
                $actividad->empresa_id = $empresaUser->id;
            }
            $actividad->save();

            if ($trabajadores != null) {
                foreach ($trabajadores as $trabajador) {

                    $actividad->trabajadores()->attach($actividad->id, ['trabajador_id' => $trabajador]);
                }
            }

            if ($tipoActividades != null) {
                foreach ($tipoActividades as $tipoActividad) {

                    $actividad->tipoActividades()->attach($actividad->id, ['tipo_actividad_id' => $tipoActividad]);
                }
            }

            if ($maquinarias != null) {
                foreach ($maquinarias as $maquinaria) {

                    $actividad->maquinarias()->attach($actividad->id, ['maquinaria_id' => $maquinaria]);
                }
            }

            if ($campos != null) {

                $actividad->campos()->attach($actividad->id, ['campo_id' => $campos]);

            }

            if ($cuarteles != null) {
                foreach ($cuarteles as $cuartel) {

                    $actividad->cuarteles()->attach($actividad->id, ['cuartel_id' => $cuartel]);
                }
            }
            DB::commit();
            return redirect()->route('admin.actividades_campos.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.actividades_campos.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function edit(Actividad $actividad)
    {
        $empresaUser = Auth::user()->empresaUser();
        $empresas    = "";
        if (auth()->user()->hasRole('administrator')) {
            $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        }

        $campos = Campo::where('empresa_id', $actividad->empresa->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        /**********Enviar todos los Cuarteles excepto los ya asignados**********/
        $actCua = $actividad->cuarteles()->get();
        $cuaEx  = array();
        foreach ($actCua as $value) {
            $cuaEx[] = $value->id;

        }

        $cuarteles = Cuartel::where('campo_id', $actividad->campos()->first()->id)
            ->whereNotIn('id', $cuaEx)
            ->orderBy('nombre', 'asc')
            ->pluck('nombre', 'id');
        /**********Enviar todos los Cuarteles excepto los ya asignados**********/

        /**********Enviar todos los Trabajadores excepto los ya asignados**********/
        $actTrab = $actividad->trabajadores()->get();
        $trabEx  = array();
        foreach ($actTrab as $value) {
            $trabEx[] = $value->id;

        }

        $trabajadores = Trabajador::where('empresa_id', $actividad->empresa->id)->whereNotIn('id', $trabEx)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        /**********Enviar todos los Trabajadores excepto los ya asignados**********/

        /**********Enviar todos los Tipo Actividades excepto los ya asignados**********/
        $actTipAct = $actividad->tipoActividades()->get();
        $tipActEx  = array();
        foreach ($actTipAct as $value) {
            $tipActEx[] = $value->id;

        }

        $tipoActividades = TipoActividad::where('empresa_id', $actividad->empresa->id)
            ->orWhere('empresa_id', null)
            ->whereNotIn('id', $tipActEx)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        /**********Enviar todos los Tipo Actividades excepto los ya asignados**********/

        /**********Enviar todos los Maquinarias excepto los ya asignados**********/
        $actMaq = $actividad->maquinarias()->get();
        $maqEx  = array();
        foreach ($actMaq as $value) {
            $maqEx[] = $value->id;

        }

        $maquinarias = Maquinaria::where('empresa_id', $actividad->empresa->id)
            ->whereNotIn('id', $maqEx)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        /**********Enviar todos los Maquinarias excepto los ya asignados**********/

        return view('backend.actividades_campos.edit', compact('trabajadores', 'tipoActividades', 'maquinarias', 'campos', 'empresas', 'actividad', 'cuarteles'));
    }

    public function update(UpdateActividadRequest $request, Actividad $actividad)
    {

        try {
            DB::beginTransaction();

            $empresaUser = Auth::user()->empresaUser();

            $trabajadores    = $request->input('trabajadores_array');
            $tipoActividades = $request->input('tipo_actividades_array');
            $maquinarias     = $request->input('maquinarias_array');
            $campos          = $request->input('campo_id');
            $cuarteles       = $request->input('cuarteles_array');

            $actividad->fecha       = $request->input('fecha');
            $actividad->horas       = $request->input('horas');
            $actividad->minutos     = $request->input('minutos');
            $actividad->comentarios = $request->input('comentarios');

            if (auth()->user()->hasRole('administrator')) {
                $actividad->empresa_id = $request->input('empresa_id');
            } else {
                $actividad->empresa_id = $empresaUser->id;
            }
            $actividad->save();

            DB::table('actividad_campo')->where('actividad_id', $actividad->id)->delete();

            DB::table('actividad_cuartel')->where('actividad_id', $actividad->id)->delete();

            DB::table('actividad_maquinaria')->where('actividad_id', $actividad->id)->delete();

            DB::table('actividad_tipo_actividad')->where('actividad_id', $actividad->id)->delete();

            DB::table('actividad_trabajador')->where('actividad_id', $actividad->id)->delete();

            if ($trabajadores != null) {
                foreach ($trabajadores as $trabajador) {

                    $actividad->trabajadores()->attach($actividad->id, ['trabajador_id' => $trabajador]);
                }
            }

            if ($tipoActividades != null) {
                foreach ($tipoActividades as $tipoActividad) {

                    $actividad->tipoActividades()->attach($actividad->id, ['tipo_actividad_id' => $tipoActividad]);
                }
            }

            if ($maquinarias != null) {
                foreach ($maquinarias as $maquinaria) {

                    $actividad->maquinarias()->attach($actividad->id, ['maquinaria_id' => $maquinaria]);
                }
            }

            if ($campos != null) {

                $actividad->campos()->attach($actividad->id, ['campo_id' => $campos]);

            }

            if ($cuarteles != null) {
                foreach ($cuarteles as $cuartel) {

                    $actividad->cuarteles()->attach($actividad->id, ['cuartel_id' => $cuartel]);
                }
            }
            DB::commit();
            return redirect()->route('admin.actividades_campos.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.actividades_campos.index')->withFlashSuccess('Error Inesperado');
        }

    }

    public function show(Actividad $actividad)
    {
        $empresaUser = Auth::user()->empresaUser();
        $empresas    = "";
        if (auth()->user()->hasRole('administrator')) {
            $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        }

        $campos = Campo::where('empresa_id', $actividad->empresa->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        /**********Enviar todos los Cuarteles excepto los ya asignados**********/
        $actCua = $actividad->cuarteles()->get();
        $cuaEx  = array();
        foreach ($actCua as $value) {
            $cuaEx[] = $value->id;

        }

        $cuarteles = Cuartel::where('campo_id', $actividad->campos()->first()->id)
            ->whereNotIn('id', $cuaEx)
            ->orderBy('nombre', 'asc')
            ->pluck('nombre', 'id');
        /**********Enviar todos los Cuarteles excepto los ya asignados**********/

        /**********Enviar todos los Trabajadores excepto los ya asignados**********/
        $actTrab = $actividad->trabajadores()->get();
        $trabEx  = array();
        foreach ($actTrab as $value) {
            $trabEx[] = $value->id;

        }

        $trabajadores = Trabajador::where('empresa_id', $actividad->empresa->id)->whereNotIn('id', $trabEx)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        /**********Enviar todos los Trabajadores excepto los ya asignados**********/

        /**********Enviar todos los Tipo Actividades excepto los ya asignados**********/
        $actTipAct = $actividad->tipoActividades()->get();
        $tipActEx  = array();
        foreach ($actTipAct as $value) {
            $tipActEx[] = $value->id;

        }

        $tipoActividades = TipoActividad::where('empresa_id', $actividad->empresa->id)
            ->orWhere('empresa_id', null)
            ->whereNotIn('id', $tipActEx)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        /**********Enviar todos los Tipo Actividades excepto los ya asignados**********/

        /**********Enviar todos los Maquinarias excepto los ya asignados**********/
        $actMaq = $actividad->maquinarias()->get();
        $maqEx  = array();
        foreach ($actMaq as $value) {
            $maqEx[] = $value->id;

        }

        $maquinarias = Maquinaria::where('empresa_id', $actividad->empresa->id)
            ->whereNotIn('id', $maqEx)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        /**********Enviar todos los Maquinarias excepto los ya asignados**********/

        return view('backend.actividades_campos.show', compact('trabajadores', 'tipoActividades', 'maquinarias', 'campos', 'empresas', 'actividad', 'cuarteles'));
    }

    public function destroy(Actividad $actividad)
    {
        try {
            DB::beginTransaction();
            $actividad->delete();
            DB::commit();
            return redirect()->route('admin.actividades_campos.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.actividades_campos.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }

    public function getCuarteles(Request $request)
    {
        try {

            $cuarteles = Cuartel::where('campo_id', $request['campo_id'])->get();
            return response()->json($cuarteles);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }

    public function getCampos(Request $request)
    {
        try {

            $campos = Campo::where('empresa_id', $request['empresa_id'])->get();
            return response()->json($campos);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }
}
