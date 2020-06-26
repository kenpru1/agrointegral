<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\GuiaDespacho\ManageGuiaDespachoRequest;
use App\Http\Requests\Backend\GuiaDespacho\StoreGuiaDespachoRequest;
use App\Http\Requests\Backend\GuiaDespacho\UpdateGuiaDespachoRequest;
use App\Models\ClienteProveedor;
use App\Models\CondicionPago;
use App\Models\Correlativo;
use App\Models\DetalleGuiaDespacho;
use App\Models\GuiaDespacho;
use App\Models\Producto;
use App\Models\Presupuesto;
use App\Models\EstadoPresupuesto;
use App\Models\Empresa;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class GuiaDespachoController extends Controller
{
    public function index(ManageGuiaDespachoRequest $request)
    {

        
    	$empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) {
                
        	$guias = GuiaDespacho::where('empresa_id', $empresaUser->id)->orderBy('numero', 'id')->get();
        
    }else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
        return view('backend.guia_despachos.index', compact('guias'));
    }

    public function create(ManageGuiaDespachoRequest $request)
    {

        $empresaUser = Auth::user()->empresaUser();
        $productos   = Producto::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $clientes    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');


        $nroGuia = GuiaDespacho::where('empresa_id', $empresaUser->id)->count();
        
        if($nroGuia==null)
            $nroGuia=1;


        $nroProv = 'GD' . $nroGuia;

        return view('backend.guia_despachos.create', compact('clientes', 'productos', 'nroProv'));

    }

    public function store(StoreGuiaDespachoRequest $request)
    {
        try {
            DB::beginTransaction();
            $input       = $request->all();
            $empresaUser = Auth::user()->empresaUser();

            $guia                       = new GuiaDespacho();
            $guia->numero               = $guia->getNro();
            $guia->fecha                = $request->input('fecha');
            $guia->cliente_id           = $request->input('cliente_id');
            $guia->nota_publica         = $request->input('nota_publica');
            $guia->nota_privada         = $request->input('nota_privada');
            $guia->sub_total            = $request->input('sub_total');
            $guia->porcentaje_iva       = $request->input('porc_iva');
            $guia->iva                  = $request->input('iva');
            $guia->total                = $request->input('total_guia');
            $guia->empresa_id           = $empresaUser->id;
            $guia->save();

            for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {
                $detalle                 = new DetalleGuiaDespacho();
                $detalle->guia_despacho_id = $guia->id;
                $detalle->producto_id    = $input['productos_array'][$i];
                $detalle->cantidad       = $input['cantidad_array'][$i];
                $detalle->precio_venta   = $input['precio_venta_array'][$i];
                $detalle->total          = $input['total_array'][$i];
                $detalle->desc_libre     = $input['desc_libre_array'][$i];
                $detalle->save();

            }

            DB::commit();
            return redirect()->route('admin.guia_despachos.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
        	DB::rollback();
            dd($e);
            return redirect()->route('admin.guia_despachos.index')->withFlashSuccess('Error Inesperado');
        }
    }

    
    public function edit(ManageGuiaDespachoRequest $request, GuiaDespacho $guia)
    {

        $empresaUser = Auth::user()->empresaUser();
        $productos   = Producto::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $clientes    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

        $nroPres = GuiaDespacho::where('empresa_id', $empresaUser->id)->count();



        return view('backend.guia_despachos.edit', compact('clientes', 'productos','guia'));

    }

    public function update(UpdateGuiaDespachoRequest $request, GuiaDespacho $guia)
    {
        
        try {
            DB::beginTransaction();
            $input       = $request->all();
            $empresaUser = Auth::user()->empresaUser();

                       
            $guia->numero               = $guia->getNro();
            $guia->fecha                = $request->input('fecha');
            $guia->cliente_id           = $request->input('cliente_id');
            $guia->nota_publica         = $request->input('nota_publica');
            $guia->nota_privada         = $request->input('nota_privada');
            $guia->sub_total            = $request->input('sub_total');
            $guia->porcentaje_iva       = $request->input('porc_iva');
            $guia->iva                  = $request->input('iva');
            $guia->total                = $request->input('total_guia');
            $guia->empresa_id           = $empresaUser->id;
            $guia->save();

            DB::table('detalle_guia_despacho')->where('guia_despacho_id', $guia->id)->delete();

            for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {
                $detalle                 = new DetalleGuiaDespacho();
                $detalle->guia_despacho_id = $guia->id;
                $detalle->producto_id    = $input['productos_array'][$i];
                $detalle->cantidad       = $input['cantidad_array'][$i];
                $detalle->precio_venta   = $input['precio_venta_array'][$i];
                $detalle->desc_libre          = $input['desc_libre_array'][$i];
                $detalle->total          = $input['total_array'][$i];
                $detalle->save();

            }

            DB::commit();
            return redirect()->route('admin.guia_despachos.index')->withFlashSuccess('Registro editado con éxito');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->route('admin.guia_despachos.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function show(ManageGuiaDespachoRequest $request, GuiaDespacho $guia)
    {   
        $empresaUser = Auth::user()->empresaUser();
        $empresa=Empresa::find($empresaUser->id);

      
    return view('backend.guia_despachos.show', compact('guia','empresa'));     
    }


    public function print(ManageGuiaDespachoRequest $request, GuiaDespacho $guia)
    {   
        $empresaUser = Auth::user()->empresaUser();
        $empresa=Empresa::find($empresaUser->id);

        $pdf = PDF::loadView('backend.guia_despachos.pdf',compact(
                'guia',
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
