<?php

namespace App\Http\Controllers\Backend;

use App\Models\FacturaRecibida;
use App\Models\TipoPago;
use App\Models\EstadoFactura;
use App\Models\Empresa;
use App\Models\ClienteProveedor;
use App\Models\Comuna;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\FacturaRecibida\ManageFacturaRecibidaRequest;
use App\Http\Requests\Backend\FacturaRecibida\StoreFacturaRecibidaRequest;
use App\Http\Requests\Backend\FacturaRecibida\UpdateFacturaRecibidaRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class FacturasRecibidasController extends Controller
{
    /*public function index()
    {
    	$empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) 
        {
                
        	$facturas_recibidas = FacturaRecibida::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();     
    	}
    	else 
    	{
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }

    	return view('backend.facturas_recibidas.index', compact('facturas_recibidas'));
    }*/

    public function create(ManageFacturaRecibidaRequest $request)
    {
    	$empresaUser = Auth::user()->empresaUser();
    	$tipoPago = TipoPago::orderBy('id', 'asc')->pluck('nombre', 'id');
        $tercero = ClienteProveedor::where('empresa_id',$empresaUser->id)->where('proveedor',1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');
        $comunas = Comuna::orderBy('nombre', 'asc')->pluck('nombre', 'id');

       

    	return view('backend.facturas_recibidas.create', compact('tipoPago','tercero','comunas'));
    }

    public function store(StoreFacturaRecibidaRequest $request)
    {
    	try
    	{
    		DB::beginTransaction();

    		$empresaUser = Auth::user()->empresaUser();

    		$factura_recibida = new FacturaRecibida();
    		$factura_recibida->empresa_id = $empresaUser->id;
    		$factura_recibida->ref = $request->input('ref');
    		$factura_recibida->ref_vendedor = $request->input('ref_vendedor');
    		$factura_recibida->fecha_emision = $request->input('fecha_emision');
    		$factura_recibida->fecha_vence = $request->input('fecha_vence');
    		$factura_recibida->cliente_proveedor_id = $request->input('cliente_proveedor_id');
    		$factura_recibida->comuna_id = $request->input('comuna_id');
    		$factura_recibida->codigo_postal = $request->input('codigo_postal');
    		$factura_recibida->tipo_pago_id = $request->input('tipo_pago_id');
    		$factura_recibida->monto_neto = $request->input('monto_neto');
            $factura_recibida->porcentaje_iva = $request->input('porc_iva');
            $factura_recibida->iva = $request->input('iva');
            $factura_recibida->excenta = $request->input('excenta');
            $factura_recibida->total = $request->input('total');
    		$factura_recibida->estado_factura_id = 4;
    		$factura_recibida->save();

    		DB::commit();

    		return redirect()->route('admin.facturas.index')->withFlashSuccess('Registro creado con éxito');
    	}
    	catch (\Exception $e) 
    	{
        	dd($e);
            DB::rollback();

            return redirect()->route('admin.facturas.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function edit(ManageFacturaRecibidaRequest $request, FacturaRecibida $factura_recibida)
    {
    	$empresaUser = Auth::user()->empresaUser();
    	$tipoPago = TipoPago::orderBy('id', 'asc')->pluck('nombre', 'id');
    	$estados  = EstadoFactura::whereNotIn('id', [1])->orderBy('id', 'asc')->pluck('nombre', 'id');
        $tercero = ClienteProveedor::where('empresa_id',$empresaUser->id)->where('proveedor',1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');
        $comunas = Comuna::orderBy('nombre', 'asc')->pluck('nombre', 'id');


    	return view('backend.facturas_recibidas.edit', compact('tipoPago', 'estados', 'factura_recibida','tercero','comunas'));
    }

    public function update(UpdateFacturaRecibidaRequest $request, FacturaRecibida $factura_recibida)
    {
    	try
    	{
    		DB::beginTransaction();

    		$empresaUser = Auth::user()->empresaUser();

    		$factura_recibida->empresa_id = $empresaUser->id;
    		$factura_recibida->ref = $request->input('ref');
    		$factura_recibida->ref_vendedor = $request->input('ref_vendedor');
    		$factura_recibida->fecha_emision = $request->input('fecha_emision');
    		$factura_recibida->fecha_vence = $request->input('fecha_vence');
    		$factura_recibida->cliente_proveedor_id = $request->input('cliente_proveedor_id');
            $factura_recibida->comuna_id = $request->input('comuna_id');
    		$factura_recibida->codigo_postal = $request->input('codigo_postal');
    		$factura_recibida->tipo_pago_id = $request->input('tipo_pago_id');
    		$factura_recibida->monto_neto = $request->input('monto_neto');
            $factura_recibida->porcentaje_iva = $request->input('porc_iva');
            $factura_recibida->iva = $request->input('iva');
            $factura_recibida->total = $request->input('total');
            $factura_recibida->excenta = $request->input('excenta');
    		$factura_recibida->estado_factura_id = $request->input('estado_factura_id');
    		$factura_recibida->save();

    		DB::commit();

    		return redirect()->route('admin.facturas.index')->withFlashSuccess('Registro editado con éxito');
    	}
    	catch (\Exception $e) 
    	{
        	dd($e);
            DB::rollback();

            return redirect()->route('admin.facturas.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function show(ManageFacturaRecibidaRequest $request, FacturaRecibida $factura_recibida)
    {
        
    	$empresaUser = Auth::user()->empresaUser();
        $empresa = Empresa::find($empresaUser->id);
      
    	return view('backend.facturas_recibidas.show', compact('factura_recibida','empresa'));
    }
}
