<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TipoRacion;
use App\Models\Empresa;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TipoRacionesController extends Controller
{
    
     public function index()
    {

        $empresaUser = Auth::user()->empresaUser();
        if ($empresaUser != null) {
            if (auth()->user()->hasRole('administrator')) {

                $tipoRaciones = TipoRacion::orderBy('id','desc')->get();

            } else {

                $tipoRaciones = TipoRacion::where('empresa_id', $empresaUser->id)
                    ->orWhere('empresa_id', null)->orderBy('id','desc')->get();

            }

            return view('backend.tipo_raciones.index', compact('tipoRaciones'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }

    }

    public function create()
    {

        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.tipo_raciones.create', compact('empresas'));

    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $tipoRacion         = new TipoRacion();
            $tipoRacion->descripcion = $request->input('descripcion');
            
        
            if (auth()->user()->hasRole('administrator')) {

                $tipoRacion->empresa_id = $request->input('empresa_id');
               

            } else {

                $empresaUser             = Auth::user()->empresaUser();
                $tipoRacion->empresa_id = $empresaUser->id;
        
            }

            $tipoRacion->save();
            DB::commit();
            return redirect()->route('admin.tipo_raciones.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
dd($e);
            DB::rollback();

            return redirect()->route('admin.tipo_raciones.index')->withFlashDanger('Error Inesperado');
        }
    }

    /**
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     */
    public function edit(Request $request, TipoRacion $tipoRacion)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.tipo_raciones.edit')->with(compact('tipoRacion', 'empresas'));
    }

    public function update(Request  $request, TipoRacion $tipoRacion)
    {
        try {
            DB::beginTransaction();
            $tipoRacion->descripcion = $request->input('descripcion');
            
            if (auth()->user()->hasRole('administrator')) {

                $tipoRacion->empresa_id = $request->input('empresa_id');
                

            } else {

                $empresaUser             = Auth::user()->empresaUser();
                $tipoRacion->empresa_id = $empresaUser->id;
                
            }
            $tipoRacion->save();
            DB::commit();
            return redirect()->route('admin.tipo_raciones.index')->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {


            DB::rollback();

            return redirect()->route('admin.tipo_raciones.index')->withFlashDanger('Error Inesperado');
        }

    }

    public function show(Request $request, TipoRacion $tipoRacion)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.tipo_raciones.show')->with(compact('tipoRacion', 'empresas'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TipoRacion $tipoRacion)
    {
        try {
            DB::beginTransaction();
            $tipoRacion->delete();
            DB::commit();
            return redirect()->route('admin.tipo_raciones.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.tipo_raciones.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }

}
