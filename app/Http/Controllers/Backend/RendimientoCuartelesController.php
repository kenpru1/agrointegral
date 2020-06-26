<?php

namespace App\Http\Controllers\Backend;

use App\Models\Campo;
use App\Models\Cuartel;
use App\Models\Auth\User;
use App\Models\RendimientoCuartel;
use App\Http\Requests\Backend\RendimientoCuartel\ManageRendimientoCuartelRequest;
use App\Http\Requests\Backend\RendimientoCuartel\StoreRendimientoCuartelRequest;
use App\Http\Requests\Backend\RendimientoCuartel\UpdateRendimientoCuartelRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class RendimientoCuartelesController extends Controller
{
    public function index()
    {
    	$empresaUser = User::find(Auth::id())->empresas()->first();

        if ($empresaUser != null) 
        {
            //Si el usuario es administrador puede ver todos los rendimientos
            if (auth()->user()->hasRole('administrator')) 
            {
                $rendimientos = RendimientoCuartel::orderBy('id','desc')->get();
            } 
            else 
            {
                $rendimientos = RendimientoCuartel::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();
            }      

            return view('backend.rendimientos_cuarteles.index', compact('rendimientos'));
        } 
        else 
        {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function create(ManageRendimientoCuartelRequest $request)
    {
    	$empresaUser = User::find(Auth::id())->empresas()->first();
    	
    	$cuarteles = $empresaUser->empresaCuarteles->pluck('nombre', 'id');

    	//dd($cuarteles);

    	return view('backend.rendimientos_cuarteles.create', compact('cuarteles'));
    }

    public function store(StoreRendimientoCuartelRequest $request)
    {
    	try 
    	{
    		DB::beginTransaction();

    		$toneladas_brutas = $request->produccion + $request->descarte_bruto;
    		$total_produccion = $request->exportacion + $request->descarte_produccion;
    		$empresaUser = User::find(Auth::id())->empresas()->first();

    		$rendimiento = new RendimientoCuartel();
    		$rendimiento->cuartel_id = $request->input('cuartel_id');
    		$rendimiento->empresa_id = $empresaUser->id;
    		$rendimiento->fecha_año = $request->input('fecha_año');

    		//la suma de produccion y descarte_bruto debe ser igual a toneladas_brutas

    		if ($request->toneladas_brutas != $toneladas_brutas) 
    		{
    			return redirect()->route('admin.rendimientos.create')->withFlashDanger('Los campos Producción y Descarte Bruto deben sumar Toneladas Brutas')->withInput();
    		}
    		else
    		{
    			$rendimiento->toneladas_brutas = $request->input('toneladas_brutas');
    			$rendimiento->produccion = $request->input('produccion');
    			$rendimiento->descarte_bruto = $request->input('descarte_bruto');
    		}

    		//la suma de exportacion y descarte_produccion debe ser igual a total_produccion
    		
    		if ($total_produccion != $request->total_produccion) 
    		{
    			return redirect()->route('admin.rendimientos.create')->withFlashDanger('Los campos Exportación y Descarte Producción deben sumar Total Producción')->withInput();
    		}
    		else
    		{
    			$rendimiento->total_produccion = $request->input('total_produccion');
    			$rendimiento->exportacion = $request->input('exportacion');
    			$rendimiento->descarte_produccion = $request->input('descarte_produccion');
    		}

    		$rendimiento->save();

    		DB::commit();

    		return redirect()->route('admin.rendimientos.index')->withFlashSuccess('Registro creado con éxito');
    	} 
    	catch (Exception $e) 
    	{
    		dd($e);
            DB::rollback();

            return redirect()->route('admin.rendimientos.index')->withFlashSuccess('Error Inesperado');	
    	}	
    }

    public function edit(ManageRendimientoCuartelRequest $request, RendimientoCuartel $rendimiento)
    {
    	$empresaUser = User::find(Auth::id())->empresas()->first();
    	
    	$cuarteles = $empresaUser->empresaCuarteles->pluck('nombre', 'id');

    	return view('backend.rendimientos_cuarteles.edit', compact('rendimiento', 'cuarteles'));
    }

    public function update(UpdateRendimientoCuartelRequest $request, RendimientoCuartel $rendimiento)
    {
    	try 
    	{
    		DB::beginTransaction();

    		$toneladas_brutas = $request->produccion + $request->descarte_bruto;
    		$total_produccion = $request->exportacion + $request->descarte_produccion;
    		$empresaUser = User::find(Auth::id())->empresas()->first();

    		$rendimiento->cuartel_id = $request->input('cuartel_id');
    		$rendimiento->empresa_id = $empresaUser->id;
    		$rendimiento->fecha_año = $request->input('fecha_año');

    		//la suma de produccion y descarte_bruto debe ser igual a toneladas_brutas

    		if ($request->toneladas_brutas != $toneladas_brutas) 
    		{
    			return redirect()->route('admin.rendimientos.edit', $rendimiento->id)->withFlashDanger('Los campos Producción y Descarte Bruto deben sumar Toneladas Brutas')->withInput();
    		}
    		else
    		{
    			$rendimiento->toneladas_brutas = $request->input('toneladas_brutas');
    			$rendimiento->produccion = $request->input('produccion');
    			$rendimiento->descarte_bruto = $request->input('descarte_bruto');
    		}

    		//la suma de exportacion y descarte_produccion debe ser igual a total_produccion
    		
    		if ($total_produccion != $request->total_produccion) 
    		{
    			return redirect()->route('admin.rendimientos.edit', $rendimiento->id)->withFlashDanger('Los campos Exportación y Descarte Producción deben sumar Total Producción')->withInput();
    		}
    		else
    		{
    			$rendimiento->total_produccion = $request->input('total_produccion');
    			$rendimiento->exportacion = $request->input('exportacion');
    			$rendimiento->descarte_produccion = $request->input('descarte_produccion');
    		}

    		$rendimiento->save();

    		DB::commit();

    		return redirect()->route('admin.rendimientos.index')->withFlashSuccess('Registro editado con éxito');
    	} 
    	catch (Exception $e) 
    	{
    		dd($e);
            DB::rollback();

            return redirect()->route('admin.rendimientos.index')->withFlashSuccess('Error Inesperado');	
    	}
    }

    public function show(ManageRendimientoCuartelRequest $request, RendimientoCuartel $rendimiento)
    {
    	$empresaUser = User::find(Auth::id())->empresas()->first();
    	
    	$cuarteles = $empresaUser->empresaCuarteles->pluck('nombre', 'id');

    	return view('backend.rendimientos_cuarteles.show', compact('rendimiento', 'cuarteles'));
    }

    public function destroy(RendimientoCuartel $rendimiento)
    {
        try {
            DB::beginTransaction();
            $rendimiento->delete();
            DB::commit();
            return redirect()->route('admin.rendimientos.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.rendimientos.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }
}
