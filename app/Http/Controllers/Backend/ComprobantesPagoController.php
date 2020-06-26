<?php

namespace App\Http\Controllers\Backend;

use App\Models\Trabajador;
use App\Models\Empresa;
use App\Models\ComprobantePago;
use App\Models\DetalleComprobantePago;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\ComprobantePago\ManageComprobantePagoRequest;
use App\Http\Requests\Backend\ComprobantePago\StoreComprobantePagoRequest;
use App\Http\Requests\Backend\ComprobantePago\UpdateComprobantePagoRequest;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class ComprobantesPagoController extends Controller
{
    public function index()
    {
    	$empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) 
        {               
        	$comprobantes = $empresaUser->empresaComprobantes;      
	    }
	    else 
	    {
	        return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
	    }
	    
	    return view('backend.comprobantes.index', compact('comprobantes'));
	}

	public function create()
	{
		$empresaUser = Auth::user()->empresaUser();

		$trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		$nroCo = $empresaUser->empresaComprobantes->count();
        
        if($nroCo == null)
            $nroCo = 1;

        $nroProv = 'CO' . $nroCo;

		return view('backend.comprobantes.create', compact('trabajadores', 'nroProv'));
	}

	public function store(StoreComprobantePagoRequest $request)
	{
		try {
			DB::beginTransaction();

			$input = $request->all();

			$comprobante = new ComprobantePago();
			$comprobante->trabajador_id = $request->input('trabajador_id');
			$comprobante->numero = $comprobante->getNro();
			$comprobante->fecha_pago = $request->input('fecha_pago');
			$comprobante->total = $request->input('total_comprobante');
			$comprobante->save();

			for ($i = 0; $i < (intval($input['numero_trabajos'])); $i++) { 
				$detalle = new DetalleComprobantePago();
				$detalle->comprobante_pago_id = $comprobante->id;
				$detalle->trabajo_realizado = $input['trabajo_realizado_array'][$i];
				$detalle->total = $input['total_array'][$i];
				$detalle->save();
			}

			DB::commit();

			return redirect()->route('admin.comprobantes.index')->withFlashSuccess('Registro creado con éxito');
		} 
		catch (\Exception $e) {
			dd($e);
            DB::rollback();
            return redirect()->route('admin.comprobantes.index')->withFlashDanger('Error Inesperado');
		}
	}

	public function edit(ManageComprobantePagoRequest $request, ComprobantePago $comprobante)
	{
		$empresaUser = Auth::user()->empresaUser();

		$trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

		return view('backend.comprobantes.edit', compact('trabajadores', 'comprobante'));
	}

	public function update(UpdateComprobantePagoRequest $request, ComprobantePago $comprobante)
	{
		try {
			DB::beginTransaction();
			$input = $request->all();

			$comprobante->trabajador_id = $request->input('trabajador_id');
			$comprobante->fecha_pago = $request->input('fecha_pago');
			$comprobante->total = $request->input('total_comprobante');
			$comprobante->save();

			DB::table('detalle_comprobantes')->where('comprobante_pago_id', $comprobante->id)->delete();

			for ($i = 0; $i < (intval($input['numero_trabajos'])); $i++) { 
				$detalle = new DetalleComprobantePago();
				$detalle->comprobante_pago_id = $comprobante->id;
				$detalle->trabajo_realizado = $input['trabajo_realizado_array'][$i];
				$detalle->total = $input['total_array'][$i];
				$detalle->save();
			}

			DB::commit();
			return redirect()->route('admin.comprobantes.index')->withFlashSuccess('Registro editado con éxito');
		} 
		catch (\Exception $e) {
			dd($e);
            DB::rollback();
            return redirect()->route('admin.comprobantes.index')->withFlashDanger('Error Inesperado');
		}
	}

	public function show(ManageComprobantePagoRequest $request, ComprobantePago $comprobante)
	{
		$empresaUser = Auth::user()->empresaUser();
		$empresa = Empresa::find($empresaUser->id);

		return view('backend.comprobantes.show', compact('comprobante', 'empresa'));
	}

	public function destroy(ManageComprobantePagoRequest $request, ComprobantePago $comprobante){
		try {
			DB::beginTransaction();

			/*$detalles = DetalleComprobantePago::where('comprobante_pago_id', $comprobante->id)->get();

			foreach ($detalles as $detalle) {
				$detalle->delete();
			}*/

			$comprobante->delete();

			DB::commit();
			
			return redirect()->route('admin.comprobantes.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
		} 
		catch (\Exception $e) {
			DB::rollback();
            return redirect()->route('admin.comprobantes.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
		}
		
	}

	public function print(ManageComprobantePagoRequest $request, ComprobantePago $comprobante){
		$empresaUser = Auth::user()->empresaUser();
        $empresa=Empresa::find($empresaUser->id);

        $pdf = PDF::loadView('backend.comprobantes.pdf',compact(
                'comprobante',
                'empresa'
            ) );
            return $pdf->stream('comprobante.pdf');
	}
}
