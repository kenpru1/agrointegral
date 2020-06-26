<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Celo\StoreCeloRequest;
use App\Http\Requests\Backend\Celo\UpdateCeloRequest;
use App\Models\Animal;
use App\Models\Celo;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CelosController extends Controller
{
    public function index(Request $request)
    {

        $empresaUser = Auth::user()->empresaUser();
        
        if ($empresaUser != null) {
            //Si el usuario es administrador puede ver todos los lotes
            if (auth()->user()->hasRole('administrator')) {
                if ($request->isMethod('get')) {
                    $celos = Celo::orderBy('id', 'desc')->get();
                }
                $animales = Animal::orderBy('id', 'desc')->pluck('nombre', 'id');
            } else {

                $animales = Animal::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->pluck('nombre', 'id');

                if ($request->isMethod('get')) {

                    $celos = Celo::whereHas('animal', function ($query) use ($empresaUser) {
                        $query->where('empresa_id', $empresaUser->id);
                    })->orderBy('id', 'desc')->get();

                }

                if ($request->isMethod('post')) {

                    $find = Celo::whereHas('animal', function ($query) use ($empresaUser) {
                        $query->where('empresa_id', $empresaUser->id);
                    });

                    $find->when($request->input('animal_id') != null, function ($query) use ($request) {
                        return $query->where('animal_id', $request->input('animal_id'));
                    });

                    $find->when($request->input('fecha_deteccion') != null, function ($query) use ($request) {
                        return $query->where('fecha_deteccion','>=', $request->input('fecha_deteccion'));
                    });

                   

                    $celos = $find->orderBy('id','asc')->get();

                }

                

            }

            return view('backend.celos.index', compact('celos', 'animales'));

        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function create()
    {
        $empresaUser = Auth::user()->empresaUser();

        if (auth()->user()->hasRole('administrator')) {

            $animales = Animal::orderBy('id', 'asc')->where('sexo_id', 2)->pluck('nombre', 'id');

        } else {

            $animales = Animal::where('empresa_id', $empresaUser->id)->where('sexo_id', 2)->orderBy('id', 'asc')->pluck('nombre', 'id');

        }

        return view('backend.celos.create', compact('animales'));
    }


    public function new(Animal $animal)


    {

        $empresaUser = Auth::user()->empresaUser();

        if (auth()->user()->hasRole('administrator')) {

            $animales = Animal::orderBy('id', 'asc')->where('sexo_id', 2)->pluck('nombre', 'id');

        } else {

            $animales = Animal::where('empresa_id', $empresaUser->id)->where('sexo_id', 2)->orderBy('id', 'asc')->pluck('nombre', 'id');

        }

        return view('backend.celos.new', compact('animales','animal'));
    }

    public function store(StoreCeloRequest $request)
    {
        try {
            DB::beginTransaction();
            $celo                  = new Celo();
            $celo->animal_id       = $request->input('animal_id');
            $celo->fecha_deteccion = $request->input('fecha_deteccion');
            $celo->observaciones   = $request->input('observaciones');
            $celo->save();
            DB::commit();
            return redirect()->route('admin.celos.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.celos.index')->withFlashDanger('Error Inesperado');
        }

    }

    public function update(UpdateCeloRequest $request, Celo $celo)
    {
        try {
            DB::beginTransaction();
            $celo->animal_id       = $request->input('animal_id');
            $celo->fecha_deteccion = $request->input('fecha_deteccion');
            $celo->observaciones   = $request->input('observaciones');
            $celo->save();
            DB::commit();
            return redirect()->route('admin.celos.index')->withFlashSuccess('Registro creado con éxito');

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.celos.index')->withFlashDanger('Error Inesperado');
        }
    }

    public function edit(Celo $celo)
    {

        return view('backend.celos.edit', compact('celo'));
    }

    public function show(Celo $celo)
    {

        return view('backend.celos.show', compact('celo'));
    }

    public function destroy(Celo $celo)
    {
        try {
            DB::beginTransaction();
            $celo->delete();
            DB::commit();
            return redirect()->route('admin.celos.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.sanitarios.index')->withFlashDanger('Error Inesperado');
        }

    }

}
