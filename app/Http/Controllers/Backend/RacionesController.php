<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Racion\StoreRacionRequest;
use App\Http\Requests\Backend\Racion\UpdateRacionRequest;
use App\Models\Animal;
use App\Models\Racion;
use App\Models\Rodeo;
use App\Models\TipoRacion;
use App\Models\Trabajador;
use DB;
use Illuminate\Support\Facades\Auth;

class RacionesController extends Controller
{
    public function index()
    {
        $empresaUser = Auth::user()->empresaUser();
        if ($empresaUser != null) {

            $raciones = Racion::whereHas('animal', function ($query) use ($empresaUser) {
                $query->where('empresa_id', $empresaUser->id);
            })->orderBy('id', 'desc')->get();

            return view('backend.raciones.index', compact('raciones'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }

    }

    public function create()
    {
        $empresaUser = Auth::user()->empresaUser();

        $tipoAp = ['1' => 'Individual', '2' => 'Rodeo'];
        if (auth()->user()->hasRole('administrator')) {

            $trabajadores = Trabajador::orderBy('id', 'asc')->pluck('nombre', 'id');
            //$rodeos       = Rodeo::orderBy('id', 'asc')->pluck('nombre', 'id');

            $rodeos = Rodeo::join('animales', 'animales.rodeo_id', '=', 'rodeos.id')
                ->orderBy('id', 'asc')->pluck('rodeos.nombre', 'rodeos.id');

            $animales = null;

        } else {

            $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
            $animales     = Animal::where('empresa_id', $empresaUser->id)->pluck('nombre', 'id');

            /* $rodeos       = Rodeo::where('empresa_id', $empresaUser->id)
            ->orWhere('empresa_id', null)->orderBy('id', 'asc')->pluck('nombre', 'id');*/

            $rodeos = Rodeo::join('animales', 'animales.rodeo_id', '=', 'rodeos.id')
                ->where('animales.empresa_id', $empresaUser->id)
                ->orWhere('animales.empresa_id', null)->orderBy('id', 'asc')->pluck('rodeos.nombre', 'rodeos.id');

            $tipoRac = TipoRacion::where('empresa_id', $empresaUser->id)
                ->orWhere('empresa_id', null)->orderBy('id', 'asc')->pluck('descripcion', 'id');

        }

        return view('backend.raciones.create', compact('animales', 'tipoRac', 'trabajadores', 'tipoAp', 'rodeos'));
    }

    /*
    Funcion para guardar el sanitario que proviene de la vista new
     */

    public function store(StoreRacionRequest $request)
    {
        try {
            $empresaUser = Auth::user()->empresaUser();

            DB::beginTransaction();
            if ($request->input('tipo_aplicacion') == 1) {
                $racion                 = new Racion();
                $racion->trabajador_id  = $request->input('trabajador_id');
                $racion->animal_id      = $request->input('animal_id');
                $racion->fecha          = $request->input('fecha');
                $racion->tipo_racion_id = $request->input('tipo_racion_id');
                $racion->nombre         = $request->input('nombre');
                $racion->descripcion    = $request->input('descripcion');
                $racion->save();
            }

            if ($request->input('tipo_aplicacion') == 2) {
                $animales = Animal::where('rodeo_id', $request->input('rodeo_id'))
                    ->where('empresa_id', $empresaUser->id)->get();

                foreach ($animales as $animal) {
                    $racion                 = new Racion();
                    $racion->trabajador_id  = $request->input('trabajador_id');
                    $racion->animal_id      = $animal->id;
                    $racion->fecha          = $request->input('fecha');
                    $racion->tipo_racion_id = $request->input('tipo_racion_id');
                    $racion->nombre         = $request->input('nombre');
                    $racion->descripcion    = $request->input('descripcion');
                    $racion->save();

                }

            }

            DB::commit();
            return redirect()->route('admin.raciones.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('admin.raciones.resumen')->withFlashDanger('Error desconocido por favor intentelo de nuevo si el error persiste contacte a su soporte técnico');
        }

    }

    public function edit(Racion $racion)
    {
        $empresaUser = Auth::user()->empresaUser();

        if (auth()->user()->hasRole('administrator')) {

            $trabajadores = Trabajador::orderBy('id', 'asc')->pluck('nombre', 'id');
            $rodeos       = Rodeo::join('animales', 'animales.rodeo_id', '=', 'rodeos.id')
                ->orderBy('id', 'asc')->pluck('rodeos.nombre', 'rodeos.id');

        } else {

            $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

            $rodeos = Rodeo::join('animales', 'animales.rodeo_id', '=', 'rodeos.id')
                ->where('animales.empresa_id', $empresaUser->id)
                ->orWhere('animales.empresa_id', null)->orderBy('id', 'asc')->pluck('rodeos.nombre', 'rodeos.id');

            $tipoRac = TipoRacion::where('empresa_id', $empresaUser->id)
                ->orWhere('empresa_id', null)->orderBy('id', 'asc')->pluck('descripcion', 'id');

        }

        return view('backend.raciones.edit', compact('tipoRac', 'trabajadores', 'rodeos', 'racion'));
    }

    public function update(UpdateRacionRequest $request, Racion $racion)
    {
        try {
            $empresaUser = Auth::user()->empresaUser();

            DB::beginTransaction();

            $racion->trabajador_id  = $request->input('trabajador_id');
            $racion->animal_id      = $request->input('animal_id');
            $racion->fecha          = $request->input('fecha');
            $racion->tipo_racion_id = $request->input('tipo_racion_id');
            $racion->nombre         = $request->input('nombre');
            $racion->descripcion    = $request->input('descripcion');
            $racion->save();

            DB::commit();
            return redirect()->route('admin.raciones.index')->withFlashSuccess('Registro editado con éxito');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('admin.raciones.resumen')->withFlashDanger('Error desconocido por favor intentelo de nuevo si el error persiste contacte a su soporte técnico');
        }

    }

    public function show(Racion $racion)
    {
        $empresaUser = Auth::user()->empresaUser();

        if (auth()->user()->hasRole('administrator')) {

            $trabajadores = Trabajador::orderBy('id', 'asc')->pluck('nombre', 'id');
            $rodeos       = Rodeo::orderBy('id', 'asc')->pluck('nombre', 'id');
            //$animales     = null;

        } else {

            $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
            //$animales     = Animal::where('empresa_id', $empresaUser->id)->pluck('nombre', 'id');
            $rodeos = Rodeo::where('empresa_id', $empresaUser->id)
                ->orWhere('empresa_id', null)->orderBy('id', 'asc')->pluck('nombre', 'id');
            $tipoRac = TipoRacion::where('empresa_id', $empresaUser->id)
                ->orWhere('empresa_id', null)->orderBy('id', 'asc')->pluck('descripcion', 'id');

        }

        return view('backend.raciones.show', compact('tipoRac', 'trabajadores', 'rodeos', 'racion'));
    }

    public function destroy(Racion $racion)
    {
        try {
            DB::beginTransaction();
            $racion->delete();
            DB::commit();
            return redirect()->route('admin.raciones.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.raciones.index')->withFlashDanger('Error Inesperado');
        }

    }

}
