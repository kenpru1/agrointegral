<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Animal\ManagAnimalRequest;
use App\Http\Requests\Backend\Animal\StoreAnimalRequest;
use App\Http\Requests\Backend\Animal\UpdateAnimalRequest;
use App\Models\Animal;
use App\Models\Especie;
use App\Models\Rodeo;
use App\Models\Sexo;
use App\Models\Sanitario;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimalesController extends Controller
{

    public function index()
    {

        $empresaUser = Auth::user()->empresaUser();
        $empresa_id=$empresaUser->id;
        if ($empresaUser != null) {
            //Si el usuario es administrador puede ver todos los lotes
            if (auth()->user()->hasRole('administrator')) {

                $animales = Animal::orderBy('id', 'desc')->get();
            } else {
                $animales = Animal::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();

            }

            $rodeos = Rodeo::where('empresa_id', $empresaUser->id)
                ->orWhere('empresa_id',null)->orderBy('id', 'asc')->get();

                             

            return view('backend.animales.index', compact('animales','rodeos','empresa_id'));

        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function create()
    {
        $empresaUser = Auth::user()->empresaUser();

        $especies = Especie::where('empresa_id', $empresaUser->id)
            ->orWhere('empresa_id', null)
            ->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        $rodeos = Rodeo::where('empresa_id', $empresaUser->id)
            ->orWhere('empresa_id', null)
            ->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        $sexos = Sexo::orderBy('id', 'asc')->pluck('nombre', 'id');

        return view('backend.animales.create', compact('especies', 'rodeos', 'sexos'));
    }

    public function store(StoreAnimalRequest $request)
    {

        $empresaUser = Auth::user()->empresaUser();

        try {
            DB::beginTransaction();
            $animal                      = new Animal();
            $animal->caravana            = $request->input('caravana');
            $animal->nombre              = $request->input('nombre');
            $animal->especie_id          = $request->input('especie_id');
            $animal->raza                = $request->input('raza');
            $animal->categoria_pedigree  = $request->input('categoria_pedigree');
            $animal->sexo_id             = $request->input('sexo_id');
            $animal->fecha_nacimiento    = $request->input('fecha_nacimiento');
            $animal->peso_nacer          = $request->input('peso_nacer');
            $animal->caravana_madre      = $request->input('caravana_madre');
            $animal->nombre_madre        = $request->input('nombre_madre');
            $animal->caravana_progenitor = $request->input('caravana_progenitor');
            $animal->nombre_progenitor   = $request->input('nombre_progenitor');
            $animal->indice_corporal     = $request->input('indice_corporal');
            $animal->rodeo_id            = $request->input('rodeo_id');
            $animal->observaciones       = $request->input('observaciones');
            $animal->codigo_rfid         = $request->input('codigo_rfid');
            $animal->fecha_muerte        = $request->input('fecha_muerte');
            $animal->empresa_id          = $empresaUser->id;
            $animal->save();
            DB::commit();
            return redirect()->route('admin.animales.index')->withFlashSuccess('Registro editado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.animales.index')->withFlashDanger('Error Inesperado');
        }

    }


    public function edit(Animal $animal)
    {
        $empresaUser = Auth::user()->empresaUser();

        $especies = Especie::where('empresa_id', $empresaUser->id)
            ->orWhere('empresa_id', null)
            ->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        $rodeos = Rodeo::where('empresa_id', $empresaUser->id)
            ->orWhere('empresa_id', null)
            ->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        $sexos = Sexo::orderBy('id', 'asc')->pluck('nombre', 'id');

        return view('backend.animales.edit', compact('especies', 'rodeos', 'sexos','animal'));
    }


    public function update(UpdateAnimalRequest $request, Animal $animal)
    {

        $empresaUser = Auth::user()->empresaUser();

        try {
            DB::beginTransaction();
            
            $animal->caravana            = $request->input('caravana');
            $animal->nombre              = $request->input('nombre');
            $animal->especie_id          = $request->input('especie_id');
            $animal->raza                = $request->input('raza');
            $animal->categoria_pedigree  = $request->input('categoria_pedigree');
            $animal->sexo_id             = $request->input('sexo_id');
            $animal->fecha_nacimiento    = $request->input('fecha_nacimiento');
            $animal->peso_nacer          = $request->input('peso_nacer');
            $animal->caravana_madre      = $request->input('caravana_madre');
            $animal->nombre_madre        = $request->input('nombre_madre');
            $animal->caravana_progenitor = $request->input('caravana_progenitor');
            $animal->nombre_progenitor   = $request->input('nombre_progenitor');
            $animal->indice_corporal     = $request->input('indice_corporal');
            $animal->rodeo_id            = $request->input('rodeo_id');
            $animal->observaciones       = $request->input('observaciones');
            $animal->codigo_rfid         = $request->input('codigo_rfid');
            $animal->fecha_muerte        = $request->input('fecha_muerte');
            $animal->empresa_id          = $empresaUser->id;
            $animal->save();
            DB::commit();
            return redirect()->route('admin.animales.index')->withFlashSuccess('Registro editado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.animales.index')->withFlashDanger('Error Inesperado');
        }

    }


    public function show(Animal $animal)
    {
        $empresaUser = Auth::user()->empresaUser();

        $especies = Especie::where('empresa_id', $empresaUser->id)
            ->orWhere('empresa_id', null)
            ->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        $rodeos = Rodeo::where('empresa_id', $empresaUser->id)
            ->orWhere('empresa_id', null)
            ->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        $sexos = Sexo::orderBy('id', 'asc')->pluck('nombre', 'id');

        return view('backend.animales.show', compact('especies', 'rodeos', 'sexos','animal'));
    }


    public function destroy(Animal $animal)
    {
        try {
            DB::beginTransaction();
            $animal->delete();
            DB::commit();
            return redirect()->route('admin.animales.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.animales.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }


}
