<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Bodega\DestroyBodegaRequest;
use App\Http\Requests\Backend\Bodega\ManageBodegaRequest;
use App\Http\Requests\Backend\Bodega\StoreBodegaRequest;
use App\Http\Requests\Backend\Bodega\UpdateBodegaRequest;
use App\Models\Auth\User;
use App\Models\Bodega;
use App\Models\Campo;
use App\Models\Comuna;
use App\Models\Empresa;
use App\Models\Provincia;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BodegasController extends Controller
{
    public function index()
    {

        $empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) {
            //Si el usuario es administrador puede ver todos los bodegas
            if (auth()->user()->hasRole('administrator')) {

                $bodegas = Bodega::orderBy('id','desc')->get();

            } else {

                $bodegas = Bodega::where('empresa_id', $empresaUser->id)->orderBy('id','desc')->get();

            }


            return view('backend.bodegas.index', compact('bodegas'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }

    }

    public function create(ManageBodegaRequest $request)
    {

        $empresaUser = Auth::user()->empresaUser();
        $propiedad= array('0' =>'Arrendado' ,'1'=>'Propio' );

        $provincias = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        if (auth()->user()->hasRole('administrator')) {
            $campos = Campo::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        } else {
            $campos = Campo::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        }

        return view('backend.bodegas.create', compact('provincias', 'campos', 'empresas','propiedad'));

    }

    public function store(StoreBodegaRequest $request)
    {
        try {
            DB::beginTransaction();
            $empresaUser = Auth::user()->empresaUser();

            $bodega               = new Bodega();
            $bodega->nombre       = $request->input('nombre');
            $bodega->descripcion  = $request->input('descripcion');
            $bodega->propio       = $request->input('propio');
            $bodega->provincia_id = $request->input('provincia_id');
            $bodega->comuna_id    = $request->input('comuna_id');
            $bodega->campo_id     = $request->input('campo_id');
            $bodega->direccion    = $request->input('direccion');
            if (auth()->user()->hasRole('administrator')) {

                $bodega->empresa_id = $request->input('empresa_id');

            } else {

                $empresaUser        = Auth::user()->empresaUser();
                $bodega->empresa_id = $empresaUser->id;

            }
            $bodega->save();
            DB::commit();
            return redirect()->route('admin.bodegas.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.bodegas.index')->withFlashSuccess('Error Inesperado');
        }

    }

/**
 * @param ManagePermissionRequest $request
 * @param Permission              $permission
 *
 * @return mixed
 */
    public function edit(ManageBodegaRequest $request, Bodega $bodega)
    {

        $empresaUser = Auth::user()->empresaUser();
        $provincias  = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $empresas    = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $propiedad= array('0' =>'Arrendado' ,'1'=>'Propio' );

        $comuna = Comuna::where('id', $bodega->comuna_id)->pluck('nombre', 'id');
        if (auth()->user()->hasRole('administrator')) {
            $campos = Campo::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        } else {
            $campos = Campo::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        }

        return view('backend.bodegas.edit')->with(compact('bodega', 'provincias', 'comuna', 'campos', 'empresas', 'comuna','propiedad'));
    }

    public function update(UpdateBodegaRequest $request, Bodega $bodega)
    {
        try {
            DB::beginTransaction();
            $bodega->nombre       = $request->input('nombre');
            $bodega->descripcion  = $request->input('descripcion');
            $bodega->propio       = $request->input('propio');
            $bodega->provincia_id = $request->input('provincia_id');
            $bodega->comuna_id    = $request->input('comuna_id');
            $bodega->campo_id     = $request->input('campo_id');
            $bodega->direccion    = $request->input('direccion');
            if (auth()->user()->hasRole('administrator')) {

                $bodega->empresa_id = $request->input('empresa_id');

            } else {

                $empresaUser        = Auth::user()->empresaUser();
                $bodega->empresa_id = $empresaUser->id;

            }
            $bodega->save();
            DB::commit();
            return redirect()->route('admin.bodegas.index')->withFlashSuccess('Registro modificado con éxito');

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.bodegas.index')->withFlashSuccess('Error Inesperado');
        }

    }

    public function show(ManageBodegaRequest $request, Bodega $bodega)
    {

        $empresaUser = Auth::user()->empresaUser();
        $provincias  = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $empresas    = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $propiedad= array('0' =>'Arrendado' ,'1'=>'Propio' );

        $comuna = Comuna::where('id', $bodega->comuna_id)->pluck('nombre', 'id');
        if (auth()->user()->hasRole('administrator')) {
            $campos = Campo::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        } else {
            $campos = Campo::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        }

        return view('backend.bodegas.show')->with(compact('bodega', 'provincias', 'comuna', 'campos', 'empresas', 'comuna','propiedad'));
    }


/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Salones  $salones
 * @return \Illuminate\Http\Response
 */
    public function destroy(DestroyBodegaRequest $request, Bodega $bodega)
    {
        try {
            DB::beginTransaction();
            $bodega->delete();
            DB::commit();
            return redirect()->route('admin.bodegas.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.bodegas.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
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
