<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Sanitario\StoreSanitarioRequest;
use App\Http\Requests\Backend\Sanitario\GuardarSanitarioRequest;
use App\Http\Requests\Backend\Sanitario\UpdateSanitarioRequest;
use App\Models\Animal;
use App\Models\Empresa;
use App\Models\Rodeo;
use App\Models\Sanitario;
use App\Models\TipoSanitario;
use App\Models\Trabajador;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanitariosController extends Controller
{
    
    public function index(Animal $animal)
    {

        $sanitarios = Sanitario::where('animal_id', $animal->id)->orderBy('id', 'desc')->get();
        return view('backend.sanitarios.index', compact('sanitarios', 'animal'));

    }

    public function create(Animal $animal)
    {
        $empresaUser = Auth::user()->empresaUser();

        $tipoSan = TipoSanitario::orderBy('id', 'asc')->pluck('nombre', 'id');
        if (auth()->user()->hasRole('administrator')) {

            $trabajadores = Trabajador::orderBy('id', 'asc')->pluck('nombre', 'id');

        } else {

            $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

        }

        return view('backend.sanitarios.create', compact('animal', 'tipoSan', 'trabajadores'));
    }

    public function store(StoreSanitarioRequest $request)
    {
        try {

            DB::beginTransaction();

            $sanitario                        = new Sanitario();
            $sanitario->trabajador_id         = $request->input('trabajador_id');
            $sanitario->animal_id             = $request->input('animal_id');
            $sanitario->fecha_inicio          = $request->input('fecha_inicio');
            $sanitario->fecha_termino         = $request->input('fecha_termino');
            $sanitario->tipo_sanitario_id     = $request->input('tipo_sanitario_id');
            $sanitario->nombre                = $request->input('nombre');
            $sanitario->tratamiento_utilizado = $request->input('tratamiento_utilizado');
            $sanitario->dias                  = $request->input('dias');
            $sanitario->comentario            = $request->input('comentarios');
            $sanitario->save();

            DB::commit();
            return redirect()->route('admin.sanitarios.index', $request->input('animal_id'))->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->route('admin.sanitarios.index', $request->input('animal_id'))->withFlashDanger('Error desconocido por favor intentelo de nuevo si el error persiste contacte a su soporte técnico');
        }

    }

    public function edit(Sanitario $sanitario)
    {
        $empresaUser = Auth::user()->empresaUser();

        $tipoSan = TipoSanitario::orderBy('id', 'asc')->pluck('nombre', 'id');
        if (auth()->user()->hasRole('administrator')) {

            $trabajadores = Trabajador::orderBy('id', 'asc')->pluck('nombre', 'id');

        } else {

            $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

        }

        return view('backend.sanitarios.edit', compact('tipoSan', 'trabajadores', 'sanitario'));
    }

    public function update(UpdateSanitarioRequest $request, Sanitario $sanitario)
    {
        try {

            DB::beginTransaction();

            $sanitario->trabajador_id         = $request->input('trabajador_id');
            $sanitario->animal_id             = $request->input('animal_id');
            $sanitario->fecha_inicio          = $request->input('fecha_inicio');
            $sanitario->fecha_termino         = $request->input('fecha_termino');
            $sanitario->tipo_sanitario_id     = $request->input('tipo_sanitario_id');
            $sanitario->nombre                = $request->input('nombre');
            $sanitario->tratamiento_utilizado = $request->input('tratamiento_utilizado');
            $sanitario->dias                  = $request->input('dias');
            $sanitario->comentario            = $request->input('comentarios');
            $sanitario->save();
            DB::commit();
            return redirect()->route('admin.sanitarios.index', $request->input('animal_id'))->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            dd($e);
            DB::rollback();
            return redirect()->route('admin.sanitarios.index', $request->input('animal_id'))->withFlashDanger('Error desconocido por favor intentelo de nuevo si el error persiste contacte a su soporte técnico');
        }

    }

    public function show(Sanitario $sanitario)
    {
        $empresaUser = Auth::user()->empresaUser();

        $tipoSan = TipoSanitario::orderBy('id', 'asc')->pluck('nombre', 'id');
        if (auth()->user()->hasRole('administrator')) {

            $trabajadores = Trabajador::orderBy('id', 'asc')->pluck('nombre', 'id');

        } else {

            $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

        }

        return view('backend.sanitarios.show', compact('tipoSan', 'trabajadores', 'sanitario'));
    }

    public function destroy(Sanitario $sanitario)
    {
        try {
            DB::beginTransaction();
            $sanitario->delete();
            DB::commit();
            return redirect()->route('admin.sanitarios.index', $sanitario->animal->id)->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.sanitarios.index', $sanitario->animal->id)->withFlashDanger('Error Inesperado');
        }

    }

   public function new () {
        $empresaUser = Auth::user()->empresaUser();

        $tipoAp  = ['1' => 'Individual', '2' => 'Rodeo'];
        $tipoSan = TipoSanitario::orderBy('id', 'asc')->pluck('nombre', 'id');
        if (auth()->user()->hasRole('administrator')) {

            $trabajadores = Trabajador::orderBy('id', 'asc')->pluck('nombre', 'id');
            $rodeos       = Rodeo::orderBy('id', 'asc')->pluck('nombre', 'id');
            $animales     = null;

        } else {

            $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
            $animales     = Animal::where('empresa_id', $empresaUser->id)->pluck('nombre', 'id');
            $rodeos       = Rodeo::where('empresa_id', $empresaUser->id)
                ->orWhere('empresa_id', null)->orderBy('id', 'asc')->pluck('nombre', 'id');

        }

        return view('backend.sanitarios.new', compact('animales', 'tipoSan', 'trabajadores', 'tipoAp', 'rodeos'));
    }

    public function resumen()
    {
        $empresaUser = Auth::user()->empresaUser();

        if (auth()->user()->hasRole('administrator')) {

            $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
            $animales   = null;
            $sanitarios = Sanitario::all();

        } else {

            $empresas   = null;
            $animales   = Animal::where('empresa_id', $empresaUser->id)->pluck('nombre', 'id');
            $sanitarios = Sanitario::whereHas('animal', function ($query) use ($empresaUser) {
                $query->where('empresa_id', $empresaUser->id);
            })->orderBy('id', 'desc')->get();

        }

        return view('backend.sanitarios.resumen', compact('animales', 'sanitarios', 'empresas'));

    }

    public function getAnimales(Request $request)
    {
        try {

            $animales = Animal::where('empresa_id', $request['empresa_id'])->get();
            return response()->json($animales);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }

    public function buscar(Request $request)
    {

        if (auth()->user()->hasRole('administrator')) {
            $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

            $animales    = Animal::where('empresa_id', $request->input('animal_id'))->orderBy('nombre', 'asc')->pluck('nombre', 'id');
            $empresaUser = $request->input('empresa_id');

            $find = Sanitario::where('id', '!=', '0');

            $find = Sanitario::whereHas('animal', function ($query) use ($empresaUser) {
                $query->where('empresa_id', $empresaUser);
            });

            $find->when($request->input('sanitario_id') != null, function ($query) use ($request) {
                return $query->where('sanitario_id', $request->input('sanitario_id'));
            });

            $find->when($request->input('fecha_inicio') != null, function ($query) use ($request) {
                return $query->where('fecha_inicio', $request->input('fecha_inicio'));
            });

            $find->when($request->input('fecha_fin') != null, function ($query) use ($request) {
                return $query->where('fecha_termino', $request->input('fecha_fin'));
            });

            $sanitarios = $find->orderBy('id','asc')->get();

        } else {
            $empresas    = null;
            $empresaUser = Auth::user()->empresaUser();

            $animales = Animal::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');

            $find = Sanitario::whereHas('animal', function ($query) use ($empresaUser,$request) {
                $query->where('empresa_id', $empresaUser->id);
            });

            $find->when($request->input('animal_id') != null, function ($query) use ($request) {
                return $query->where('animal_id', $request->input('animal_id'));
            });

            $find->when($request->input('fecha_inicio') != null, function ($query) use ($request) {
                return $query->where('fecha_inicio', $request->input('fecha_inicio'));
            });

            $find->when($request->input('fecha_fin') != null, function ($query) use ($request) {
                return $query->where('fecha_termino', $request->input('fecha_fin'));
            });

            $sanitarios = $find->orderBy('id', 'desc')->get();

        }

        return view('backend.sanitarios.buscar', compact('animales', 'sanitarios', 'empresas', 'request'));

    }

    /*
        Funcion para guardar el sanitario que proviene de la vista new
     */

    public function guardar(GuardarSanitarioRequest  $request)
    {
        try {
            $empresaUser = Auth::user()->empresaUser();

            DB::beginTransaction();
            if ($request->input('tipo_aplicacion') == 1) {
                $sanitario                        = new Sanitario();
                $sanitario->trabajador_id         = $request->input('trabajador_id');
                $sanitario->animal_id             = $request->input('animal_id');
                $sanitario->fecha_inicio          = $request->input('fecha_inicio');
                $sanitario->fecha_termino         = $request->input('fecha_termino');
                $sanitario->tipo_sanitario_id     = $request->input('tipo_sanitario_id');
                $sanitario->nombre                = $request->input('nombre');
                $sanitario->tratamiento_utilizado = $request->input('tratamiento_utilizado');
                $sanitario->dias                  = $request->input('dias');
                $sanitario->comentario            = $request->input('comentarios');
                $sanitario->save();
            }

            if ($request->input('tipo_aplicacion') == 2) {
                $animales = Animal::where('rodeo_id', $request->input('rodeo_id'))
                    ->where('empresa_id', $empresaUser->id)->get();

                foreach ($animales as $animal) {
                    $sanitario                        = new Sanitario();
                    $sanitario->trabajador_id         = $request->input('trabajador_id');
                    $sanitario->animal_id             = $animal->id;
                    $sanitario->fecha_inicio          = $request->input('fecha_inicio');
                    $sanitario->fecha_termino         = $request->input('fecha_termino');
                    $sanitario->tipo_sanitario_id     = $request->input('tipo_sanitario_id');
                    $sanitario->nombre                = $request->input('nombre');
                    $sanitario->tratamiento_utilizado = $request->input('tratamiento_utilizado');
                    $sanitario->dias                  = $request->input('dias');
                    $sanitario->comentario            = $request->input('comentarios');
                    $sanitario->save();

                }

            }

            DB::commit();
            return redirect()->route('admin.sanitarios.resumen')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->route('admin.sanitarios.resumen')->withFlashDanger('Error desconocido por favor intentelo de nuevo si el error persiste contacte a su soporte técnico');
        }

    }

}
