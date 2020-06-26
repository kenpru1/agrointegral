<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Mantencion\StoreMantencionRequest;
use App\Http\Requests\Backend\Mantencion\UpdateMantencionRequest;
use App\Models\ClienteProveedor;
use App\Models\Empresa;
use App\Models\FacturaRecibida;
use App\Models\Mantencion;
use App\Models\Maquinaria;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MantencionesController extends Controller
{

    public function index(Maquinaria $maquinaria)
    {
        $mantenciones = $maquinaria->mantenciones;

        return view('backend.mantenciones.index', compact('mantenciones', 'maquinaria'));

    }

    public function create(Maquinaria $maquinaria)
    {
         $empresaUser = Auth::user()->empresaUser();
        if (auth()->user()->hasRole('administrator')) {
           
            $facturas    = FacturaRecibida::orderBy('id', 'asc')->pluck('ref', 'id');
            $clienProv = ClienteProveedor::where('proveedor', 1)->pluck('nombre_razon', 'id');
        } else {
            
            $facturas    = FacturaRecibida::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('ref', 'id');
            $clienProv = ClienteProveedor::where('proveedor', 1)->where('empresa_id',$empresaUser->id)->pluck('nombre_razon', 'id');
        }
        $facturado = ['1' => 'Con Factura', '0' => 'Sin Factura'];
        
        return view('backend.mantenciones.create', compact('maquinaria', 'clienProv','facturado','facturas'));
    }

    public function new () {
        $empresaUser = Auth::user()->empresaUser();

        $facturado = ['1' => 'Con Factura', '0' => 'Sin Factura'];

        if (auth()->user()->hasRole('administrator')) {
            $maquinarias = Maquinaria::orderBy('nombre', 'asc')->pluck('nombre', 'id');
            $facturas    = FacturaRecibida::orderBy('id', 'asc')->pluck('ref', 'id');
            $clienProv = ClienteProveedor::where('proveedor', 1)->pluck('nombre_razon', 'id');
        } else {
            $maquinarias = Maquinaria::where('empresa_id', $empresaUser->id)->pluck('nombre', 'id');
            $facturas    = FacturaRecibida::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('ref', 'id');
            $clienProv = ClienteProveedor::where('proveedor', 1)->where('empresa_id',$empresaUser->id)->pluck('nombre_razon', 'id');
        }

        
        return view('backend.mantenciones.new', compact('maquinarias', 'clienProv', 'facturado', 'facturas'));
    }

    public function store(StoreMantencionRequest $request)
    {
        try {

            DB::beginTransaction();
            $mantencion                       = new Mantencion();
            $mantencion->descripcion          = $request->input('descripcion');
            $mantencion->observaciones        = $request->input('observaciones');
            $mantencion->fecha                = $request->input('fecha');
            $mantencion->costo                = number_format($request->input('costo'), 0, '', '');
            $mantencion->iva                  = number_format($request->input('iva'), 0, '', '');
            $mantencion->total_iva            = number_format($request->input('total_iva'), 0, '', '');
            $mantencion->maquinaria_id        = $request->input('maquinaria_id');
            $mantencion->cliente_proveedor_id = $request->input('cliente_proveedor_id');
            $mantencion->factura_recibida_id = $request->input('factura_recibida_id');
            $mantencion->save();
            DB::commit();
            return redirect()->route('admin.mantenciones.index', $request->input('maquinaria_id'))->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.mantenciones.index', $request->input('maquinaria_id'))->withFlashDanger('Error desconocido por favor intentelo de nuevo si el error persiste contacte a su soporte técnico');
        }

    }

     public function show(Mantencion $mantencion)
    {
         $empresaUser = Auth::user()->empresaUser();
        if (auth()->user()->hasRole('administrator')) {
           
            $facturas    = FacturaRecibida::orderBy('id', 'asc')->pluck('ref', 'id');
            $clienProv = ClienteProveedor::where('proveedor', 1)->pluck('nombre_razon', 'id');
        } else {
            
            $facturas    = FacturaRecibida::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('ref', 'id');
            $clienProv = ClienteProveedor::where('proveedor', 1)->where('empresa_id',$empresaUser->id)->pluck('nombre_razon', 'id');
        }
        $facturado = ['1' => 'Con Factura', '2' => 'Sin Factura'];
        
        return view('backend.mantenciones.show', compact('mantencion', 'clienProv','facturado','facturas'));
    }

    public function edit(Mantencion $mantencion)
    {
         $empresaUser = Auth::user()->empresaUser();
        if (auth()->user()->hasRole('administrator')) {
           
            $facturas    = FacturaRecibida::orderBy('id', 'asc')->pluck('ref', 'id');
            $clienProv = ClienteProveedor::where('proveedor', 1)->pluck('nombre_razon', 'id');
        } else {
            
            $facturas    = FacturaRecibida::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('ref', 'id');
            $clienProv = ClienteProveedor::where('proveedor', 1)->where('empresa_id',$empresaUser->id)->pluck('nombre_razon', 'id');
        }
        $facturado = ['1' => 'Con Factura', '2' => 'Sin Factura'];
     
        return view('backend.mantenciones.edit', compact('mantencion', 'clienProv','facturado','facturas'));
    }

    public function update(UpdateMantencionRequest $request, Mantencion $mantencion)
    {
        //dd($request);

        try {
            DB::beginTransaction();
            $mantencion->descripcion          = $request->input('descripcion');
            $mantencion->observaciones        = $request->input('observaciones');
            $mantencion->fecha                = $request->input('fecha');
            $mantencion->costo                = str_replace('.', '', $request->input('costo'));
            $mantencion->iva                  = str_replace('.', '', $request->input('iva'));
            $mantencion->total_iva            = str_replace('.', '', $request->input('total_iva'));
            $mantencion->cliente_proveedor_id = $request->input('cliente_proveedor_id');
            $mantencion->factura_recibida_id = $request->input('factura_recibida_id');

            $mantencion->save();
            DB::commit();
            return redirect()->route('admin.mantenciones.index', $mantencion->maquinaria->id)->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->route('admin.mantenciones.index', $mantencion->maquinaria->id)->withFlashSuccess('Error desconocido por favor intentelo de nuevo si el error persiste contacte a su soporte técnico');
        }

    }

    public function destroy(Mantencion $mantencion)
    {
        try {
            DB::beginTransaction();
            $mantencion->delete();
            DB::commit();
            return redirect()->route('admin.mantenciones.index', $mantencion->maquinaria->id)->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.mantenciones.index', $mantencion->maquinaria->id)->withFlashSuccess('Error Inesperado');
        }

    }

    public function resumen()
    {
        $empresaUser = Auth::user()->empresaUser();

        if (auth()->user()->hasRole('administrator')) {

            $empresas    = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
            $maquinarias = null;
            $mantenciones  = Mantencion::all()->last();

        } else {

            $empresas    = null;
            $maquinarias = Maquinaria::where('empresa_id', $empresaUser->id)->pluck('nombre', 'id');
            $mantenciones  = Mantencion::whereHas('maquinaria', function ($query) use ($empresaUser) {
                $query->where('empresa_id', $empresaUser->id);
            })->orderBy('id', 'desc')->get();

        }

        return view('backend.mantenciones.resumen', compact('maquinarias', 'mantenciones', 'empresas'));

    }

    public function buscar(Request $request)
    {

        if (auth()->user()->hasRole('administrator')) {
            $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

            $maquinarias = Maquinaria::where('empresa_id', $request->input('empresa_id'))->orderBy('nombre', 'asc')->pluck('nombre', 'id');
            $empresaUser = $request->input('empresa_id');

            $mantenciones = Mantencion::where('id', '!=', '0');

            if ($request->input('maquinaria_id') != null) {
                $mantenciones = Mantencion::where('maquinaria_id', $request->input('maquinaria_id'));
            }

            if ($request->input('fecha_inicio') != null) {
                $mantenciones = $mantenciones->where('fecha', '>=', $request->input('fecha_inicio'));
            }

            if ($request->input('fecha_fin') != null) {
                $mantenciones = $mantenciones->where('fecha', '<=', $request->input('fecha_fin'));
            }

            $mantenciones = $mantenciones->get();

        } else {
            $empresas=null;
            $empresaUser = Auth::user()->empresaUser();

            $maquinarias = Maquinaria::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');

            $mantenciones = Mantencion::whereHas('maquinaria', function ($query) use ($empresaUser) {
                $query->where('empresa_id', $empresaUser->id);
            });

            if ($request->input('maquinaria_id') != null) {
                $mantenciones = Mantencion::where('maquinaria_id', $request->input('maquinaria_id'));
            }

            if ($request->input('fecha_inicio') != null) {
                $mantenciones = $mantenciones->where('fecha', '>=', $request->input('fecha_inicio'));
            }

            if ($request->input('fecha_fin') != null) {
                $mantenciones = $mantenciones->where('fecha', '<=', $request->input('fecha_fin'));
            }

            $mantenciones = $mantenciones->get();

        }

        return view('backend.mantenciones.buscar', compact('maquinarias', 'mantenciones', 'empresas', 'request'));

    }

    public function getMaquinarias(Request $request)
    {
        try {

            $maquinarias = Maquinaria::where('empresa_id', $request['empresa_id'])->get();
            return response()->json($maquinarias);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }

    public function getFacturaDetalles(Request $request)
    {
        try {

            $factura                 = FacturaRecibida::find($request['factura_recibida_id']);
            $factura['nombre_razon'] = $factura->cliente_proveedor->nombre_razon;
            return response()->json($factura);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }

}
