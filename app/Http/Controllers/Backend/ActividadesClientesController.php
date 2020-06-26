<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Actividad\StoreActividadRequest;
use App\Http\Requests\Backend\Actividad\UpdateActividadRequest;
use App\Models\Actividad;
use App\Models\Campo;
use App\Models\Cuartel;
use App\Models\Empresa;
use App\Models\Maquinaria;
use App\Models\TipoActividad;
use App\Models\Trabajador;
use App\Models\ClienteProveedor;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActividadesClientesController extends Controller
{

    public function index()
    {


        $empresaUser = Auth::user()->empresaUser();
        if (auth()->user()->hasRole('administrator')) {
         

            $actividades = Actividad::whereHas('clientes', function ($query) use ($empresaUser) {
                    $query->where('cliente_proveedor.id','!=',0);
                })->orderBy('id','desc')->get();
           

        } else {

            $actividades = Actividad::whereHas('clientes', function ($query) use ($empresaUser) {
                    $query->where('cliente_proveedor.id','!=',0);
                    $query->where('actividades.empresa_id', $empresaUser->id);
                })->orderBy('id','desc')->get();


            
        }
        return view('backend.actividades_clientes.index', compact('actividades'));
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
            $clientes       = ClienteProveedor::where('cliente',1)->orderBy('nombre_razon', 'asc')->pluck('nombre_razon', 'id');
        } else {
            $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
            $maquinarias  = Maquinaria::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
            $clientes       = ClienteProveedor::where('empresa_id',$empresaUser->id)->where('cliente',1)->orderBy('nombre_razon', 'asc')->pluck('nombre_razon', 'id');

        }

        return view('backend.actividades_clientes.create', compact('trabajadores', 'tipoActividades', 'maquinarias', 'clientes', 'empresas'));
    }

    public function store(StoreActividadRequest $request)
    {
        try {
            DB::beginTransaction();

            $empresaUser = Auth::user()->empresaUser();

            $trabajadores    = $request->input('trabajadores_array');
            $tipoActividades = $request->input('tipo_actividades_array');
            $maquinarias     = $request->input('maquinarias_array');
            $clientes       = $request->input('clientes_array');

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

             if ($clientes != null) {
                foreach ($clientes as $cliente) {

                    $actividad->clientes()->attach($actividad->id, ['cliente_id' => $cliente]);
                }
            }

           

           
            DB::commit();
            return redirect()->route('admin.actividades_clientes.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.actividades_clientes.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function edit(Actividad $actividad)
    {
        $empresaUser = Auth::user()->empresaUser();
        $empresas    = "";
        if (auth()->user()->hasRole('administrator')) {
            $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        }

     
        /**********Enviar todos los Cuarteles excepto los ya asignados**********/
        $actCli = $actividad->clientes()->get();
        $cuaCli=array();
        foreach ($actCli as $value) {
            $cuaCli[] = $value->id;

        }

        $clientes = ClienteProveedor::where('empresa_id', $actividad->empresa->id)
            ->whereNotIn('id', $cuaCli)
            ->orderBy('nombre_razon', 'asc')
            ->pluck('nombre_razon', 'id');
        /**********Enviar todos los Cuarteles excepto los ya asignados**********/




        /**********Enviar todos los Trabajadores excepto los ya asignados**********/
        $actTrab = $actividad->trabajadores()->get();
        $trabEx=array();
        foreach ($actTrab as $value) {
            $trabEx[] = $value->id;

        }

        $trabajadores = Trabajador::where('empresa_id', $actividad->empresa->id)->whereNotIn('id', $trabEx)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        /**********Enviar todos los Trabajadores excepto los ya asignados**********/

        /**********Enviar todos los Tipo Actividades excepto los ya asignados**********/
        $actTipAct = $actividad->tipoActividades()->get();
        $tipActEx=array();
        foreach ($actTipAct as $value) {
            $tipActEx[] = $value->id;

        }

        $tipoActividades = TipoActividad::where('empresa_id', $actividad->empresa->id)
            ->orWhere('empresa_id', null)
            ->whereNotIn('id', $tipActEx)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        /**********Enviar todos los Tipo Actividades excepto los ya asignados**********/

        /**********Enviar todos los Maquinarias excepto los ya asignados**********/
        $actMaq = $actividad->maquinarias()->get();
        $maqEx=array();
        foreach ($actMaq as $value) {
            $maqEx[] = $value->id;

        }

        $maquinarias = Maquinaria::where('empresa_id', $actividad->empresa->id)
            ->whereNotIn('id', $maqEx)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        /**********Enviar todos los Maquinarias excepto los ya asignados**********/

        return view('backend.actividades_clientes.edit', compact('trabajadores', 'tipoActividades', 'maquinarias', 'empresas', 'actividad', 'clientes'));
    }

    public function update(UpdateActividadRequest $request, Actividad $actividad)
    {

        try {
            DB::beginTransaction();

            $empresaUser = Auth::user()->empresaUser();

            $trabajadores    = $request->input('trabajadores_array');
            $tipoActividades = $request->input('tipo_actividades_array');
            $maquinarias     = $request->input('maquinarias_array');
            $clientes       = $request->input('clientes_array');

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

            DB::table('actividad_cliente')->where('actividad_id', $actividad->id)->delete();



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

            
            if ($clientes != null) {
                foreach ($clientes as $cliente) {

                    $actividad->clientes()->attach($actividad->id, ['cliente_id' => $cliente]);
                }
            }
            DB::commit();
            return redirect()->route('admin.actividades_clientes.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
            
            DB::rollback();

            return redirect()->route('admin.actividades_clientes.index')->withFlashSuccess('Error Inesperado');
        }

    }

    public function show(Actividad $actividad)
    {
        $empresaUser = Auth::user()->empresaUser();
        $empresas    = "";
        if (auth()->user()->hasRole('administrator')) {
            $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        }

     
        /**********Enviar todos los Cuarteles excepto los ya asignados**********/
        $actCli = $actividad->clientes()->get();
        $cuaCli=array();
        foreach ($actCli as $value) {
            $cuaCli[] = $value->id;

        }

        $clientes = ClienteProveedor::where('empresa_id', $actividad->empresa->id)
            ->whereNotIn('id', $cuaCli)
            ->orderBy('nombre_razon', 'asc')
            ->pluck('nombre_razon', 'id');
        /**********Enviar todos los Cuarteles excepto los ya asignados**********/




        /**********Enviar todos los Trabajadores excepto los ya asignados**********/
        $actTrab = $actividad->trabajadores()->get();
        $trabEx=array();
        foreach ($actTrab as $value) {
            $trabEx[] = $value->id;

        }

        $trabajadores = Trabajador::where('empresa_id', $actividad->empresa->id)->whereNotIn('id', $trabEx)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        /**********Enviar todos los Trabajadores excepto los ya asignados**********/

        /**********Enviar todos los Tipo Actividades excepto los ya asignados**********/
        $tipActEx=array();
        $actTipAct = $actividad->tipoActividades()->get();

        foreach ($actTipAct as $value) {
            $tipActEx[] = $value->id;

        }

        $tipoActividades = TipoActividad::where('empresa_id', $actividad->empresa->id)
            ->orWhere('empresa_id', null)
            ->whereNotIn('id', $tipActEx)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        /**********Enviar todos los Tipo Actividades excepto los ya asignados**********/

        /**********Enviar todos los Maquinarias excepto los ya asignados**********/
        $actMaq = $actividad->maquinarias()->get();
        $maqEx=array();
        foreach ($actMaq as $value) {
            $maqEx[] = $value->id;

        }

        $maquinarias = Maquinaria::where('empresa_id', $actividad->empresa->id)
            ->whereNotIn('id', $maqEx)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        /**********Enviar todos los Maquinarias excepto los ya asignados**********/

        return view('backend.actividades_clientes.show', compact('trabajadores', 'tipoActividades', 'maquinarias', 'empresas', 'actividad', 'clientes'));
    }

    public function destroy(Actividad $actividad)
    {
        try {
            DB::beginTransaction();
            $actividad->delete();
            DB::commit();
            return redirect()->route('admin.actividades_clientes.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.actividades_clientes.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        
        }

    }

 
    public function getClientes(Request $request)
    {
        try {

            $clientes = ClienteProveedor::where('empresa_id', $request['empresa_id'])->get();
            return response()->json($clientes);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }

    public function getTrabajadores(Request $request)
    {
        try {

            $trabajadores = Trabajador::where('empresa_id', $request['empresa_id'])->get();
            return response()->json($trabajadores);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }

    public function getTipoActividades(Request $request)
    {
        try {

            $tipoActividades = TipoActividad::where('empresa_id', $request['empresa_id'])->orWhere('empresa_id', null)->get();
            return response()->json($tipoActividades);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }


    public function getMaquinarias(Request $request)
    {
        try {

            $maquinarias = Maquinaria::where('empresa_id', $request['empresa_id'])->orWhere('empresa_id', null)->get();
            return response()->json($maquinarias);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }
}
