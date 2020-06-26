<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Presupuesto\ManagePresupuestoRequest;
use App\Http\Requests\Backend\Presupuesto\StorePresupuestoRequest;
use App\Models\Analisis;
use App\Models\ClienteProveedor;
use App\Models\CondicionPago;
use App\Models\DetallePresupuesto;
use App\Models\Empresa;
use App\Models\EmpresaContacto;
use App\Models\EstadoPresupuesto;
use App\Models\EspecieFuente;
use App\Models\Fuente;
use App\Models\Laboratorio;
use App\Models\Presupuesto;
use App\Models\Producto;
use App\Models\TipoMuestra;
use App\Models\TipoPago;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresupuestosController extends Controller
{

    public function cambiar_estado(ManagePresupuestoRequest $request, Presupuesto $presupuesto, $estado)
    {
        try {
            DB::beginTransaction();
            $presupuesto->estado_presupuesto_id = $estado;
            $presupuesto->save();
            DB::commit();
            return redirect()->route('admin.presupuestos.index')->withFlashSuccess('Estado Actualizado con éxito');

        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->route('admin.presupuestos.index')->withFlashSuccess('Error Inesperado');
        }

    }

    public function index(ManagePresupuestoRequest $request)
    {

        $empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) {

            $presupuestos = Presupuesto::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();

        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
        return view('backend.presupuestos.index', compact('presupuestos'));
    }

    public function create(ManagePresupuestoRequest $request)
    {

        $empresaUser = Auth::user()->empresaUser();
        //$productos   = Producto::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $especies   = EspecieFuente::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $muestras   = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $analisis   = Analisis::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $laboratorios   = Laboratorio::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $clientes    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');


        $condPago = CondicionPago::orderBy('id', 'asc')->pluck('nombre', 'id');
        $tipoPago = TipoPago::orderBy('id', 'asc')->pluck('nombre', 'id');
        $fuentes  = Fuente::orderBy('id', 'asc')->pluck('nombre', 'id');

        $nroPres = Presupuesto::where('empresa_id', $empresaUser->id)->count();

        if ($nroPres == null) {
            $nroPres = 1;
        }

        $nroProv = 'PROV' . $nroPres;

        return view('backend.presupuestos.create', compact('condPago', 'tipoPago', 'fuentes', 'clientes', 'especies', 'muestras','analisis','laboratorios', 'nroProv'));

    }

    public function store(StorePresupuestoRequest $request)
    {
        try {

        
            DB::beginTransaction();
            $input       = $request->all();
            $empresaUser = Auth::user()->empresaUser();

            $presupuesto                        = new Presupuesto();
            $presupuesto->numero                = $presupuesto->getNro();
            $presupuesto->user_id               = Auth::user()->id;            
            $presupuesto->fecha                 = $request->input('fecha');
            $presupuesto->cliente_id            = $request->input('cliente_id');
            $presupuesto->empresa_contacto_id   = $request->input('contacto_id');
            $presupuesto->validez               = $request->input('validez');
            $presupuesto->condicion_pago_id     = $request->input('condicion_pago_id');
            $presupuesto->tipo_pago_id          = $request->input('tipo_pago_id');
            $presupuesto->fuente_id             = $request->input('fuente_id');
            $presupuesto->fecha_entrega         = $request->input('fecha_entrega');
            $presupuesto->nota_publica          = $request->input('nota_publica');
            $presupuesto->nota_privada          = $request->input('nota_privada');
            $presupuesto->sub_total             = $request->input('sub_total');
            $presupuesto->porcentaje_descuento  = $request->input('porcentaje_descuento');
            $presupuesto->porcentaje_iva        = $request->input('porc_iva');
            $presupuesto->descuento             = $request->input('descuento');
            $presupuesto->iva                   = $request->input('iva');
            $presupuesto->total                 = $request->input('total_presupuesto');
            $presupuesto->empresa_id            = $empresaUser->id;
            $presupuesto->estado_presupuesto_id = 1;
            $presupuesto->save();


            for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {
                $detalle                 = new DetallePresupuesto();
                $detalle->presupuesto_id    = $presupuesto->id;
                $detalle->tipo_muestra_id   = $input['muestra_array'][$i];
                $detalle->especie_fuente_id  = $input['especie_array'][$i];
                $detalle->analisis_id       = $input['analisis_array'][$i];
                $detalle->laboratorio_id    = $input['laboratorio_array'][$i];                                                
                $detalle->cantidad       = $input['cantidad_array'][$i];
                $detalle->precio_venta   = $input['precio_venta_array'][$i];
                $detalle->total          = $input['total_array'][$i];
                $detalle->desc_libre     = $input['desc_libre_array'][$i];
                $detalle->save();

            }

            DB::commit();
            return redirect()->route('admin.presupuestos.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.presupuestos.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function edit(ManagePresupuestoRequest $request, Presupuesto $presupuesto)
    {

        $empresaUser = Auth::user()->empresaUser();
        $muestras   = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $especies   = EspecieFuente::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $analisis   = Analisis::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $laboratorios   = Laboratorio::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');                        
        $clientes    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

        $contactos    = EmpresaContacto::where('cliente_proveedor_id', $presupuesto->cliente_id)->orderBy('id', 'asc')->get()->pluck('nombre_and_apellido', 'id');   
        
        $condPago = CondicionPago::orderBy('id', 'asc')->pluck('nombre', 'id');
        $tipoPago = TipoPago::orderBy('id', 'asc')->pluck('nombre', 'id');
        $fuentes  = Fuente::orderBy('id', 'asc')->pluck('nombre', 'id');

        $nroPres = Presupuesto::where('empresa_id', $empresaUser->id)->count();

        $estados = EstadoPresupuesto::orderBy('id', 'asc')->pluck('nombre', 'id');

        return view('backend.presupuestos.edit', compact('condPago', 'tipoPago', 'fuentes', 'clientes','contactos', 'muestras', 'especies', 'analisis', 'laboratorios', 'presupuesto', 'estados'));

    }

    public function update(StorePresupuestoRequest $request, Presupuesto $presupuesto)
    {

        try {
            
            DB::beginTransaction();
            $input       = $request->all();
            $empresaUser = Auth::user()->empresaUser();

            $presupuesto->fecha                 = $request->input('fecha');
            $presupuesto->cliente_id            = $request->input('cliente_id');
            $presupuesto->empresa_contacto_id   = $request->input('empresa_contacto_id');
            $presupuesto->validez               = $request->input('validez');
            $presupuesto->condicion_pago_id     = $request->input('condicion_pago_id');
            $presupuesto->tipo_pago_id          = $request->input('tipo_pago_id');
            $presupuesto->fuente_id             = $request->input('fuente_id');
            $presupuesto->fecha_entrega         = $request->input('fecha_entrega');
            $presupuesto->nota_publica          = $request->input('nota_publica');
            $presupuesto->nota_privada          = $request->input('nota_privada');
            $presupuesto->sub_total             = $request->input('sub_total');
            $presupuesto->porcentaje_descuento  = $request->input('porcentaje_descuento');
            $presupuesto->porcentaje_iva        = $request->input('porc_iva');
            $presupuesto->descuento             = $request->input('descuento');
            $presupuesto->iva                   = $request->input('iva');
            $presupuesto->total                 = $request->input('total_presupuesto');
            $presupuesto->estado_presupuesto_id = $request->input('estado_presupuesto_id');
            $presupuesto->empresa_id            = $empresaUser->id;

            $presupuesto->save();
            


            DB::table('detalle_presupuesto')->where('presupuesto_id', $presupuesto->id)->delete();


            for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {

                $detalle                    = new DetallePresupuesto();
                $detalle->presupuesto_id    = $presupuesto->id;
                $detalle->tipo_muestra_id   = $input['muestra_array'][$i];
                $detalle->especie_fuente_id = $input['especie_array'][$i];
                $detalle->analisis_id       = $input['analisis_array'][$i];
                $detalle->laboratorio_id    = $input['laboratorio_array'][$i];

                $detalle->cantidad       = $input['cantidad_array'][$i];
                $detalle->precio_venta   = $input['precio_venta_array'][$i];
                $detalle->desc_libre     = $input['desc_libre_array'][$i];
                $detalle->total          = $input['total_array'][$i];
                $detalle->save();

            }


            DB::commit();
            return redirect()->route('admin.presupuestos.index')->withFlashSuccess('Registro editado con éxito');
        } catch (\Exception $e) {
            
            DB::rollback();
            return redirect()->route('admin.presupuestos.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function show(ManagePresupuestoRequest $request, Presupuesto $presupuesto)
    {
        $empresaUser = Auth::user()->empresaUser();
        $empresa     = Empresa::find($empresaUser->id);

        return view('backend.presupuestos.show', compact('presupuesto', 'empresa'));
    }

    function print(ManagePresupuestoRequest $request, Presupuesto $presupuesto) {
        $empresaUser = Auth::user()->empresaUser();
        $usuario = Auth::user()->first_name.' '.Auth::user()->last_name;

        $empresa     = Empresa::find($empresaUser->id);

        $pdf = PDF::loadView('backend.presupuestos.pdf', compact(
            'presupuesto',
            'empresa'
        ));
        return $pdf->stream('presupuesto.pdf');

    }


}
