<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Movimiento\ManageMovimientoRequest;
use App\Http\Requests\Backend\Movimiento\StoreMovimientoRequest;
use App\Models\Auth\User;
use App\Models\Bodega;
use App\Models\ClienteProveedor;
use App\Models\Factura;
use App\Models\FacturaRecibida;
use App\Models\Movimiento;
use App\Models\Producto;
use App\Models\Stock;
use App\Models\TipoOperacion;
use App\Models\GuiaDespacho;
use App\Models\Actividad;
use DB;
use Illuminate\Support\Facades\Auth;

class MovimientosController extends Controller
{

    public function show(Movimiento $movimiento)
    {

        return view('backend.movimientos.show', compact('movimiento'));
    }

    public function index()
    {
        $empresaUser = User::find(Auth::id())->empresas()->first();

        if ($empresaUser != null) {
            if (auth()->user()->hasRole('administrator')) {
                $movimientos = Movimiento::orderBy('id', 'desc')->get();

            } else {

                $movimientos = Movimiento::with('stock')
                    ->whereHas('stock.bodega', function ($q) use ($empresaUser) {
                        $q->where('bodegas.empresa_id', $empresaUser->id);
                    })->orderBy('id', 'desc')->get();

            }

        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }

        return view('backend.movimientos.index', compact('movimientos'));

    }

    public function create(ManageMovimientoRequest $request)
    {


        $empresaUser = User::find(Auth::id())->empresas()->first();

        if ($empresaUser != null) {

            if (auth()->user()->hasRole('administrator')) {

                $bodegas     = Bodega::orderBy('nombre', 'asc')->pluck('nombre', 'id');
              
                $facturas=Factura::selectRaw("CONCAT ('No:',numero,'-',cliente_proveedor.nombre_razon,'- Neto:',sub_total, '- Iva:',iva, '- Total:', total) as columns, facturas.id")
                ->join('cliente_proveedor','cliente_proveedor.id', '=', 'facturas.cliente_id')
                ->where('estado_factura_id', 1)
                ->where('estado_factura_id', 1)
                ->pluck('columns', 'id');

                $guias=GuiaDespacho::selectRaw("CONCAT ('No:',numero,'-',cliente_proveedor.nombre_razon,'- Neto:',sub_total, '- Iva:',iva, '- Total:', total) as columns, guia_despachos.id")
                ->join('cliente_proveedor','cliente_proveedor.id', '=', 'guia_despachos.cliente_id')
                ->pluck('columns', 'id');


                $productos   = Producto::orderBy('nombre', 'asc')->pluck('nombre', 'id');
                $proveedores = ClienteProveedor::where('proveedor', 1)->pluck('nombre_razon', 'id');
                $clientes    = ClienteProveedor::where('cliente', 1)->pluck('nombre_razon', 'id');
                
            } else {

                $bodegas = Bodega::where('empresa_id', $empresaUser->id)->pluck('nombre', 'id');

             

                $facturas=Factura::selectRaw("CONCAT ('No:',numero,'-',cliente_proveedor.nombre_razon,'- Neto:',sub_total, '- Iva:',iva, '- Total:', total) as columns, facturas.id")
                ->join('cliente_proveedor','cliente_proveedor.id', '=', 'facturas.cliente_id')
                ->where('estado_factura_id', 1)
                ->where('facturas.empresa_id', $empresaUser->id)->pluck('columns', 'id');

                $factRec=FacturaRecibida::selectRaw("CONCAT ('No:',ref,'-',cliente_proveedor.nombre_razon,'- Neto:',monto_neto, '- Iva:',iva, '- Total:', total) as columns, facturas_recibidas.id")
                ->join('cliente_proveedor','cliente_proveedor.id', '=', 'facturas_recibidas.cliente_proveedor_id')
                ->where('estado_factura_id', 4)
                ->where('facturas_recibidas.empresa_id', $empresaUser->id)->pluck('columns', 'id');

                


                $guias=GuiaDespacho::selectRaw("CONCAT ('No:',numero,'-',cliente_proveedor.nombre_razon,'- Neto:',sub_total, '- Iva:',iva, '- Total:', total) as columns, guia_despachos.id")
                ->join('cliente_proveedor','cliente_proveedor.id', '=', 'guia_despachos.cliente_id')
                ->where('guia_despachos.empresa_id', $empresaUser->id)->pluck('columns', 'id');

                

                $productos   = Producto::orderBy('nombre', 'asc')->where('empresa_id', $empresaUser->id)->pluck('nombre', 'id');
                $proveedores = ClienteProveedor::where('proveedor', 1)->where('empresa_id', $empresaUser->id)->pluck('nombre_razon', 'id');
                $clientes    = ClienteProveedor::where('cliente', 1)->where('empresa_id', $empresaUser->id)->pluck('nombre_razon', 'id');

            }

        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
        
        //$tipoActiv = TipoActividad::orderBy('id', 'asc')->pluck('nombre', 'id');
        
        $actividades = Actividad::whereHas('campos', function ($query) use ($empresaUser) {
            $query->where('campos.id','!=',0)->where('actividades.empresa_id', $empresaUser->id);
        })->pluck('comentarios','id');

        
        $tipoOpera = TipoOperacion::orderBy('id', 'asc')->pluck('descripcion', 'id');

        return view('backend.movimientos.create', compact('tipoOpera', 'bodegas', 'productos', 'clientes', 'proveedores', 'facturas','guias', 'actividades','factRec'));
    }

    public function store(StoreMovimientoRequest $request)
    {
          
        try {
            DB::beginTransaction();

            //Compra
            if ($request->input('tipo_operacion_id') == 1) {

                $stock = Stock::where('bodega_id', $request->input('bodega_id'))
                    ->where('producto_id', $request->input('producto_id'))->first();

                if ($stock != null) {
                    $stock->cantidad = $stock->cantidad + $request->input('cantidad');
                } else {
                    $stock              = new Stock();
                    $stock->bodega_id   = $request->input('bodega_id');
                    $stock->producto_id = $request->input('producto_id');
                    $stock->cantidad    = $request->input('cantidad');

                }
                $stock->save();

                $movimiento                       = new Movimiento();
                //$movimiento->factura_id           = $request->input('factura_id');
                $movimiento->factura_recibida_id           = $request->input('factura_recibida_id');
                $movimiento->tipo_operacion_id    = $request->input('tipo_operacion_id');
                $movimiento->tipo_movimiento_id   = 1;
                $movimiento->tipo_entrada    = $request->input('tipo_entrada');
                $movimiento->fecha                = $request->input('fecha');
                $movimiento->stock_id             = $stock->id;
                $movimiento->producto_id          = $request->input('producto_id');
                $movimiento->cantidad             = $request->input('cantidad');
                $movimiento->cliente_proveedor_id = $request->input('proveedor_id');
                $movimiento->user_id              = Auth::id();
                $movimiento->comentarios = $request->input('comentarios');
                $movimiento->save();

            }

            //Venta
            if ($request->input('tipo_operacion_id') == 2) {

                $stock = Stock::where('bodega_id', $request->input('bodega_id'))
                    ->where('producto_id', $request->input('producto_id'))->first();

                if ($stock != null) {

                    if ($stock->cantidad - $request->input('cantidad') >= 0) {
                        $stock->cantidad = $stock->cantidad - $request->input('cantidad');
                    } else {
                        return redirect()->route('admin.movimientos.index')->withFlashDanger('No existe cantidad en Stock para está Operación');
                    }

                } else {
                    return redirect()->route('admin.movimientos.index')->withFlashDanger('No existe cantidad en Stock para está Operación');

                }
                $stock->save();

                $movimiento                       = new Movimiento();
                $movimiento->factura_id           = $request->input('factura_id');
                $movimiento->tipo_operacion_id    = $request->input('tipo_operacion_id');
                $movimiento->tipo_movimiento_id   = 2;
                $movimiento->fecha                = $request->input('fecha');
                $movimiento->stock_id             = $stock->id;
                $movimiento->producto_id          = $request->input('producto_id');
                $movimiento->cantidad             = $request->input('cantidad');
                $movimiento->cliente_proveedor_id = $request->input('cliente_id');
                $movimiento->user_id              = Auth::id();
                $movimiento->comentarios = $request->input('comentarios');
                $movimiento->save();

            }

            //Merma
            if ($request->input('tipo_operacion_id') == 3) {

                $stock = Stock::where('bodega_id', $request->input('bodega_id'))
                    ->where('producto_id', $request->input('producto_id'))->first();

                if ($stock != null) {

                    if ($stock->cantidad - $request->input('cantidad') >= 0) {
                        $stock->cantidad = $stock->cantidad - $request->input('cantidad');
                    } else {
                        return redirect()->route('admin.movimientos.index')->withFlashDanger('No existe cantidad en Stock para está Operación');
                    }

                } else {
                    return redirect()->route('admin.movimientos.index')->withFlashDanger('No existe cantidad en Stock para está Operación');

                }
                $stock->save();

                $movimiento                     = new Movimiento();
                $movimiento->tipo_operacion_id  = $request->input('tipo_operacion_id');
                $movimiento->tipo_movimiento_id = 2;
                $movimiento->fecha              = $request->input('fecha');
                $movimiento->stock_id           = $stock->id;
                $movimiento->producto_id        = $request->input('producto_id');
                $movimiento->cantidad           = $request->input('cantidad');
                $movimiento->user_id            = Auth::id();
                $movimiento->comentarios = $request->input('comentarios');
                $movimiento->save();

            }

            //Bodega a Bodega
            if ($request->input('tipo_operacion_id') == 4) {

                $stock_origen = Stock::where('bodega_id', $request->input('bodega_origen'))
                    ->where('producto_id', $request->input('producto_id'))->first();

                if ($stock_origen != null) {

                    if ($stock_origen->cantidad - $request->input('cantidad') >= 0) {
                        $stock_origen->cantidad = $stock_origen->cantidad - $request->input('cantidad');
                    } else {
                        return redirect()->route('admin.movimientos.index')->withFlashDanger('No existe cantidad en Stock para está Operación');
                    }

                } else {
                    return redirect()->route('admin.movimientos.index')->withFlashDanger('No existe cantidad en Stock para está Operación');

                }
                $stock_origen->save();

                $movimiento_origen                     = new Movimiento();
                $movimiento_origen->tipo_operacion_id  = $request->input('tipo_operacion_id');
                $movimiento_origen->tipo_movimiento_id = 2;
                $movimiento_origen->fecha              = $request->input('fecha');
                $movimiento_origen->stock_id           = $stock_origen->id;
                $movimiento_origen->producto_id        = $request->input('producto_id');
                $movimiento_origen->guia_despacho_id        = $request->input('guia_despacho_id');
                $movimiento_origen->cantidad           = $request->input('cantidad');
                $movimiento_origen->user_id            = Auth::id();
                $movimiento_origen->comentarios = $request->input('comentarios');
                $movimiento_origen->save();

                $stock_destino = Stock::where('bodega_id', $request->input('bodega_destino'))
                    ->where('producto_id', $request->input('producto_id'))->first();

                if ($stock_destino != null) {
                    $stock_destino->cantidad = $stock_destino->cantidad + $request->input('cantidad');

                } else {

                    $stock_destino              = new Stock();
                    $stock_destino->bodega_id   = $request->input('bodega_destino');
                    $stock_destino->producto_id = $request->input('producto_id');
                    $stock_destino->cantidad    = $request->input('cantidad');

                }

                $stock_destino->save();

                $movimiento_destino                     = new Movimiento();
                $movimiento_destino->tipo_operacion_id  = $request->input('tipo_operacion_id');
                $movimiento_destino->tipo_movimiento_id = 1;
                $movimiento_destino->fecha              = $request->input('fecha');
                $movimiento_destino->stock_id           = $stock_destino->id;
                $movimiento_destino->producto_id        = $request->input('producto_id');
                $movimiento_destino->cantidad           = $request->input('cantidad');
                $movimiento_destino->user_id            = Auth::id();
                $movimiento_destino->comentarios = $request->input('comentarios');
                $movimiento_destino->save();

            }

            //Uso en actividad
            if ($request->input('tipo_operacion_id') == 5) {

                $stock = Stock::where('bodega_id', $request->input('bodega_id'))
                    ->where('producto_id', $request->input('producto_id'))->first();

                if ($stock != null) {

                    if ($stock->cantidad - $request->input('cantidad') >= 0) {
                        $stock->cantidad = $stock->cantidad - $request->input('cantidad');
                    } else {
                        return redirect()->route('admin.movimientos.index')->withFlashDanger('No existe cantidad en Stock para está Operación');
                    }

                } else {
                    return redirect()->route('admin.movimientos.index')->withFlashDanger('No existe cantidad en Stock para está Operación');

                }
                $stock->save();

                $movimiento                     = new Movimiento();
                $movimiento->tipo_operacion_id  = $request->input('tipo_operacion_id');
                $movimiento->tipo_movimiento_id = 2;
                $movimiento->fecha              = $request->input('fecha');
                $movimiento->stock_id           = $stock->id;
                $movimiento->producto_id        = $request->input('producto_id');
                $movimiento->cantidad           = $request->input('cantidad');
                $movimiento->actividad_id  = $request->input('actividad_id');
                $movimiento->user_id            = Auth::id();
                $movimiento->comentarios = $request->input('comentarios');
                $movimiento->save();

            }

            DB::commit();
            return redirect()->route('admin.movimientos.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->route('admin.movimientos.index')->withFlashSuccess('Error Inesperado');
        }

    }
}
