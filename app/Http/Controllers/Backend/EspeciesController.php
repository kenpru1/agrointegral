<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Especie\ManageEspecieRequest;
use App\Http\Requests\Backend\Especie\StoreEspecieRequest;
use App\Http\Requests\Backend\Especie\UpdateEspecieRequest;
use App\Models\Empresa;
use App\Models\Especie;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EspeciesController extends Controller
{


     public function index()
    {

        $empresaUser = Auth::user()->empresaUser();
        if ($empresaUser != null) {
            if (auth()->user()->hasRole('administrator')) {

                $especies = Especie::orderBy('id','desc')->get();

            } else {

                $especies = Especie::where('empresa_id', $empresaUser->id)
                    ->orWhere('empresa_id', null)->orderBy('id','desc')->get();

            }

            return view('backend.especies.index', compact('especies'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }

    }

    public function create(ManageEspecieRequest $request)
    {

        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.especies.create', compact('empresas'));

    }

    public function store(StoreEspecieRequest $request)
    {
        try {
            DB::beginTransaction();

            $especie         = new Especie();
            $especie->nombre = $request->input('nombre');
            
        
            if (auth()->user()->hasRole('administrator')) {

                $especie->empresa_id = $request->input('empresa_id');
               

            } else {

                $empresaUser             = Auth::user()->empresaUser();
                $especie->empresa_id = $empresaUser->id;
        
            }

            $especie->save();
            DB::commit();
            return redirect()->route('admin.especies.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.especies.index')->withFlashDanger('Error Inesperado');
        }
    }

    /**
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     */
    public function edit(ManageEspecieRequest $request, Especie $especie)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.especies.edit')->with(compact('especie', 'empresas'));
    }

    public function update(UpdateEspecieRequest  $request, Especie $especie)
    {
        try {
            DB::beginTransaction();
            $especie->nombre = $request->input('nombre');
            
            if (auth()->user()->hasRole('administrator')) {

                $especie->empresa_id = $request->input('empresa_id');
                

            } else {

                $empresaUser             = Auth::user()->empresaUser();
                $especie->empresa_id = $empresaUser->id;
                
            }
            $especie->save();
            DB::commit();
            return redirect()->route('admin.especies.index')->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {


            DB::rollback();

            return redirect()->route('admin.especies.index')->withFlashDanger('Error Inesperado');
        }

    }

    public function show(ManageEspecieRequest $request, Especie $especie)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.especies.show')->with(compact('especie', 'empresas'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageEspecieRequest $request, Especie $especie)
    {
        try {
            DB::beginTransaction();
            $especie->delete();
            DB::commit();
            return redirect()->route('admin.especies.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.especies.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }

}
