<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TipoMuestras\ManageTipoMuestrasRequest;
use App\Http\Requests\Backend\TipoMuestras\StoreTipoMuestrasRequest;
use App\Http\Requests\Backend\TipoMuestras\UpdateTipoMuestrasRequest;
use App\Models\Auth\User;
use App\Models\TipoMuestra;
use App\Models\Empresa;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class TipoMuestrasController extends Controller
{
    public function index()
    {
        $empresaUser = User::find(Auth::id())->empresas()->first();

    
        if ($empresaUser != null) {
            

            //Si el usuario es administrador puede ver todos los lotes
            if (auth()->user()->hasRole('administrator')) {

                $tipoMuestras = TipoMuestra::orderBy('id','desc')->get();
            } else {
                $tipoMuestras = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id','desc')->get();
            }

            return view('backend.tipo_muestras.index', compact('tipoMuestras'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function create(ManageTipoMuestrasRequest $request)
    {
        
        $empresaUser = Auth::user()->empresaUser();
        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.tipo_muestras.create', compact('empresas'));

    }

    public function store(StoreTipoMuestrasRequest $request)
    {
        try {
            DB::beginTransaction();
            $empresaUser = User::find(Auth::id())->empresas()->first();

            if ($empresaUser != null) {
                $tipoMuestra        = new TipoMuestra();
                $tipoMuestra->nombre       = $request->input('nombre');

                //$campo->empresa_id   = $empresaUser->id;
                //if (auth()->user()->hasRole('administrator')) {

                //    $tipoMuestra->empresa_id = $request->input('empresa_id');

                //} else {

                    $empresaUser             = Auth::user()->empresaUser();
                    $tipoMuestra->empresa_id = $empresaUser->id;

                //}

                $tipoMuestra->save();
                DB::commit();
                return redirect()->route('admin.tipo_muestras.index')->withFlashSuccess('Registro creado con éxito');
            } else {
                return redirect()->route('admin.tipo_muestras.index')->withFlashDanger('Usuario sin empresa registrada, por favor introduzar primero los datos de la empresa a la que representa');
            }

        } catch (\Exception $e) {
            dd($e);

            DB::rollback();

            return redirect()->route('admin.tipo_muestras.index')->withFlashSuccess('Error Inesperado');
        }
    }

    /**
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     */
    public function edit(ManageTipoMuestrasRequest $request, TipoMuestra $tipoMuestra)
    {

        $empresaUser             = Auth::user()->empresaUser();

        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.tipo_muestras.edit')->with(compact('tipoMuestra','empresas'));
    }

    public function update(UpdateTipoMuestrasRequest $request, TipoMuestra $tipoMuestra)
    {
        try {
            DB::beginTransaction();
            $tipoMuestra->nombre       = $request->input('nombre');

            if (auth()->user()->hasRole('administrator')) {

                    $tipoMuestra->empresa_id = $request->input('empresa_id');

                } else {

                    $empresaUser             = Auth::user()->empresaUser();
                    $tipoMuestra->empresa_id = $empresaUser->id;

                }
            $tipoMuestra->save();
            DB::commit();
            return redirect()->route('admin.tipo_muestras.index')->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.tipo_muestras.index')->withFlashDanger('Error Inesperado');
        }

    }

    public function show(ManageTipoMuestrasRequest $request, TipoMuestra $tipoMuestra)
    {
        $empresaUser             = Auth::user()->empresaUser();

        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.tipo_muestras.show')->with(compact('tipoMuestra','empresas'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageTipoMuestrasRequest $request, TipoMuestra $tipoMuestra)
    {
        try {
            DB::beginTransaction();
            $tipoMuestra->delete();
            DB::commit();
            return redirect()->route('admin.tipo_muestras.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.tipo_muestras.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }


}
