<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TipoActividad\ManageTipoActividadRequest;
use App\Http\Requests\Backend\TipoActividad\StoreTipoActividadRequest;
use App\Http\Requests\Backend\TipoActividad\UpdateTipoActividadRequest;
use App\Models\Empresa;
use App\Models\TipoActividad;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipoActividadesController extends Controller
{


     public function index()
    {
        $empresaUser = Auth::user()->empresaUser();
        if ($empresaUser != null) {
            if (auth()->user()->hasRole('administrator')) {

                $tipoActividades = TipoActividad::orderBy('id','desc')->get();

            } else {

                $tipoActividades = TipoActividad::where('empresa_id', $empresaUser->id)
                    ->orWhere('empresa_id', null)->orderBy('id','desc')->get();

            }

            return view('backend.tipo_actividades.index', compact('tipoActividades'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }

    }

    public function create(ManageTipoActividadRequest $request)
    {

        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.tipo_actividades.create', compact('empresas'));

    }

    public function store(StoreTipoActividadRequest $request)
    {
        try {
            DB::beginTransaction();

            $tipoActividad         = new TipoActividad();
            $tipoActividad->nombre = $request->input('nombre');
            
        
            if (auth()->user()->hasRole('administrator')) {

                $tipoActividad->empresa_id = $request->input('empresa_id');
               

            } else {

                $empresaUser             = Auth::user()->empresaUser();
                $tipoActividad->empresa_id = $empresaUser->id;
        
            }

            $tipoActividad->save();
            DB::commit();
            return redirect()->route('admin.tipo_actividades.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.tipo_actividades.index')->withFlashSuccess('Error Inesperado');
        }
    }

    /**
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     */
    public function edit(ManageTipoActividadRequest $request, TipoActividad $tipoActividad)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.tipo_actividades.edit')->with(compact('tipoActividad', 'empresas'));
    }

    public function update(UpdateTipoActividadRequest $request, TipoActividad $tipoActividad)
    {
        try {
            DB::beginTransaction();
            $tipoActividad->nombre = $request->input('nombre');
            
            if (auth()->user()->hasRole('administrator')) {

                $tipoActividad->empresa_id = $request->input('empresa_id');
                

            } else {

                $empresaUser             = Auth::user()->empresaUser();
                $tipoActividad->empresa_id = $empresaUser->id;
                
            }
            $tipoActividad->save();
            DB::commit();
            return redirect()->route('admin.tipo_actividades.index')->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {


            DB::rollback();

            return redirect()->route('admin.tipo_actividades.index')->withFlashSuccess('Error Inesperado');
        }

    }

    public function show(ManageTipoActividadRequest $request, TipoActividad $tipoActividad)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.tipo_actividades.show')->with(compact('tipoActividad', 'empresas'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageTipoActividadRequest $request, TipoActividad $tipoActividad)
    {
        try {
            DB::beginTransaction();
            $tipoActividad->delete();
            DB::commit();
            return redirect()->route('admin.tipo_actividades.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.tipo_actividades.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }

}
