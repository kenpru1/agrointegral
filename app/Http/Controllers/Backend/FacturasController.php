<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Factura\ManageFacturaRequest;
use App\Http\Requests\Backend\Factura\StoreFacturaRequest;
use App\Http\Requests\Backend\Factura\UpdateFacturaRequest;
use App\Http\Requests\Backend\Factura\StorePagoFacturaRequest;
use App\Http\Requests\Backend\Presupuesto\ManagePresupuestoRequest;
use App\Http\Requests\Backend\Presupuesto\StorePresupuestoRequest;
use App\Models\ClienteProveedor;
use App\Models\CondicionPago;
use App\Models\Correlativo;
use App\Models\DetalleFactura;
use App\Models\Fuente;
use App\Models\Factura;
use App\Models\FacturaRecibida;
use App\Models\PagoFactura;
use App\Models\Producto;
use App\Models\TipoPago;
use App\Models\EstadoFactura;
use App\Models\Presupuesto;
use App\Models\NotaCredito;
use App\Models\EstadoPresupuesto;
use App\Models\Empresa;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class FacturasController extends Controller
{
    public function index(ManageFacturaRequest $request)
    {
    	$empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) {

            $facturas = Factura::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();
            $facturas_recibidas = FacturaRecibida::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();
            $clientes = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');
            $terceros = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('proveedor', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');
            $tipoPago = TipoPago::orderBy('id', 'asc')->pluck('nombre', 'id');
            $pestaña = 0;

            if($request->isMethod('get')) {
                return view('backend.facturas.index', compact('facturas', 'facturas_recibidas', 'clientes', 'terceros', 'tipoPago', 'pestaña'));
            }

            if($request->isMethod('post')) {

                if ($request->input('tipo_factura') == 0) {
                    
                    $find = Factura::where('empresa_id', $empresaUser->id);

                    $find->when($request->input('fecha_desde') != null, function ($query) use ($request) {
                        return $query->where('fecha', '>=', $request->input('fecha_desde'));
                    });

                    $find->when($request->input('fecha_hasta') != null, function ($query) use ($request) {
                        return $query->where('fecha', '<=', $request->input('fecha_hasta'));
                    });

                    $find->when($request->input('cliente_id') != null, function ($query) use ($request) {
                        return $query->where('cliente_id', $request->input('cliente_id'));
                    });

                    $find->when($request->input('folio') != null, function ($query) use ($request) {
                        return $query->where('numero', 'like', '%' .$request->input('folio'). '%');
                    });

                    $find->when($request->input('fecha_vence') != null, function ($query) use ($request) {
                        return $query->where('fecha_vencimiento', '=', $request->input('fecha_vence'));
                    });

                    $find->when($request->input('tipo_pago') != null, function ($query) use ($request) {
                        return $query->where('tipo_pago_id', $request->input('tipo_pago'));
                    });

                    $find->when($request->input('total_menor') != null, function ($query) use ($request) {
                        return $query->where('total', '<=', $request->input('total_menor'));
                    });

                    $find->when($request->input('total_mayor') != null, function ($query) use ($request) {
                        return $query->where('total', '>=', $request->input('total_mayor'));
                    });

                    $facturas = $find->orderBy('id', 'asc')->get();

                    return view('backend.facturas.index', compact('facturas', 'facturas_recibidas', 'clientes', 'terceros', 'tipoPago', 'pestaña'));
                }
                if ($request->input('tipo_factura') == 1) {

                    $pestaña = 1;
                    
                    $find = FacturaRecibida::where('empresa_id', $empresaUser->id);

                    $find->when($request->input('fecha_desde') != null, function ($query) use ($request) {
                        return $query->where('fecha_emision', '>=', $request->input('fecha_desde'));
                    });

                    $find->when($request->input('fecha_hasta') != null, function ($query) use ($request) {
                        return $query->where('fecha_emision', '<=', $request->input('fecha_hasta'));
                    });

                    $find->when($request->input('tercero_id') != null, function ($query) use ($request) {
                        return $query->where('cliente_proveedor_id', $request->input('tercero_id'));
                    });

                    $find->when($request->input('ref') != null, function ($query) use ($request) {
                        return $query->where('ref', 'like', '%' .$request->input('ref'). '%');
                    });

                    $find->when($request->input('fecha_vence') != null, function ($query) use ($request) {
                        return $query->where('fecha_vence', '=', $request->input('fecha_vence'));
                    });

                    $find->when($request->input('tipo_pago') != null, function ($query) use ($request) {
                        return $query->where('tipo_pago_id', $request->input('tipo_pago'));
                    });

                    $find->when($request->input('total_menor') != null, function ($query) use ($request) {
                        return $query->where('total', '<=', $request->input('total_menor'));
                    });

                    $find->when($request->input('total_mayor') != null, function ($query) use ($request) {
                        return $query->where('total', '>=', $request->input('total_mayor'));
                    });

                    $facturas_recibidas = $find->orderBy('id', 'asc')->get();

                    return view('backend.facturas.index', compact('facturas', 'facturas_recibidas', 'clientes', 'terceros', 'tipoPago', 'pestaña'));
                }
            }        	     
        }
        else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function create(ManageFacturaRequest $request)
    {

        $empresaUser = Auth::user()->empresaUser();
        $productos   = Producto::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $clientes    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

        $condPago = CondicionPago::orderBy('id', 'asc')->pluck('nombre', 'id');
        $tipoPago = TipoPago::orderBy('id', 'asc')->pluck('nombre', 'id');
        $fuentes  = Fuente::orderBy('id', 'asc')->pluck('nombre', 'id');

        $nroFac = Factura::where('empresa_id', $empresaUser->id)->count();
        
        if($nroFac==null)
            $nroFac=1;


        $nroProv = 'FA' . $nroFac;

        return view('backend.facturas.create', compact('condPago', 'tipoPago', 'fuentes', 'clientes', 'productos', 'nroProv'));

    }

    public function store(StoreFacturaRequest $request)
    {
        try {
            DB::beginTransaction();
            $input       = $request->all();
            $empresaUser = Auth::user()->empresaUser();

            $factura                       = new Factura();
            $factura->numero               = $factura->getNro();
            $factura->fecha                = $request->input('fecha');
            $factura->cliente_id           = $request->input('cliente_id');
            $factura->validez              = $request->input('validez');
            $factura->condicion_pago_id    = $request->input('condicion_pago_id');
            $factura->tipo_pago_id         = $request->input('tipo_pago_id');
            $factura->fuente_id            = $request->input('fuente_id');
            $factura->fecha_entrega        = $request->input('fecha_entrega');
            $factura->fecha_vencimiento        = $request->input('fecha_vencimiento');
            $factura->nota_publica         = $request->input('nota_publica');
            $factura->nota_privada         = $request->input('nota_privada');
            $factura->sub_total            = $request->input('sub_total');
            $factura->porcentaje_descuento = $request->input('porcentaje_descuento');
            $factura->porcentaje_iva       = $request->input('porc_iva');
            $factura->descuento            = $request->input('descuento');
            $factura->iva                  = $request->input('iva');
            $factura->total                = $request->input('total_presupuesto');
            $factura->empresa_id           = $empresaUser->id;
            $factura->estado_factura_id=1;
            $factura->save();

            for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {
                $detalle                 = new DetalleFactura();
                $detalle->factura_id = $factura->id;
                //$detalle->producto_id    = $input['productos_array'][$i];
                $detalle->cantidad       = $input['cantidad_array'][$i];
                $detalle->precio_venta   = $input['precio_venta_array'][$i];
                $detalle->total          = $input['total_array'][$i];
                $detalle->desc_libre     = $input['desc_libre_array'][$i];
                $detalle->save();

            }

            DB::commit();
            return redirect()->route('admin.facturas.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
        	dd($e);
            DB::rollback();
            return redirect()->route('admin.facturas.index')->withFlashSuccess('Error Inesperado');
        }
    }

    
    public function edit(ManageFacturaRequest $request, Factura $factura)
    {

        $empresaUser = Auth::user()->empresaUser();
        $productos   = Producto::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $clientes    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

        $condPago = CondicionPago::orderBy('id', 'asc')->pluck('nombre', 'id');
        $tipoPago = TipoPago::orderBy('id', 'asc')->pluck('nombre', 'id');
        $fuentes  = Fuente::orderBy('id', 'asc')->pluck('nombre', 'id');

        $nroPres = Factura::where('empresa_id', $empresaUser->id)->count();


        $estados  = EstadoFactura::orderBy('id', 'asc')->pluck('nombre', 'id');



        return view('backend.facturas.edit', compact('condPago', 'tipoPago', 'fuentes', 'clientes', 'productos','factura','estados'));

    }

    public function update(UpdateFacturaRequest $request, Factura $factura)
    {
        
        try {
            DB::beginTransaction();
            $input       = $request->all();
            $empresaUser = Auth::user()->empresaUser();

                       
            $factura->fecha                = $request->input('fecha');
            $factura->cliente_id           = $request->input('cliente_id');
            $factura->validez              = $request->input('validez');
            $factura->condicion_pago_id    = $request->input('condicion_pago_id');
            $factura->tipo_pago_id         = $request->input('tipo_pago_id');
            $factura->fuente_id            = $request->input('fuente_id');
            $factura->fecha_entrega        = $request->input('fecha_entrega');
            $factura->fecha_vencimiento        = $request->input('fecha_vencimiento');
            $factura->nota_publica         = $request->input('nota_publica');
            $factura->nota_privada         = $request->input('nota_privada');
            $factura->sub_total            = $request->input('sub_total');
            $factura->porcentaje_descuento = $request->input('porcentaje_descuento');
            $factura->porcentaje_iva       = $request->input('porc_iva');
            $factura->descuento            = $request->input('descuento');
            $factura->iva                  = $request->input('iva');
            $factura->total                = $request->input('total_factura');
            $factura->estado_factura_id  = $request->input('estado_factura_id');
            $factura->empresa_id           = $empresaUser->id;
            
            $factura->save();

            DB::table('detalle_factura')->where('factura_id', $factura->id)->delete();

            for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {
                $detalle                 = new DetalleFactura();
                $detalle->factura_id = $factura->id;
                //$detalle->producto_id    = $input['productos_array'][$i];
                $detalle->cantidad       = $input['cantidad_array'][$i];
                $detalle->precio_venta   = $input['precio_venta_array'][$i];
                $detalle->desc_libre          = $input['desc_libre_array'][$i];
                $detalle->total          = $input['total_array'][$i];
                $detalle->save();

            }

            DB::commit();
            return redirect()->route('admin.facturas.index')->withFlashSuccess('Registro editado con éxito');
        } catch (\Exception $e) {
            
            DB::rollback();
            return redirect()->route('admin.facturas.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function show(ManageFacturaRequest $request, Factura $factura)
    {   
        $empresaUser = Auth::user()->empresaUser();
        $empresa=Empresa::find($empresaUser->id);

      
    return view('backend.facturas.show', compact('factura','empresa'));     
    }


    public function print(ManageFacturaRequest $request, Factura $factura)
    {   
        $empresaUser = Auth::user()->empresaUser();
        $empresa=Empresa::find($empresaUser->id);

        $pdf = PDF::loadView('backend.facturas.pdf',compact(
                'factura',
                'empresa'
            ) );
            return $pdf->stream('factura.pdf');

      
         
    }


    //**Generar Facturas a partir de Presupuesto**//
public function facturar(ManagePresupuestoRequest $request, Presupuesto $presupuesto)
    {

        $empresaUser = Auth::user()->empresaUser();
        $productos   = Producto::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $clientes    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

        $condPago = CondicionPago::orderBy('id', 'asc')->pluck('nombre', 'id');
        $tipoPago = TipoPago::orderBy('id', 'asc')->pluck('nombre', 'id');
        $fuentes  = Fuente::orderBy('id', 'asc')->pluck('nombre', 'id');

        $nroPres = Presupuesto::where('empresa_id', $empresaUser->id)->count();


        $estados  = EstadoPresupuesto::orderBy('id', 'asc')->pluck('nombre', 'id');



        return view('backend.facturas.facturar', compact('condPago', 'tipoPago', 'fuentes', 'clientes', 'productos','presupuesto','estados'));

    }


    public function storeFactura(StorePresupuestoRequest $request)
    {
        try {
            DB::beginTransaction();
            $input       = $request->all();
            $empresaUser = Auth::user()->empresaUser();
            
            $factura                       = new Factura();
            $nro=$factura->getNro();
            $factura->numero               = $nro;
            $factura->fecha                = $request->input('fecha');
            $factura->cliente_id           = $request->input('cliente_id');
            $factura->validez              = $request->input('validez');
            $factura->condicion_pago_id    = $request->input('condicion_pago_id');
            $factura->tipo_pago_id         = $request->input('tipo_pago_id');
            $factura->fuente_id            = $request->input('fuente_id');
            $factura->fecha_entrega        = $request->input('fecha_entrega');
            $factura->nota_publica         = $request->input('nota_publica');
            $factura->nota_privada         = $request->input('nota_privada');
            $factura->sub_total            = $request->input('sub_total');
            $factura->porcentaje_descuento = $request->input('porcentaje_descuento');
            $factura->porcentaje_iva       = $request->input('porc_iva');
            $factura->descuento            = $request->input('descuento');
            $factura->iva                  = $request->input('iva');
            $factura->total                = $request->input('total_presupuesto');
            $factura->empresa_id           = $empresaUser->id;
            $factura->estado_factura_id=1;
            $factura->save();

            for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {
                $detalle                 = new DetalleFactura();
                $detalle->factura_id = $factura->id;
                $detalle->producto_id    = $input['productos_array'][$i];
                $detalle->cantidad       = $input['cantidad_array'][$i];
                $detalle->precio_venta   = $input['precio_venta_array'][$i];
                $detalle->total          = $input['total_array'][$i];
                $detalle->desc_libre     = $input['desc_libre_array'][$i];
                $detalle->save();

            }

            $presupuesto=Presupuesto::find($request->input('presupuesto_id'));
            $presupuesto->estado_presupuesto_id=4;
            $presupuesto->save();

            DB::commit();
            return redirect()->route('admin.facturas.index')->withFlashSuccess('Registro creado con éxito, Nueva Factura Nro.'.$nro);
        } catch (\Exception $e) {
           
            DB::rollback();
            return redirect()->route('admin.facturas.index')->withFlashSuccess('Error Inesperado');
        }
    }
//**Generar Facturas a partir de Presupuesto**//









   

    public function getProductos(Request $request)
    {
        try {

            $producto = Producto::find($request['producto_id']);
            return response()->json($producto);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }

    //Aquí se permite pagar las facturas por pago completo o por abono
    
    public function payment(ManageFacturaRequest $request, Factura $factura)
    {
        $empresaUser = Auth::user()->empresaUser();
        $empresa = Empresa::find($empresaUser->id);
        $pagosPrevs = PagoFactura::where('factura_id', $factura->id)->orderBy('id', 'desc')->get();
        $deudaRec = PagoFactura::where('factura_id', $factura->id)->orderBy('id', 'desc')->first();

        //dd($pagosPrevs);
        $tipoPagos = TipoPago::orderBy('id', 'asc')->pluck('nombre', 'id');

        return view('backend.facturas.payment', compact('factura', 'empresa', 'pagosPrevs', 'deudaRec', 'tipoPagos'));
    }

    public function paystore(StorePagoFacturaRequest $request)
    {
        try 
        {
            DB::beginTransaction();
            //dd($request);
            $payment = new PagoFactura();
            $payment->factura_id = $request->input('factura_id');
            $payment->tipo_pago_id = $request->input('tipo_pago_id');
            $payment->comentarios = $request->input('descripcion_tab');
            $payment->fecha = $request->input('fecha');

            if($request->tipo_pago_id != 1)
            {
                $payment->numero = $request->input('numero');
                $payment->transmisor = $request->input('transmisor');
            }

            //aquí viene la parte de los pagos. Si lo que se selecciona es para abonar
            
            if($request->picked != 0)
            {
                //si ya hubieron otros abonos
                if(isset($request->deudaRec))
                {
                    if($request->abono >= $request->deudaRec)
                    {
                        return redirect()->route('admin.facturas.payment', $request->factura_id)->withFlashSuccess('El abono no puede ser superior ni igual a la deuda a cancelar.');
                    }
                    else
                    {
                        $deuda = $request->deudaRec - $request->abono;

                        $payment->abono = $request->input('abono');
                        $payment->deuda = $deuda;
                    }    
                }
                
                //si es el primer abono
                else
                {
                    if($request->abono >= $request->monto_total)
                    {
                        return redirect()->route('admin.facturas.payment', $request->factura_id)->withFlashSuccess('El abono no puede ser superior ni igual al monto total a cancelar.');
                    }
                    else
                    {
                        $deuda = $request->monto_total - $request->abono;

                        $payment->abono = $request->input('abono');
                        $payment->deuda = $deuda;
                    }
                }
            }
            //si se va a pagar todo de una vez
            else
            {
                if(isset($request->deudaRec))
                {
                    $payment->pago = $request->input('deudaRec');

                    $factura = Factura::find($request->factura_id);
                    $factura->estado_factura_id = 2;
                    $factura->save();
                }
                else
                {
                    $payment->pago = $request->input('pago');

                    $factura = Factura::find($request->factura_id);
                    $factura->estado_factura_id = 2;
                    $factura->save();
                }
            }

            $payment->save();

            DB::commit();

            return redirect()->route('admin.facturas.index')->withFlashSuccess('Pago realizado con éxito');
        } 
        catch (\Exception $e) 
        {
            dd($e);
            DB::rollback();
            return redirect()->route('admin.facturas.payment', $request->factura_id)->withFlashSuccess('Error Inesperado');
        }
    }

    //Notas de crédito jejeps
    
    public function notaCredito(Request $request, Factura $factura)
    {
        $empresaUser = Auth::user()->empresaUser();
        $empresa = Empresa::find($empresaUser->id);
        $productos   = Producto::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

        return view('backend.facturas.nota_credito', compact('factura', 'empresa', 'productos'));
    }

    public function storeNotaCredito(Request $request, Factura $factura)
    {
        try {

            //dd($request);

            DB::beginTransaction();

            $input = $request->all();

            $nota_credito = new NotaCredito();
            $nota_credito->numero = $nota_credito->getNro();
            $nota_credito->factura_id = $factura->id;
            $nota_credito->fecha = $request->input('fecha_nota');
            $nota_credito->save();

            $factura->estado_factura_id = 3;
            $factura->save();

            if($input['total_factura'] != 0)
            {
                $productos_array = array();
                $cantidad_array = array();
                $precio_venta_array = array();
                $desc_libre_array = array();
                $total_array = array();

                foreach ($factura->detalle_factura as $detalle) {
                    
                    array_push($productos_array, $detalle->producto_id);
                    array_push($cantidad_array, $detalle->cantidad);
                    array_push($precio_venta_array, $detalle->precio_venta);
                    array_push($desc_libre_array, $detalle->desc_libre); 
                    array_push($total_array, $detalle->total);    
                }

                //dd($input['productos_array']);

                if($productos_array != $input['productos_array'] || $cantidad_array != $input['cantidad_array'] || $precio_venta_array != $input['precio_venta_array'] || $total_array != $input['total_array'] || $desc_libre_array != $input['desc_libre_array']){

                    $empresaUser = Auth::user()->empresaUser();
                    
                    $nueva_factura = new Factura();
                    $nueva_factura->numero               = $factura->getNro();
                    $nueva_factura->fecha                = $factura->fecha;
                    $nueva_factura->cliente_id           = $factura->cliente_id;
                    $nueva_factura->validez              = $factura->validez;
                    $nueva_factura->condicion_pago_id    = $factura->condicion_pago_id;
                    $nueva_factura->tipo_pago_id         = $factura->tipo_pago_id;
                    $nueva_factura->fuente_id            = $factura->fuente_id;
                    $nueva_factura->fecha_entrega        = $factura->fecha_entrega;
                    $nueva_factura->fecha_vencimiento    = $factura->fecha_vencimiento;
                    $nueva_factura->nota_publica         = $factura->nota_publica;
                    $nueva_factura->nota_privada         = $factura->nota_privada;
                    $nueva_factura->sub_total            = $request->input('sub_total');
                    $nueva_factura->porcentaje_descuento = $request->input('porcentaje_descuento');
                    $nueva_factura->porcentaje_iva       = $request->input('porc_iva');
                    $nueva_factura->descuento            = $request->input('descuento');
                    $nueva_factura->iva                  = $request->input('iva');
                    $nueva_factura->total                = $request->input('total_factura');
                    $nueva_factura->empresa_id           = $empresaUser->id;
                    $nueva_factura->estado_factura_id    = 1;
                    $nueva_factura->save();

                    for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {
                        $detalle                 = new DetalleFactura();
                        $detalle->factura_id     = $nueva_factura->id;
                        $detalle->producto_id    = $input['productos_array'][$i];
                        $detalle->cantidad       = $input['cantidad_array'][$i];
                        $detalle->precio_venta   = $input['precio_venta_array'][$i];
                        $detalle->total          = $input['total_array'][$i];
                        $detalle->desc_libre     = $input['desc_libre_array'][$i];
                        $detalle->save();

                    }

                    DB::commit();

                    return redirect()->route('admin.facturas.index')->withFlashSuccess('Anulada factura Nro ' .$factura->numero . ' por nota de crédito. Nueva factura creada con éxito');
                }
                else {

                    DB::commit();

                    return redirect()->route('admin.facturas.index')->withFlashSuccess('Factura Nro. ' .$factura->numero . ' anulada por nota de crédito');
                }
            }
            else {

                DB::commit();

                return redirect()->route('admin.facturas.index')->withFlashSuccess('Factura Nro. ' .$factura->numero . ' anulada por nota de crédito');
            }            
        } 
        catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->route('admin.facturas.index')->withFlashSuccess('Error Inesperado');
        }
    }
}
