<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\GuiaDespacho\ManageGuiaDespachoRequest;
use App\Http\Requests\Backend\GuiaDespacho\StoreGuiaDespachoRequest;
use App\Http\Requests\Backend\GuiaDespacho\UpdateGuiaDespachoRequest;
use App\Models\ClienteProveedor;
use App\Models\CondicionPago;
use App\Models\Correlativo;
use App\Models\DetalleOrdenCompra;
use App\Models\OrdenCompra;
use App\Models\Producto;
use App\Models\Presupuesto;
use App\Models\EstadoPresupuesto;
use App\Models\Empresa;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class OrdenCompraController extends Controller
{
    public function index(ManageGuiaDespachoRequest $request)
    {

        
    	$empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) {
                
        	$ordenes = OrdenCompra::where('empresa_id', $empresaUser->id)->orderBy('numero', 'id')->get();
        
    }else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
        return view('backend.orden_compra.index', compact('ordenes'));
    }

    public function create(ManageGuiaDespachoRequest $request)
    {

        $empresaUser = Auth::user()->empresaUser();
        //$productos   = Producto::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $clientes    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');


        $nroGuia = OrdenCompra::where('empresa_id', $empresaUser->id)->count();
        
        if($nroGuia==null)
            $nroGuia=1;


        $nroProv = 'ORD' . $nroGuia;

        return view('backend.orden_compra.create', compact('clientes','nroProv'));

    }

    public function store(StoreGuiaDespachoRequest $request)
    {
        try {
            DB::beginTransaction();
            $input       = $request->all();
            $empresaUser = Auth::user()->empresaUser();

            $orden                       = new OrdenCompra();
            $orden->numero               = $orden->getNro();
            $orden->fecha                = $request->input('fecha');
            $orden->cliente_id           = $request->input('cliente_id');
            $orden->nota_publica         = $request->input('nota_publica');
            $orden->nota_privada         = $request->input('nota_privada');
            $orden->sub_total            = $request->input('sub_total');
            $orden->porcentaje_iva       = $request->input('porc_iva');
            $orden->iva                  = $request->input('iva');
            $orden->total                = $request->input('total_guia');
            $orden->empresa_id           = $empresaUser->id;
            $orden->save();

            for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {
                $detalle                 = new DetalleOrdenCompra();
                $detalle->orden_compra_id = $orden->id;
                $detalle->producto    = $input['productos_array'][$i];
                $detalle->cantidad       = $input['cantidad_array'][$i];
                $detalle->precio_venta   = $input['precio_venta_array'][$i];
                $detalle->total          = $input['total_array'][$i];
                $detalle->save();

            }

            DB::commit();
            return redirect()->route('admin.orden_compras.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
        	DB::rollback();
            dd($e);
            return redirect()->route('admin.orden_compras.index')->withFlashSuccess('Error Inesperado');
        }
    }

    
    public function edit(ManageGuiaDespachoRequest $request, OrdenCompra $orden)
    {

        $empresaUser = Auth::user()->empresaUser();
        $clientes    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

        $nroPres = OrdenCompra::where('empresa_id', $empresaUser->id)->count();



        return view('backend.orden_compra.edit', compact('clientes', 'orden'));

    }

    public function update(UpdateGuiaDespachoRequest $request, OrdenCompra $orden)
    {
        
        try {
            DB::beginTransaction();
            $input       = $request->all();
            $empresaUser = Auth::user()->empresaUser();

                       
            $orden->numero               = $orden->getNro();
            $orden->fecha                = $request->input('fecha');
            $orden->cliente_id           = $request->input('cliente_id');
            $orden->nota_publica         = $request->input('nota_publica');
            $orden->nota_privada         = $request->input('nota_privada');
            $orden->sub_total            = $request->input('sub_total');
            $orden->porcentaje_iva       = $request->input('porc_iva');
            $orden->iva                  = $request->input('iva');
            $orden->total                = $request->input('total_guia');
            $orden->empresa_id           = $empresaUser->id;
            $orden->save();

            DB::table('detalle_orden_compra')->where('orden_compra_id', $orden->id)->delete();

            for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {
                $detalle                 = new DetalleOrdenCompra();
                $detalle->orden_compra_id = $orden->id;
                $detalle->producto   = $input['productos_array'][$i];
                $detalle->cantidad       = $input['cantidad_array'][$i];
                $detalle->precio_venta   = $input['precio_venta_array'][$i];
                $detalle->total          = $input['total_array'][$i];
                $detalle->save();

            }

            DB::commit();
            return redirect()->route('admin.orden_compras.index')->withFlashSuccess('Registro editado con éxito');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->route('admin.orden_compras.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function show(ManageGuiaDespachoRequest $request, OrdenCompra $orden)
    {   
        $empresaUser = Auth::user()->empresaUser();
        $empresa=Empresa::find($empresaUser->id);

      
    return view('backend.orden_compra.show', compact('orden','empresa'));     
    }


    public function print(ManageGuiaDespachoRequest $request, OrdenCompra $orden)
    {   
        $empresaUser = Auth::user()->empresaUser();
        $empresa=Empresa::find($empresaUser->id);

        $pdf = PDF::loadView('backend.orden_compra.pdf',compact(
                'orden',
                'empresa'
            ) );
            return $pdf->stream('guia.pdf');

      
         
    }


     

    public function getProductos(Request $request)
    {
        try {

            $producto = Producto::find($request['producto_id']);
            return response()->json($producto);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }
}
