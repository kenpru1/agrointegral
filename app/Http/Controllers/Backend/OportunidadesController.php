<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Oportunidad\ManageOportunidadRequest;
use App\Http\Requests\Backend\Oportunidad\StoreOportunidadRequest;
use App\Http\Requests\Backend\Oportunidad\UpdateOportunidadRequest;
use App\Models\Oportunidad;
use App\Models\EstadoOportunidad;
use App\Models\EtapaOportunidad;
use App\Models\ClienteProveedor;
use App\Models\EmpresaContacto;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class OportunidadesController extends Controller
{
    public function index()
    {
    	$empresaUser = User::find(Auth::id())->empresas()->first();

        if ($empresaUser != null) 
        {
            if (auth()->user()->hasRole('administrator')) 
            {
                $oportunidades = Oportunidad::orderBy('id','desc')->get();
            } 
            else 
            {
                $oportunidades = Oportunidad::where('empresa_id', $empresaUser->id)->orderBy('id','desc')->get();
            }

            return view('backend.oportunidades.index', compact('oportunidades'));

        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function create(ManageOportunidadRequest $request)
    {
    	$empresaUser = User::find(Auth::id())->empresas()->first();

    	$cliProvs = ClienteProveedor::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

    	$estados = EstadoOportunidad::orderBy('id', 'asc')->pluck('nombre', 'id');

    	return view('backend.oportunidades.create', compact('cliProvs', 'estados'));
    }

    public function store(StoreOportunidadRequest $request)
    {
    	try 
    	{
    		DB::beginTransaction();

    		$empresaUser = User::find(Auth::id())->empresas()->first();

    		$oportunidad = new Oportunidad();
    		$oportunidad->empresa_id = $empresaUser->id;
    		$oportunidad->cliente_proveedor_id = $request->input('cliente_proveedor_id');
    		$oportunidad->empresa_contacto_id = $request->input('empresa_contacto_id');
    		$oportunidad->titulo = $request->input('titulo');
    		$oportunidad->monto = $request->input('monto');
    		$oportunidad->fecha_cierre = $request->input('fecha_cierre');
    		$oportunidad->estado_oportunidad_id = $request->input('estado_oportunidad_id');
    		$oportunidad->etapa_oportunidad_id = 1;
    		$oportunidad->save();

    		DB::commit();

            return redirect()->route('admin.oportunidades.index')->withFlashSuccess('Registro creado con éxito');

    	} 
    	catch (\Exception $e) 
    	{
    		DB::rollback();

            return redirect()->route('admin.oportunidades.index')->withFlashSuccess('Error Inesperado');
    	}
    }

    public function edit(ManageOportunidadRequest $request, Oportunidad $oportunidad)
    {
    	$empresaUser = User::find(Auth::id())->empresas()->first();

    	$cliProvs = ClienteProveedor::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

    	$otrosContactos = EmpresaContacto::where('cliente_proveedor_id', $oportunidad->cliente_proveedor_id)->whereNotIn('id', [$oportunidad->empresa_contacto_id])->get();

    	$estados = EstadoOportunidad::orderBy('id', 'asc')->pluck('nombre', 'id');

    	return view('backend.oportunidades.edit', compact('cliProvs', 'otrosContactos', 'estados', 'oportunidad'));
    }

    public function update(UpdateOportunidadRequest $request, Oportunidad $oportunidad)
    {
    	try 
    	{
    		DB::beginTransaction();

    		$empresaUser = User::find(Auth::id())->empresas()->first();

    		//dd($request);

    		$oportunidad->empresa_id = $empresaUser->id;
    		$oportunidad->cliente_proveedor_id = $request->input('cliente_proveedor_id');
    		$oportunidad->empresa_contacto_id = $request->input('empresa_contacto_id');
    		$oportunidad->titulo = $request->input('titulo');
    		$oportunidad->monto = $request->input('monto');
    		$oportunidad->fecha_cierre = $request->input('fecha_cierre');
    		$oportunidad->estado_oportunidad_id = $request->input('estado_oportunidad_id');
    		//$oportunidad->etapa_oportunidad_id = $request->input('etapa_oportunidad_id');
    		$oportunidad->save();

    		DB::commit();

            return redirect()->route('admin.oportunidades.index')->withFlashSuccess('Registro editado con éxito');

    	} 
    	catch (\Exception $e) 
    	{
    		DB::rollback();

            return redirect()->route('admin.oportunidades.index')->withFlashSuccess('Error Inesperado');
    	}
    }

    public function show(ManageOportunidadRequest $request, Oportunidad $oportunidad)
    {
    	$empresaUser = User::find(Auth::id())->empresas()->first();

    	$cliProvs = ClienteProveedor::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

    	$contactos = $empresaUser->empresaContacto->pluck('nombres', 'id');

    	$estados = EstadoOportunidad::orderBy('id', 'asc')->pluck('nombre', 'id');

    	return view('backend.oportunidades.show', compact('cliProvs', 'contactos', 'estados', 'oportunidad'));
    }

    public function destroy(ManageOportunidadRequest $request, Oportunidad $oportunidad)
    {
    	try 
    	{
            DB::beginTransaction();
            $oportunidad->delete();            
            DB::commit();
            
            return redirect()->route('admin.oportunidades.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            return redirect()->route('admin.oportunidades.index')->withFlashSuccess('Error Inesperado');
    	}
    }

    public function getContactos(Request $request)
    {
    	try 
    	{
            $contactos = EmpresaContacto::where('cliente_proveedor_id', $request['cliente_proveedor_id'])->get();

            return response()->json($contactos);
        } 
        catch (\Exception $e) 
        {
            return response()->json('Error Inesperado', 404);
        }
    }

    public function tablero()
    {
    	$empresaUser = User::find(Auth::id())->empresas()->first();

        if ($empresaUser != null) 
        {
            if (auth()->user()->hasRole('administrator')) 
            {
                $oportunidades = Oportunidad::orderBy('id','desc')->get();

                $registradas = Oportunidad::where('etapa_oportunidad_id', 1)->orderBy('id','desc')->get();

                $establecidos = Oportunidad::where('etapa_oportunidad_id', 2)->orderBy('id','desc')->get();

                $clientespos = Oportunidad::where('etapa_oportunidad_id', 3)->orderBy('id','desc')->get();

                $presupuestadas = Oportunidad::where('etapa_oportunidad_id', 4)->orderBy('id','desc')->get();

                $negociaciones = Oportunidad::where('etapa_oportunidad_id', 5)->orderBy('id','desc')->get();

                $aprobadas = Oportunidad::where('etapa_oportunidad_id', 6)->orderBy('id','desc')->get();
            } 
            else 
            {
            	$oportunidades = Oportunidad::where('empresa_id', $empresaUser->id)->orderBy('id','desc')->get();

                $registradas = Oportunidad::where('empresa_id', $empresaUser->id)
                ->where('etapa_oportunidad_id', 1)->orderBy('id','desc')->get();

                $establecidos = Oportunidad::where('empresa_id', $empresaUser->id)
                ->where('etapa_oportunidad_id', 2)->orderBy('id','desc')->get();

                $clientespos = Oportunidad::where('empresa_id', $empresaUser->id)
                ->where('etapa_oportunidad_id', 3)->orderBy('id','desc')->get();

                $presupuestadas = Oportunidad::where('empresa_id', $empresaUser->id)
                ->where('etapa_oportunidad_id', 4)->orderBy('id','desc')->get();

                $negociaciones = Oportunidad::where('empresa_id', $empresaUser->id)
                ->where('etapa_oportunidad_id', 5)->orderBy('id','desc')->get();

                $aprobadas = Oportunidad::where('empresa_id', $empresaUser->id)
                ->where('etapa_oportunidad_id', 6)->orderBy('id','desc')->get();

                //dd($establecidos);
            }

            return view('backend.oportunidades.tablero', compact('oportunidades', 'registradas', 'establecidos', 'clientespos', 'presupuestadas', 'negociaciones', 'aprobadas'));

        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
   
    }

    public function perdida(Request $request, Oportunidad $oportunidad)
    {
    	try 
    	{
    		DB::beginTransaction();

    		$oportunidad->etapa_oportunidad_id = 7;
    		$oportunidad->motivo_perdida = $request->motivo_perdida;
    		$oportunidad->save();

    		DB::commit();

    		return redirect()->route('admin.oportunidades.tablero')->withFlashSuccess('La oportunidad se ha perdido'); 
    	} 
    	catch (\Exception $e) 
    	{
    		DB::rollback();
            return redirect()->route('admin.oportunidades.tablero')->withFlashDanger('Error Inesperado');
    	}
    }

    public function changeToTablero(Request $request)
    {
        try 
        {
            DB::beginTransaction();
            $oportunidad = Oportunidad::where('id', $request['oportunidad'])->first();
            
            if ($request['new_tablero'] == 'registrada') 
            {
                $oportunidad->etapa_oportunidad_id = 1;    
            }
            elseif ($request['new_tablero'] == 'contacto') 
            {
                $oportunidad->etapa_oportunidad_id = 2;
            }
            elseif ($request['new_tablero'] == 'cliente')
            {
                $oportunidad->etapa_oportunidad_id = 3;
            }
            elseif ($request['new_tablero'] == 'presupuestada')
            {
                $oportunidad->etapa_oportunidad_id = 4;
            }
            elseif ($request['new_tablero'] == 'negociacion')
            {
                $oportunidad->etapa_oportunidad_id = 5;
            }
            elseif ($request['new_tablero'] == 'aprobada')
            {
                $oportunidad->etapa_oportunidad_id = 6;
            }


            $oportunidad->save();

            DB::commit();

            $data = $this->updateMontos($request['old_tablero'], $request['new_tablero']);

            return response()->json($data);
            
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            return $e;
        }
    }

    function updateMontos($old_tablero, $new_tablero)
    {
        $data = array();
        $old_etapa = EtapaOportunidad::where('nombre', 'like', '%'.$old_tablero.'%')->first();
        $new_etapa = EtapaOportunidad::where('nombre', 'like', '%'.$new_tablero.'%')->first();

        $start_oportunidades = Oportunidad::where('etapa_oportunidad_id', $old_etapa->id)->get();
        $receive_oportunidades = Oportunidad::where('etapa_oportunidad_id', $new_etapa->id)->get();

        $total_start = 0;
        $total_receive = 0;

        foreach ($start_oportunidades as $start) 
        {
            $total_start = $total_start + $start->monto;
        }

        foreach ($receive_oportunidades as $receive) 
        {
            $total_receive = $total_receive + $receive->monto;
        }

        $data = [
            'total_start' => $total_start,
            'total_receive' => $total_receive,
        ];

        return $data;

    }

}
