<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Laboratorio\ManageLaboratorioRequest;
use App\Http\Requests\Backend\Laboratorio\StoreLaboratorioRequest;
use App\Http\Requests\Backend\Laboratorio\UpdateLaboratorioRequest;
use App\Models\Auth\User;
use App\Models\Laboratorio;
use App\Models\Empresa;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LaboratorioController extends Controller
{
    public function index()
    {
        $empresaUser = User::find(Auth::id())->empresas()->first();

    
        if ($empresaUser != null) {
            

            //Si el usuario es administrador puede ver todos los lotes
            if (auth()->user()->hasRole('administrator')) {

                $laboratorios = Laboratorio::orderBy('id','desc')->get();
            } else {
                $laboratorios = Laboratorio::where('empresa_id', $empresaUser->id)->orderBy('id','desc')->get();
            }

            return view('backend.laboratorio.index', compact('laboratorios'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function create(ManageLaboratorioRequest $request)
    {
        
        $empresaUser = Auth::user()->empresaUser();
        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.laboratorio.create', compact('empresas'));

    }

    public function store(StoreLaboratorioRequest $request)
    {
        try {

            DB::beginTransaction();
            $empresaUser = User::find(Auth::id())->empresas()->first();

            if ($empresaUser != null) {
                $laboratorio        = new Laboratorio();
                $laboratorio->nombre       = $request->input('nombre');

                //$campo->empresa_id   = $empresaUser->id;
                //if (auth()->user()->hasRole('administrator')) {

                //    $tipoMuestra->empresa_id = $request->input('empresa_id');

                //} else {

                    $empresaUser             = Auth::user()->empresaUser();
                    $laboratorio->empresa_id = $empresaUser->id;

                //}

                $laboratorio->save();
                DB::commit();
                return redirect()->route('admin.laboratorio.index')->withFlashSuccess('Registro creado con éxito');
            } else {
                return redirect()->route('admin.laboratorio.index')->withFlashDanger('Usuario sin empresa registrada, por favor introduzar primero los datos de la empresa a la que representa');
            }

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.laboratorio.index')->withFlashSuccess('Error Inesperado');
        }
    }

    /**
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     */
    public function edit(ManageLaboratorioRequest $request, Laboratorio $laboratorio)
    {

        $empresaUser             = Auth::user()->empresaUser();

        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.laboratorio.edit')->with(compact('laboratorio','empresas'));
    }

    public function update(UpdateLaboratorioRequest $request, Laboratorio $laboratorio)
    {
        try {
            DB::beginTransaction();
            $laboratorio->nombre       = $request->input('nombre');

            //if (auth()->user()->hasRole('administrator')) {

            //        $laboratorio->empresa_id = $request->input('empresa_id');

            //    } else {

                    $empresaUser             = Auth::user()->empresaUser();
                    $laboratorio->empresa_id = $empresaUser->id;

            //    }
            $laboratorio->save();
            DB::commit();
            return redirect()->route('admin.laboratorio.index')->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.laboratorio.index')->withFlashDanger('Error Inesperado');
        }

    }

    public function show(ManageLaboratorioRequest $request, Laboratorio $laboratorio)
    {
        $empresaUser             = Auth::user()->empresaUser();

        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.laboratorio.show')->with(compact('laboratorio','empresas'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageLaboratorioRequest $request, Laboratorio $laboratorio)
    {
        try {
            DB::beginTransaction();
            $laboratorio->delete();
            DB::commit();
            return redirect()->route('admin.laboratorio.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.laboratorio.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }


}
