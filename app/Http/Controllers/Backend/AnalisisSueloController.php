<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AnalisisSuelo\ManageAnalisisSueloRequest;
use App\Http\Requests\Backend\AnalisisSuelo\StoreAnalisisSueloRequest;
use App\Http\Requests\Backend\AnalisisSuelo\UpdateAnalisisSueloRequest;
use App\Models\AnalisisSuelo;
use App\Models\Auth\User;
use App\Models\Campo;
use App\Models\Cuartel;
use App\Models\Empresa;
use App\Models\Unidad;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnalisisSueloController extends Controller
{
    public function index()
    {

        $empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) {
            //Si el usuario es administrador puede ver todos los lotes
            if (auth()->user()->hasRole('administrator')) {

                $analisis = AnalisisSuelo::orderBy('id','desc')->get();
            } else {
                $analisis = AnalisisSuelo::where('empresa_id', $empresaUser->id)->orderBy('id','desc')->get();

            }

            return view('backend.analisis_suelo.index', compact('analisis'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }

    }

    public function create(ManageAnalisisSueloRequest $request)
    {

        $empresaUser = Auth::user()->empresaUser();

        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $unidades = Unidad::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        if (auth()->user()->hasRole('administrator')) {
            $campos = Campo::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        } else {
            $campos = Campo::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        }

        return view('backend.analisis_suelo.create', compact('unidades', 'campos', 'empresas'));

    }

    public function store(StoreAnalisisSueloRequest $request)
    {
        try {
            DB::beginTransaction();

            $analisis                 = new AnalisisSuelo();
            $analisis->fecha          = $request->input('fecha');
            $analisis->unidad_id      = $request->input('unidad_id');
            $analisis->cuartel_id     = $request->input('cuartel_id');
            $analisis->prof_desde     = $request->input('prof_desde');
            $analisis->prof_hasta     = $request->input('prof_hasta');
            $analisis->sector         = $request->input('sector');
            $analisis->ph             = $request->input('ph');
            $analisis->n              = $request->input('n');
            $analisis->p              = $request->input('p');
            $analisis->k              = $request->input('k');
            $analisis->s              = $request->input('s');
            $analisis->mg             = $request->input('mg');
            $analisis->na             = $request->input('na');
            $analisis->ca             = $request->input('ca');
            $analisis->c              = $request->input('c');
            $analisis->nitro_organico = $request->input('nitro_organico');
            $analisis->no3            = $request->input('no3');
            $analisis->rel_cn         = $request->input('rel_cn');
            $analisis->mat_organica   = $request->input('mat_organica');
            $analisis->arcilla        = $request->input('arcilla');
            $analisis->arena          = $request->input('arena');
            $analisis->limo           = $request->input('limo');
            $analisis->cond_electrica = $request->input('cond_electrica');
            $analisis->humedad        = $request->input('humedad');
            $analisis->observaciones  = $request->input('observaciones');

            if (auth()->user()->hasRole('administrator')) {
                $analisis->empresa_id = $request->input('empresa_id');

            } else {
                $empresaUser          = Auth::user()->empresaUser();
                $analisis->empresa_id = $empresaUser->id;

            }
            $analisis->save();
            DB::commit();
            return redirect()->route('admin.analisis_suelo.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.analisis_suelo.index')->withFlashDanger('Error Inesperado');
        }

    }

    public function edit(ManageAnalisisSueloRequest $request, AnalisisSuelo $analisis)
    {

        $empresaUser = Auth::user()->empresaUser();

        $empresas  = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $unidades  = Unidad::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $cuarteles = Cuartel::where('campo_id', $analisis->cuartel->campo_id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        if (auth()->user()->hasRole('administrator')) {
            //$campos = Campo::orderBy('nombre', 'asc')->pluck('nombre', 'id');
            $campos = Campo::where('empresa_id', $analisis->empresa_id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        } else {
            $campos = Campo::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        }

        return view('backend.analisis_suelo.edit', compact('unidades', 'campos', 'empresas', 'analisis', 'cuarteles'));

    }

    public function update(UpdateAnalisisSueloRequest $request, AnalisisSuelo $analisis)
    {
        try {
            DB::beginTransaction();
            $analisis->fecha          = $request->input('fecha');
            $analisis->unidad_id      = $request->input('unidad_id');
            $analisis->cuartel_id     = $request->input('cuartel_id');
            $analisis->prof_desde     = $request->input('prof_desde');
            $analisis->prof_hasta     = $request->input('prof_hasta');
            $analisis->sector         = $request->input('sector');
            $analisis->ph             = $request->input('ph');
            $analisis->n              = $request->input('n');
            $analisis->p              = $request->input('p');
            $analisis->k              = $request->input('k');
            $analisis->s              = $request->input('s');
            $analisis->mg             = $request->input('mg');
            $analisis->na             = $request->input('na');
            $analisis->ca             = $request->input('ca');
            $analisis->c              = $request->input('c');
            $analisis->nitro_organico = $request->input('nitro_organico');
            $analisis->no3            = $request->input('no3');
            $analisis->rel_cn         = $request->input('rel_cn');
            $analisis->mat_organica   = $request->input('mat_organica');
            $analisis->arcilla        = $request->input('arcilla');
            $analisis->arena          = $request->input('arena');
            $analisis->limo           = $request->input('limo');
            $analisis->cond_electrica = $request->input('cond_electrica');
            $analisis->humedad        = $request->input('humedad');
            $analisis->observaciones  = $request->input('observaciones');

            if (auth()->user()->hasRole('administrator')) {
                $analisis->empresa_id = $request->input('empresa_id');
            } else {
                $empresaUser          = Auth::user()->empresaUser();
                $analisis->empresa_id = $empresaUser->id;

            }
            $analisis->save();
            DB::commit();
            return redirect()->route('admin.analisis_suelo.index')->withFlashSuccess('Registro editado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.bodegas.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function show(ManageAnalisisSueloRequest $request, AnalisisSuelo $analisis)
    {

        $empresaUser = Auth::user()->empresaUser();

        $empresas  = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $unidades  = Unidad::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $cuarteles = Cuartel::where('campo_id', $analisis->cuartel->campo_id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        if (auth()->user()->hasRole('administrator')) {
            //$campos = Campo::orderBy('nombre', 'asc')->pluck('nombre', 'id');
            $campos = Campo::where('empresa_id', $analisis->empresa_id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        } else {
            $campos = Campo::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        }

        return view('backend.analisis_suelo.show', compact('unidades', 'campos', 'empresas', 'analisis', 'cuarteles'));

    }

    public function destroy(ManageAnalisisSueloRequest $request, AnalisisSuelo $analisis)
    {
        try {
            DB::beginTransaction();
            $analisis->delete();
            DB::commit();
            return redirect()->route('admin.analisis_suelo.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.analisis_suelo.index')->withFlashSuccess('Error Inesperado');
        }

    }

    public function getCuarteles(Request $request)
    {
        try {

            $cuarteles = Cuartel::where('campo_id', $request['campo_id'])->get();
            return response()->json($cuarteles);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }

    public function getCampos(Request $request)
    {
        try {

            $campos = Campo::where('empresa_id', $request['empresa_id'])->get();
            return response()->json($campos);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }
}
