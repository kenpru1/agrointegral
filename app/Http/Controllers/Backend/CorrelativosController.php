<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Correlativo\ManageCorrelativoRequest;
use App\Http\Requests\Backend\Correlativo\UpdateCorrelativoRequest;

use App\Models\Correlativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CorrelativosController extends Controller
{
    public function index(ManageCorrelativoRequest $request){
    	$empresaUser = Auth::user()->empresaUser();

    	if ($empresaUser != null) {
    		if (auth()->user()->hasRole('administrator')) {

                $correlativos = Correlativo::all();
            } else {
                $correlativos = Correlativo::where('empresa_id', $empresaUser->id)->get();

            }

           return view('backend.correlativos.index', compact('correlativos'));
    	}else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    	
    }

    public function edit(ManageCorrelativoRequest $request, Correlativo $correlativo){

    	return view('backend.correlativos.edit', compact('correlativo'));

    }


    public function update(UpdateCorrelativoRequest $request, Correlativo $correlativo){

    	$correlativo->presupuesto=$request->input('presupuesto');
        $correlativo->factura=$request->input('factura');
        $correlativo->guia_despacho=$request->input('guia_despacho');
    	$correlativo->save();
    	return redirect()->route('admin.correlativos.index')->withFlashSuccess('Registro editado con éxito');

    }
}
