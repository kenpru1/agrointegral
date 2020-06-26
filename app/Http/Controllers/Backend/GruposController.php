<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Grupos\ManageGruposRequest;
use App\Http\Requests\Backend\Grupos\StoreGruposRequest;
use App\Http\Requests\Backend\Grupos\UpdateGruposRequest;
use App\Models\Auth\User;
use App\Models\Grupo;
use App\Models\Empresa;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class GruposController extends Controller
{
    public function index()
    {
        $empresaUser = User::find(Auth::id())->empresas()->first();

    
        if ($empresaUser != null) {
            

            //Si el usuario es administrador puede ver todos los lotes
            if (auth()->user()->hasRole('administrator')) {

                $grupos = Grupo::where('empresa_id', $empresaUser->id)->orderBy('id','desc')->get();
            } else {
                $grupos = Grupo::where('empresa_id', $empresaUser->id)->orderBy('id','desc')->get();
            }

            return view('backend.grupos.index', compact('grupos'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function create(ManageGruposRequest $request)
    {
        
        $empresaUser = Auth::user()->empresaUser();
        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.grupos.create', compact('empresas'));

    }

    public function store(StoreGruposRequest $request)
    {
        try {

            DB::beginTransaction();
            $empresaUser = User::find(Auth::id())->empresas()->first();

            if ($empresaUser != null) {
                $grupos        = new Grupo();
                $grupos->nombre       = $request->input('nombre');

                //$campo->empresa_id   = $empresaUser->id;
                //if (auth()->user()->hasRole('administrator')) {

                //    $tipoMuestra->empresa_id = $request->input('empresa_id');

                //} else {

                    $empresaUser             = Auth::user()->empresaUser();
                    $grupos->empresa_id = $empresaUser->id;

                //}

                $grupos->save();
                DB::commit();
                return redirect()->route('admin.grupos.index')->withFlashSuccess('Registro creado con éxito');
            } else {
                return redirect()->route('admin.grupos.index')->withFlashDanger('Usuario sin empresa registrada, por favor introduzar primero los datos de la empresa a la que representa');
            }

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.grupos.index')->withFlashSuccess('Error Inesperado');
        }
    }

    /**
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     */
    public function edit(ManageGruposRequest $request, Grupo $grupos)
    {

        $empresaUser  = Auth::user()->empresaUser();

        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');


        return view('backend.grupos.edit')->with(compact('grupos','empresas'));
    }

    public function update(UpdateGruposRequest $request, Grupo $grupos)
    {
        try {
            DB::beginTransaction();
            $grupos->nombre       = $request->input('nombre');

            //if (auth()->user()->hasRole('administrator')) {

            //        $grupos->empresa_id = $request->input('empresa_id');

            //    } else {

                    $empresaUser        = Auth::user()->empresaUser();
                    $grupos->empresa_id = $empresaUser->id;

            //    }
            $grupos->save();
            DB::commit();
            return redirect()->route('admin.grupos.index')->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.grupos.index')->withFlashDanger('Error Inesperado');
        }

    }

    public function show(ManageGruposRequest $request, Grupo $grupos)
    {
        $empresaUser  = Auth::user()->empresaUser();

        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.grupos.show')->with(compact('grupos','empresas'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageGruposRequest $request, Grupo $grupos)
    {
        try {
            DB::beginTransaction();
            $grupos->delete();
            DB::commit();
            return redirect()->route('admin.grupos.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.grupos.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }


}
