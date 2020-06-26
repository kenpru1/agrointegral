<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Cuartel\ManageCuartelRequest;
use App\Http\Requests\Backend\Cuartel\StoreCuartelRequest;
use App\Http\Requests\Backend\Cuartel\UpdateCuartelRequest;
use App\Models\Auth\User;
use App\Models\Campo;
use App\Models\Comuna;
use App\Models\Cuartel;
use App\Models\Provincia;
use App\Models\TipoCultivo;
use App\Models\Trabajador;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuartelesController extends Controller
{
    
    public function index()
    {

        $empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) {
            //Si el usuario es administrador puede ver todos los lotes
            if (auth()->user()->hasRole('administrator')) {

                $cuarteles = Cuartel::orderBy('id','desc')->get();
            } else {
                $cuarteles = Cuartel::whereHas('campo', function ($query) use ($empresaUser) {
                    $query->where('empresa_id', $empresaUser->id);
                })->orderBy('id','desc')->get();

               
            }

           

            return view('backend.cuarteles.index', compact('cuarteles'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }

    }

    public function create(ManageCuartelRequest $request)
    {

        $propio=['1'=>'Propio','0'=>'Arrendado'];
        $productivo=['1'=>'Productivo','0'=>'No Productivo'];
        $empresaUser = Auth::user()->empresaUser();

        $provincias   = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $tipoCultivos = TipoCultivo::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        
        if (auth()->user()->hasRole('administrator')) {
            $campos = Campo::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        } else {
            $campos = Campo::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        }

        

        return view('backend.cuarteles.create', compact('provincias', 'campos', 'tipoCultivos','propio','productivo'));

    }

    public function store(StoreCuartelRequest $request)
    {
        try {
            DB::beginTransaction();
            $cuartel                  = new Cuartel();
            $cuartel->nombre          = $request->input('nombre');
            $cuartel->propio          = $request->input('propio');
            $cuartel->productivo          = $request->input('productivo');
            $cuartel->provincia_id    = $request->input('provincia_id');
            $cuartel->comuna_id       = $request->input('comuna_id');
            $cuartel->campo_id        = $request->input('campo_id');
            $cuartel->tamanno         = $request->input('tamanno');
            $cuartel->tipo_cultivo_id = $request->input('tipo_cultivo_id');
            $cuartel->descripcion     = $request->input('descripcion');
            $cuartel->coordenadas     = $request->input('coordenadas');
            $cuartel->ubiq_lat     = $request->input('ubiq_lat');
            $cuartel->ubiq_lng     = $request->input('ubiq_lng');
            $cuartel->save();
            DB::commit();
            return redirect()->route('admin.cuarteles.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.cuarteles.index')->withFlashDanger('Error Inesperado Intente de Nuevo si el Error Persiste Consulte su Equipo Técnico');
        }
    }

/**
 * @param ManagePermissionRequest $request
 * @param Permission              $permission
 *
 * @return mixed
 */
    public function edit(ManageCuartelRequest $request, Cuartel $cuartel)
    {
        $propio=['1'=>'Propio','0'=>'Arrendado'];
        $productivo=['1'=>'Productivo','0'=>'No Productivo'];
        $empresaUser  = Auth::user()->empresaUser();
        $provincias   = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $tipoCultivos = TipoCultivo::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        $comuna = Comuna::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        if (auth()->user()->hasRole('administrator')) {
            $campos = Campo::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        } else {
            $campos = Campo::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        }

        return view('backend.cuarteles.edit')->with(compact('cuartel', 'provincias', 'comuna', 'campos', 'tipoCultivos','productivo','propio'));
    }

    public function update(UpdateCuartelRequest $request, Cuartel $cuartel)
    {
        try {
            DB::beginTransaction();
            $cuartel->nombre          = $request->input('nombre');
            $cuartel->propio          = $request->input('propio');
            $cuartel->productivo          = $request->input('productivo');
            $cuartel->provincia_id    = $request->input('provincia_id');
            $cuartel->comuna_id       = $request->input('comuna_id');
            $cuartel->campo_id        = $request->input('campo_id');
            $cuartel->tamanno         = $request->input('tamanno');
            $cuartel->tipo_cultivo_id = $request->input('tipo_cultivo_id');
            $cuartel->descripcion     = $request->input('descripcion');
            $cuartel->coordenadas     = $request->input('coordenadas');
            $cuartel->ubiq_lat     = $request->input('ubiq_lat');
            $cuartel->ubiq_lng     = $request->input('ubiq_lng');
            $cuartel->save();
            DB::commit();
            return redirect()->route('admin.cuarteles.index')->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.cuarteles.index')->withFlashDanger('Error Inesperado Intente de Nuevo si el Error Persiste Consulte su Equipo Técnico');
        }

    }

      public function show(ManageCuartelRequest $request, Cuartel $cuartel)
    {
        $propio=['1'=>'Propio','0'=>'Arrendado'];
        $productivo=['1'=>'Productivo','0'=>'No Productivo'];
        $empresaUser  = Auth::user()->empresaUser();
        $provincias   = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $tipoCultivos = TipoCultivo::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        $comuna = Comuna::where('id', $cuartel->comuna_id)->pluck('nombre', 'id');
        if (auth()->user()->hasRole('administrator')) {
            $campos = Campo::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        } else {
            $campos = Campo::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        }

        return view('backend.cuarteles.show')->with(compact('cuartel', 'provincias', 'comuna', 'campos', 'tipoCultivos','productivo','propio'));
    }

/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Lotes  $lotes
 * @return \Illuminate\Http\Response
 */
    public function destroy(Cuartel $cuartel)
    {
        try {
            DB::beginTransaction();
            $cuartel->delete();
            DB::commit();
            return redirect()->route('admin.cuarteles.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->route('admin.cuarteles.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }

    public function getComunas(Request $request)
    {
        try {

            $comunas = Comuna::where('provincia_id', $request['provincia_id'])->get();
            return response()->json($comunas);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }
}
