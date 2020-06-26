<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Maquinaria\ManageMaquinariaRequest;
use App\Http\Requests\Backend\Maquinaria\StoreMaquinariaRequest;
use App\Models\Empresa;
use App\Models\Maquinaria;
use App\Models\TipoMaquinaria;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaquinariasController extends Controller
{
    public function index()
    {

        $empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) {
            //Si el usuario es administrador puede ver todos los lotes
            if (auth()->user()->hasRole('administrator')) {

                $maquinarias = Maquinaria::all();
            } else {
                $maquinarias = Maquinaria::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();

            }

            return view('backend.maquinarias.index', compact('maquinarias'));

        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function create(ManageMaquinariaRequest $request)
    {
        $empresaUser = Auth::user()->empresaUser();
        $tipoMaquinas = TipoMaquinaria::orderBy('nombre', 'asc')->where('empresa_id', $empresaUser->id)->orWhere('empresa_id',null)->pluck('nombre', 'id');
        $empresas     = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $propietario  = ['Propio' => 'Propio', 'Arrendado' => 'Arrendado', 'Prestamo' => 'Prestamo'];

        return view('backend.maquinarias.create', compact('tipoMaquinas', 'propietario', 'empresas'));
    }

    public function store(StoreMaquinariaRequest $request)
    {
        try {
            DB::beginTransaction();

            $maquinaria = new Maquinaria();

            $maquinaria->nombre             = $request->input('nombre');
            $maquinaria->descripcion        = $request->input('descripcion');
            $maquinaria->maquinaria_tipo_id = $request->input('maquinaria_tipo_id');
            $maquinaria->marca              = $request->input('marca');
            $maquinaria->patente            = $request->input('patente');
            $maquinaria->modelo             = $request->input('modelo');
            $maquinaria->propietario        = $request->input('propietario');
            $maquinaria->fecha_compra       = $request->input('fecha_compra');
            $maquinaria->venc_rev_tecnica   = $request->input('venc_rev_tecnica');
            $maquinaria->valor_compra       = $request->input('valor_compra');
            $maquinaria->fecha_inspeccion   = $request->input('fecha_inspeccion');
            $maquinaria->fecha_seguro       = $request->input('fecha_seguro');
            $maquinaria->numero_roma        = $request->input('numero_roma');

            if (auth()->user()->hasRole('administrator')) {
                $empresaUser = Auth::user()->empresaUser();

                $maquinaria->empresa_id = $request->input('empresa_id');

            } else {

                $empresaUser            = Auth::user()->empresaUser();
                $maquinaria->empresa_id = $empresaUser->id;

            }
            $maquinaria->save();
            DB::commit();
            return redirect()->route('admin.maquinarias.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.maquinarias.index')->withFlashSuccess('Error Inesperado');
        }

    }

    /**
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     */
    public function edit(Request $request, Maquinaria $maquinaria)
    {
        $empresaUser = Auth::user()->empresaUser();
         $tipoMaquinas = TipoMaquinaria::orderBy('nombre', 'asc')->where('empresa_id', $empresaUser->id)->orWhere('empresa_id',null)->pluck('nombre', 'id');
        $empresas     = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $propietario  = ['Propio' => 'Propio', 'Arrendado' => 'Arrendado', 'Prestamo' => 'Prestamo'];
        $mantenciones = $maquinaria->mantenciones;
        return view('backend.maquinarias.edit')->with(compact('maquinaria', 'tipoMaquinas', 'propietario', 'empresas', 'mantenciones'));
    }

    public function update(Request $request, Maquinaria $maquinaria)
    {
        try {
            DB::beginTransaction();
            $empresaUser = Auth::user()->empresaUser();

            $maquinaria->nombre             = $request->input('nombre');
            $maquinaria->descripcion        = $request->input('descripcion');
            $maquinaria->maquinaria_tipo_id = $request->input('maquinaria_tipo_id');
            $maquinaria->marca              = $request->input('marca');
            $maquinaria->patente            = $request->input('patente');
            $maquinaria->modelo             = $request->input('modelo');
            $maquinaria->propietario        = $request->input('propietario');
            $maquinaria->fecha_compra       = $request->input('fecha_compra');
            $maquinaria->valor_compra       = $request->input('valor_compra');
            $maquinaria->venc_rev_tecnica   = $request->input('venc_rev_tecnica');
            $maquinaria->fecha_inspeccion   = $request->input('fecha_inspeccion');
            $maquinaria->fecha_seguro       = $request->input('fecha_seguro');
            $maquinaria->numero_roma        = $request->input('numero_roma');
            //$maquinaria->empresa_id         = $empresaUser->id;
            if (auth()->user()->hasRole('administrator')) {
                $empresaUser = Auth::user()->empresaUser();

                $maquinaria->empresa_id = $request->input('empresa_id');

            } else {

                $empresaUser            = Auth::user()->empresaUser();
                $maquinaria->empresa_id = $empresaUser->id;

            }
            $maquinaria->save();
            DB::commit();
            return redirect()->route('admin.maquinarias.index')->withFlashSuccess('Registro editado con éxito');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.maquinarias.index')->withFlashSuccess('Error Inesperado');
        }
    }


    public function show(Request $request, Maquinaria $maquinaria)
    {
        $empresas     = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $tipoMaquinas = TipoMaquinaria::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $propietario  = ['Propio' => 'Propio', 'Arrendado' => 'Arrendado', 'Prestamo' => 'Prestamo'];
        $mantenciones = $maquinaria->mantenciones;
        return view('backend.maquinarias.show')->with(compact('maquinaria', 'tipoMaquinas', 'propietario', 'empresas', 'mantenciones'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maquinaria $maquinaria)
    {
        try {
            DB::beginTransaction();
            $maquinaria->delete();
            DB::commit();
            return redirect()->route('admin.maquinarias.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.maquinarias.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }
}
