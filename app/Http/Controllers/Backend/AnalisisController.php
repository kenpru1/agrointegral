<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Analisis\ManageAnalisisRequest;
use App\Http\Requests\Backend\Analisis\StoreAnalisisRequest;
use App\Http\Requests\Backend\Analisis\UpdateAnalisisRequest;
use App\Models\Auth\User;
use App\Models\Analisis;
use App\Models\Empresa;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AnalisisController extends Controller
{
    public function index()
    {
        $empresaUser = User::find(Auth::id())->empresas()->first();

    
        if ($empresaUser != null) {
            

            //Si el usuario es administrador puede ver todos los lotes
            if (auth()->user()->hasRole('administrator')) {

                $analisis = Analisis::orderBy('id','desc')->get();
            } else {
                $analisis = Analisis::where('empresa_id', $empresaUser->id)->orderBy('id','desc')->get();
            }

            return view('backend.analisis.index', compact('analisis'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function create(ManageAnalisisRequest $request)
    {
        
        $empresaUser = Auth::user()->empresaUser();
        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.analisis.create', compact('empresas'));

    }

    public function store(StoreAnalisisRequest $request)
    {
        try {

            DB::beginTransaction();
            $empresaUser = User::find(Auth::id())->empresas()->first();

            if ($empresaUser != null) {
                $analisis        = new Analisis();
                $analisis->nombre       = $request->input('nombre');

                //$campo->empresa_id   = $empresaUser->id;
                //if (auth()->user()->hasRole('administrator')) {

                //    $tipoMuestra->empresa_id = $request->input('empresa_id');

                //} else {

                    $empresaUser             = Auth::user()->empresaUser();
                    $analisis->empresa_id = $empresaUser->id;

                //}

                $analisis->save();
                DB::commit();
                return redirect()->route('admin.analisis.index')->withFlashSuccess('Registro creado con éxito');
            } else {
                return redirect()->route('admin.analisis.index')->withFlashDanger('Usuario sin empresa registrada, por favor introduzar primero los datos de la empresa a la que representa');
            }

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.analisis.index')->withFlashSuccess('Error Inesperado');
        }
    }

    /**
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     */
    public function edit(ManageAnalisisRequest $request, Analisis $analisis)
    {

        $empresaUser             = Auth::user()->empresaUser();

        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.analisis.edit')->with(compact('analisis','empresas'));
    }

    public function update(UpdateAnalisisRequest $request, Analisis $analisis)
    {
        try {
            DB::beginTransaction();
            $analisis->nombre       = $request->input('nombre');

            //if (auth()->user()->hasRole('administrator')) {

            //        $analisis->empresa_id = $request->input('empresa_id');

            //    } else {

                    $empresaUser             = Auth::user()->empresaUser();
                    $analisis->empresa_id = $empresaUser->id;

            //    }
            $analisis->save();
            DB::commit();
            return redirect()->route('admin.analisis.index')->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.analisis.index')->withFlashDanger('Error Inesperado');
        }

    }

    public function show(ManageAnalisisRequest $request, Analisis $analisis)
    {
        $empresaUser             = Auth::user()->empresaUser();

        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.analisis.show')->with(compact('analisis','empresas'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageAnalisisRequest $request, Analisis $analisis)
    {
        try {
            DB::beginTransaction();
            $analisis->delete();
            DB::commit();
            return redirect()->route('admin.analisis.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.analisis.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }


}
