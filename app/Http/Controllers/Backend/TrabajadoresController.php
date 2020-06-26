<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Trabajador\ManageTrabajadorRequest;
use App\Http\Requests\Backend\Trabajador\StoreTrabajadorRequest;
use App\Http\Requests\Backend\Trabajador\UpdateTrabajadorRequest;
use App\Models\Trabajador;
use App\Models\Empresa;
use App\Models\Comuna;
use App\Models\Paises;
use App\Models\Provincia;
use App\Models\TipoTrabajador;
use App\Models\NivelCalificacion;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrabajadoresController extends Controller
{
    public function index()
    {

        $empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) {
            //Si el usuario es administrador puede ver todos los lotes
            if (auth()->user()->hasRole('administrator')) {

                $trabajadores = Trabajador::orderBy('id','desc')->get();
            } else {
                $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id','desc')->get();

            }

            return view('backend.trabajadores.index', compact('trabajadores'));

        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }


    public function create(ManageTrabajadorRequest $request)
    {

        $provincias   = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $comuna=null;
        if(old('provincia_id')){
            $comuna   = Comuna::orderBy('nombre', 'asc')->where('provincia_id',old('provincia_id'))->pluck('nombre', 'id');
        }

        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $tipos = TipoTrabajador::orderBy('id', 'asc')->pluck('nombre', 'id');
        $niveles = NivelCalificacion::orderBy('id', 'asc')->pluck('nombre', 'id');
        //$paises = Paises::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.trabajadores.create', compact('empresas','tipos','niveles','provincias','comuna'));
    }


    public function store(StoreTrabajadorRequest $request)
    {
        try {
            DB::beginTransaction();

            $trabajador = new Trabajador();
            $trabajador->rut             = $request->input('rut');
            $trabajador->nombre             = $request->input('nombre');
            $trabajador->tipo_trabajador_id             = $request->input('tipo_trabajador_id');
            $trabajador->nivel_calificacion_id             = $request->input('nivel_calificacion_id');
            $trabajador->asesor             = $request->input('asesor');
            $trabajador->email             = $request->input('email');
            $trabajador->telefono             = $request->input('telefono');
            $trabajador->direccion             = $request->input('direccion');
            $trabajador->codigo_postal             = $request->input('codigo_postal');
            $trabajador->nacionalidad             = $request->input('nacionalidad');
            $trabajador->provincia_id             = $request->input('provincia_id');
            $trabajador->comuna_id             = $request->input('comuna_id');
            $trabajador->comentarios             = $request->input('comentarios');
            

            if (auth()->user()->hasRole('administrator')) {
                $empresaUser = Auth::user()->empresaUser();

                $trabajador->empresa_id = $request->input('empresa_id');

            } else {

                $empresaUser          = Auth::user()->empresaUser();
                $trabajador->empresa_id = $empresaUser->id;

            }
            $trabajador->save();
            DB::commit();
            return redirect()->route('admin.trabajadores.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->route('admin.trabajadores.index')->withFlashSuccess('Error Inesperado');
        }

    }


     public function edit(ManageTrabajadorRequest $request, Trabajador $trabajador)
    {


    	$provincias   = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
    	$comuna   = Comuna::where('provincia_id', $trabajador->provincia_id)->pluck('nombre', 'id');
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $tipos = TipoTrabajador::orderBy('id', 'asc')->pluck('nombre', 'id');
        $niveles = NivelCalificacion::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        //$paises = Paises::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.trabajadores.edit', compact('empresas','tipos','niveles','trabajador','provincias','comuna'));
    }


    public function update(UpdateTrabajadorRequest $request, Trabajador $trabajador)
    {
        try {
            DB::beginTransaction();

           
            $trabajador->rut             = $request->input('rut');
            $trabajador->nombre             = $request->input('nombre');
            $trabajador->tipo_trabajador_id             = $request->input('tipo_trabajador_id');
            $trabajador->nivel_calificacion_id             = $request->input('nivel_calificacion_id');
            $trabajador->asesor             = $request->input('asesor');
            $trabajador->email             = $request->input('email');
            $trabajador->telefono             = $request->input('telefono');
            $trabajador->direccion             = $request->input('direccion');
            $trabajador->codigo_postal             = $request->input('codigo_postal');
            $trabajador->nacionalidad             = $request->input('nacionalidad');
            $trabajador->provincia_id             = $request->input('provincia_id');
            $trabajador->comuna_id             = $request->input('comuna_id');
            $trabajador->comentarios             = $request->input('comentarios');

            if (auth()->user()->hasRole('administrator')) {
                $empresaUser = Auth::user()->empresaUser();

                $trabajador->empresa_id = $request->input('empresa_id');

            } else {

                $empresaUser          = Auth::user()->empresaUser();
                $trabajador->empresa_id = $empresaUser->id;

            }
            $trabajador->save();
            DB::commit();
            return redirect()->route('admin.trabajadores.index')->withFlashSuccess('Registro editado con éxito');
        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->route('admin.trabajadores.index')->withFlashSuccess('Error Inesperado');
        }

    }

    public function show(ManageTrabajadorRequest $request, Trabajador $trabajador)
    {
        $provincias   = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $comuna   = Comuna::where('provincia_id', $trabajador->provincia_id)->pluck('nombre', 'id');
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $tipos = TipoTrabajador::orderBy('id', 'asc')->pluck('nombre', 'id');
        $niveles = NivelCalificacion::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        //$paises = Paises::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.trabajadores.show', compact('empresas','tipos','niveles','trabajador','provincias','comuna'));
    }



    public function destroy(ManageTrabajadorRequest $request, Trabajador $trabajador)
    {
        try {
            DB::beginTransaction();
            $trabajador->delete();
            DB::commit();
            return redirect()->route('admin.trabajadores.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.trabajadores.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }

}
