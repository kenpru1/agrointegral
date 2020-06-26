<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\EspecieFuente\ManageEspecieFuenteRequest;
use App\Http\Requests\Backend\EspecieFuente\StoreEspecieFuenteRequest;
use App\Http\Requests\Backend\EspecieFuente\UpdateEspecieFuenteRequest;
use App\Models\Auth\User;
use App\Models\EspecieFuente;
use App\Models\Empresa;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class EspecieFuenteController extends Controller
{
    public function index()
    {
        $empresaUser = User::find(Auth::id())->empresas()->first();

    
        if ($empresaUser != null) {
            

            //Si el usuario es administrador puede ver todos los lotes
            if (auth()->user()->hasRole('administrator')) {

                $especieFuentes = EspecieFuente::orderBy('id','desc')->get();
            } else {
                $especieFuentes = EspecieFuente::where('empresa_id', $empresaUser->id)->orderBy('id','desc')->get();
            }

            return view('backend.especie_fuente.index', compact('especieFuentes'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function create(ManageEspecieFuenteRequest $request)
    {
        
        $empresaUser = Auth::user()->empresaUser();
        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.especie_fuente.create', compact('empresas'));

    }

    public function store(StoreEspecieFuenteRequest $request)
    {
        try {

            DB::beginTransaction();
            $empresaUser = User::find(Auth::id())->empresas()->first();

            if ($empresaUser != null) {
                $especieFuente        = new EspecieFuente();
                $especieFuente->nombre       = $request->input('nombre');

                //$campo->empresa_id   = $empresaUser->id;
                //if (auth()->user()->hasRole('administrator')) {

                //    $tipoMuestra->empresa_id = $request->input('empresa_id');

                //} else {

                    $empresaUser             = Auth::user()->empresaUser();
                    $especieFuente->empresa_id = $empresaUser->id;

                //}

                $especieFuente->save();
                DB::commit();
                return redirect()->route('admin.especieFuente.index')->withFlashSuccess('Registro creado con éxito');
            } else {
                return redirect()->route('admin.especieFuente.index')->withFlashDanger('Usuario sin empresa registrada, por favor introduzar primero los datos de la empresa a la que representa');
            }

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.especieFuente.index')->withFlashSuccess('Error Inesperado');
        }
    }

    /**
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     */
    public function edit(ManageEspecieFuenteRequest $request, EspecieFuente $especieFuente)
    {

        $empresaUser             = Auth::user()->empresaUser();

        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.especie_fuente.edit')->with(compact('especieFuente','empresas'));
    }

    public function update(UpdateEspecieFuenteRequest $request, EspecieFuente $especieFuente)
    {
        try {
            DB::beginTransaction();
            $especieFuente->nombre       = $request->input('nombre');

            //if (auth()->user()->hasRole('administrator')) {

            //        $especieFuentes->empresa_id = $request->input('empresa_id');

            //    } else {

                    $empresaUser             = Auth::user()->empresaUser();
                    $especieFuente->empresa_id = $empresaUser->id;

            //    }
            $especieFuente->save();
            DB::commit();
            return redirect()->route('admin.especieFuente.index')->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.especieFuente.index')->withFlashDanger('Error Inesperado');
        }

    }

    public function show(ManageEspecieFuenteRequest $request, EspecieFuente $especieFuente)
    {
        $empresaUser             = Auth::user()->empresaUser();

        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.especie_fuentes.show')->with(compact('especieFuente','empresas'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageEspecieFuenteRequest $request, EspecieFuente $especieFuente)
    {
        try {
            DB::beginTransaction();
            $especieFuente->delete();
            DB::commit();
            return redirect()->route('admin.especieFuente.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.especieFuente.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }


}
