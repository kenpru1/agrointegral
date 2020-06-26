<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comuna;
use App\Models\PreRegistro;
use App\Models\Provincia;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\PreRegistro\PreRegistroRequest;

use DB;
class PreRegistroController extends Controller
{
    public function index()
    {

        $provincias = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $rubros     = array('Agrícola' => 'Agrícola', 'Ganadero' => 'Ganadero', 'Viticultor' => 'Viticultor', 'Venta agroinsumos' => 'Venta agroinsumos', 'Servicios Agrícolas' => 'Servicios Agrícolas', 'Otros' => 'Otros');

        return view('frontend.pre_registro.index', compact('provincias', 'rubros'));
    }

    public function store(PreRegistroRequest $request)
    {
        try {
        	
            DB::beginTransaction();
            $pre               = new PreRegistro();
            $pre->nombre       = $request->input('nombre');
            $pre->celular      = $request->input('celular');
            $pre->email        = $request->input('email');
            $pre->comuna_id    = $request->input('comuna_id');
            $pre->provincia_id = $request->input('provincia_id');
            $pre->rubro        = $request->input('rubro');
            $pre->save();

          
            DB::commit();
            return redirect('preregistro')->withFlashSuccess('Estás registrado!, serás de los primeros en disfrutar Proterra.');
        } catch (\Exception $e) {

            DB::rollback();
            return redirect('preregistro')->withFlashDanger('Error Por Favor Intente de Nuevo.');
        }
    }

    public function getComunas(Request $request)
    {
        try {

            $comunas = Comuna::where('provincia_id', $request['provincia_id'])->get();
            return response()->json($comunas);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }
}
