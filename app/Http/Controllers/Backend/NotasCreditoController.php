<?php

namespace App\Http\Controllers\Backend;

use App\Models\NotaCredito;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class NotasCreditoController extends Controller
{
    public function index()
    {
    	$empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) {
                
        	$notas = $empresaUser->empresaNotasCredito;
        
    	}
    	else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
        return view('backend.notascredito.index', compact('notas', 'empresaUser'));
    }

    public function print(Request $request, NotaCredito $nota)
    {
    	$empresaUser = Auth::user()->empresaUser();
        $empresa=Empresa::find($empresaUser->id);

        $pdf = PDF::loadView('backend.notascredito.pdf',compact(
                'nota',
                'empresa'
            ) );
            return $pdf->stream('nota_credito.pdf');
    }

    public function show(Request $request, NotaCredito $nota)
    {
    	$empresaUser = Auth::user()->empresaUser();
        $empresa=Empresa::find($empresaUser->id);
      
    	return view('backend.notascredito.show', compact('nota','empresa')); 	
    }
}
