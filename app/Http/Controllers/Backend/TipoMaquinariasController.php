<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TipoMaquinaria\ManageTipoMaquinariaRequest;
use App\Http\Requests\Backend\TipoMaquinaria\StoreTipoMaquinariaRequest;
use App\Http\Requests\Backend\TipoMaquinaria\UpdateTipoMaquinariaRequest;
use App\Models\Empresa;
use App\Models\TipoMaquinaria;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipoMaquinariasController extends Controller
{
    public function index()
    {
        $empresaUser = Auth::user()->empresaUser();
        if ($empresaUser != null) {
            if (auth()->user()->hasRole('administrator')) {

                $tipoMaquinarias = TipoMaquinaria::orderBy('id','desc')->get();

            } else {


                $tipoMaquinarias = TipoMaquinaria::where('empresa_id', $empresaUser->id)
                    ->orWhere('empresa_id', null)->orderBy('id','desc')->get();

            }

            return view('backend.tipo_maquinarias.index', compact('tipoMaquinarias'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }

    }

    public function create(ManageTipoMaquinariaRequest $request)
    {

        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.tipo_maquinarias.create', compact('empresas'));

    }

    public function store(StoreTipoMaquinariaRequest $request)
    {
        try {
            DB::beginTransaction();
            $tipoMaquinaria          = new TipoMaquinaria();
            $tipoMaquinaria->nombre  = $request->input('nombre');
            
            if (auth()->user()->hasRole('administrator')) {
                $tipoMaquinaria->empresa_id = $request->input('empresa_id');
                

            } else {
                //if ($request->input('sistema') == null) {
                    $empresaUser                = Auth::user()->empresaUser();
                    $tipoMaquinaria->empresa_id = $empresaUser->id;
                    //$tipoMaquinaria->sistema    = null;
                //}

            }

            $tipoMaquinaria->save();
            DB::commit();
            return redirect()->route('admin.tipo_maquinarias.index')->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.tipo_maquinarias.index')->withFlashSuccess('Error Inesperado');
        }
    }

    /**
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     */
    public function edit(ManageTipoMaquinariaRequest $request, TipoMaquinaria $tipoMaquinaria)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.tipo_maquinarias.edit')->with(compact('tipoMaquinaria', 'empresas'));
    }

    public function update(UpdateTipoMaquinariaRequest $request, TipoMaquinaria $tipoMaquinaria)
    {
         try {
            DB::beginTransaction();
            $tipoMaquinaria->nombre  = $request->input('nombre');
            
            if (auth()->user()->hasRole('administrator')) {
                $tipoMaquinaria->empresa_id = $request->input('empresa_id');
                

            } else {
                    $empresaUser                = Auth::user()->empresaUser();
                    $tipoMaquinaria->empresa_id = $empresaUser->id;
                    

            }

            $tipoMaquinaria->save();
            DB::commit();
            return redirect()->route('admin.tipo_maquinarias.index')->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.tipo_maquinarias.index')->withFlashSuccess('Error Inesperado');
        }

    }

    public function show(ManageTipoMaquinariaRequest $request, TipoMaquinaria $tipoMaquinaria)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.tipo_maquinarias.show')->with(compact('tipoMaquinaria', 'empresas'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageTipoMaquinariaRequest $request, TipoMaquinaria $tipoMaquinaria)
    {
        try {
            DB::beginTransaction();
            $tipoMaquinaria->delete();
            DB::commit();
            return redirect()->route('admin.tipo_maquinarias.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.tipo_maquinarias.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }

}
