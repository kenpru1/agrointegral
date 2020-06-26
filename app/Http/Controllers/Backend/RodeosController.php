<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Rodeo\ManageRodeoRequest;
use App\Http\Requests\Backend\Rodeo\StoreRodeoRequest;
use App\Http\Requests\Backend\Rodeo\UpdateRodeoRequest;
use App\Models\Empresa;
use App\Models\Rodeo;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RodeosController extends Controller
{


     public function index()
    {

        $empresaUser = Auth::user()->empresaUser();
        if ($empresaUser != null) {
            if (auth()->user()->hasRole('administrator')) {

                $rodeos = Rodeo::orderBy('id','desc')->get();

            } else {

                $rodeos = Rodeo::where('empresa_id', $empresaUser->id)
                    ->orWhere('empresa_id', null)->orderBy('id','desc')->get();

            }

            return view('backend.rodeos.index', compact('rodeos'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }

    }

    public function create(ManageRodeoRequest $request)
    {

        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.rodeos.create', compact('empresas'));

    }

    public function store(StoreRodeoRequest $request)
    {
        try {
            DB::beginTransaction();

            $rodeo         = new Rodeo();
            $rodeo->nombre = $request->input('nombre');
            
        
            if (auth()->user()->hasRole('administrator')) {

                $rodeo->empresa_id = $request->input('empresa_id');
               

            } else {

                $empresaUser             = Auth::user()->empresaUser();
                $rodeo->empresa_id = $empresaUser->id;
        
            }

            $rodeo->save();
            DB::commit();
            return redirect()->route('admin.rodeos.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.rodeos.index')->withFlashDanger('Error Inesperado');
        }
    }

    /**
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     */
    public function edit(ManageRodeoRequest $request, Rodeo $rodeo)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.rodeos.edit')->with(compact('rodeo', 'empresas'));
    }

    public function update(UpdateRodeoRequest  $request, Rodeo $rodeo)
    {
        try {
            DB::beginTransaction();
            $rodeo->nombre = $request->input('nombre');
            
            if (auth()->user()->hasRole('administrator')) {

                $rodeo->empresa_id = $request->input('empresa_id');
                

            } else {

                $empresaUser             = Auth::user()->empresaUser();
                $rodeo->empresa_id = $empresaUser->id;
                
            }
            $rodeo->save();
            DB::commit();
            return redirect()->route('admin.rodeos.index')->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {


            DB::rollback();

            return redirect()->route('admin.rodeos.index')->withFlashDanger('Error Inesperado');
        }

    }

    public function show(ManageRodeoRequest $request, Rodeo $rodeo)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.rodeos.show')->with(compact('rodeo', 'empresas'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageRodeoRequest $request, Rodeo $rodeo)
    {
        try {
            DB::beginTransaction();
            $rodeo->delete();
            DB::commit();
            return redirect()->route('admin.rodeos.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.rodeos.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }

}
