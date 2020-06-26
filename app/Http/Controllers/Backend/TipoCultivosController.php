<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TipoCultivo\ManageTipoCultivoRequest;
use App\Http\Requests\Backend\TipoCultivo\StoreTipoCultivoRequest;
use App\Http\Requests\Backend\TipoCultivo\UpdateTipoCultivoRequest;
use App\Models\Empresa;
use App\Models\TipoCultivo;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipoCultivosController extends Controller
{


     public function index()
    {
        $empresaUser = Auth::user()->empresaUser();
        if ($empresaUser != null) {
            if (auth()->user()->hasRole('administrator')) {

                $tipoCultivos = TipoCultivo::orderBy('id','desc')->get();

            } else {

                $tipoCultivos = TipoCultivo::where('empresa_id', $empresaUser->id)
                    ->orWhere('empresa_id', null)->orderBy('id','desc')->get();

            }

            return view('backend.tipo_cultivos.index', compact('tipoCultivos'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }

    }

    public function create(ManageTipoCultivoRequest $request)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.tipo_cultivos.create', compact('empresas'));

    }

    public function store(StoreTipoCultivoRequest $request)
    {
        try {
            DB::beginTransaction();

            $tipoCultivo         = new TipoCultivo();
            $tipoCultivo->nombre = $request->input('nombre');
            $tipoCultivo->estado = $request->input('estado');
        
            if (auth()->user()->hasRole('administrator')) {

                $tipoCultivo->empresa_id = $request->input('empresa_id');
               

            } else {

                $empresaUser             = Auth::user()->empresaUser();
                $tipoCultivo->empresa_id = $empresaUser->id;
        
            }

            $tipoCultivo->save();
            DB::commit();
            return redirect()->route('admin.tipo_cultivos.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.tipo_cultivos.index')->withFlashSuccess('Error Inesperado');
        }
    }

    /**
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     */
    public function edit(ManageTipoCultivoRequest $request, TipoCultivo $tipoCultivo)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.tipo_cultivos.edit')->with(compact('tipoCultivo', 'empresas'));
    }

    public function update(UpdateTipoCultivoRequest $request, TipoCultivo $tipoCultivo)
    {
        try {
            DB::beginTransaction();
            $tipoCultivo->nombre = $request->input('nombre');
            $tipoCultivo->estado = $request->input('estado');
            if (auth()->user()->hasRole('administrator')) {

                $tipoCultivo->empresa_id = $request->input('empresa_id');
                

            } else {

                $empresaUser             = Auth::user()->empresaUser();
                $tipoCultivo->empresa_id = $empresaUser->id;
                
            }
            $tipoCultivo->save();
            DB::commit();
            return redirect()->route('admin.tipo_cultivos.index')->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {


            DB::rollback();

            return redirect()->route('admin.tipo_cultivos.index')->withFlashSuccess('Error Inesperado');
        }

    }

    public function show(ManageTipoCultivoRequest $request, TipoCultivo $tipoCultivo)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.tipo_cultivos.show')->with(compact('tipoCultivo', 'empresas'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageTipoCultivoRequest $request, TipoCultivo $tipoCultivo)
    {
        try {
            DB::beginTransaction();
            $tipoCultivo->delete();
            DB::commit();
            return redirect()->route('admin.tipo_cultivos.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.tipo_cultivos.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }

}
