<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\OrdenTrabajos\ManageOrdenTrabajosRequest;
use App\Http\Requests\Backend\OrdenTrabajos\StoreOrdenTrabajosRequest;
use App\Models\Analisis;
use App\Models\Campo;
use App\Models\ClienteProveedor;
use App\Models\Cuartel;
use App\Models\DetalleOrdenTrabajo;
use App\Models\Empresa;
use App\Models\EmpresaContacto;
use App\Models\EspecieFuente;
use App\Models\Laboratorio;
use App\Models\OrdenTrabajo;
use App\Models\TipoMuestra;
use App\Models\Trabajador;
use App\Models\Presupuesto;
use App\Models\DetallePresupuesto;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdenTrabajosController extends Controller
{
    public function cargar(Request $request, Presupuesto $presupuesto){
//dd($presupuesto->detallePresupuesto);
        $empresaUser = Auth::user()->empresaUser();
        //$productos   = Producto::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $especies   = EspecieFuente::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $muestras   = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $analisis   = Analisis::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $laboratorios   = Laboratorio::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $campos   = Campo::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $clientes    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

        $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

        $contactos = EmpresaContacto::where('id', $presupuesto->empresa_contacto_id)->orderBy('id', 'asc')->get()->pluck('nombre_and_apellido', 'id');

        $detallePre=DetallePresupuesto::where('presupuesto_id',$presupuesto->id)->first();

        $nroOrden = OrdenTrabajo::where('empresa_id', $empresaUser->id)->count();

        if ($nroOrden == null) {
            $nroOrden = 1;
        }

        $nroProv = 'ORT' . $nroOrden;

        return view('backend.orden_trabajos.cargar', compact( 'clientes', 'especies', 'muestras','analisis','laboratorios', 'nroProv', 'campos', 'trabajadores','presupuesto','contactos','detallePre'));

    }

    public function cambiar_estado(ManageOrdenTrabajosRequest $request, OrdenTrabajo $ordenTrabajo, $estado)
    {
        try {
            DB::beginTransaction();
            $ordenTrabajo->estado_ordenTrabajo_id = $estado;
            $ordenTrabajo->save();
            DB::commit();
            return redirect()->route('admin.ordenTrabajos.index')->withFlashSuccess('Estado Actualizado con éxito');

        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->route('admin.ordenTrabajos.index')->withFlashSuccess('Error Inesperado');
        }

    }

    public function index(ManageOrdenTrabajosRequest $request)
    {

        $empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) {

            $ordenTrabajos = OrdenTrabajo::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();

           

        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
        return view('backend.orden_trabajos.index', compact('ordenTrabajos'));
    }

    public function create(ManageOrdenTrabajosRequest $request)
    {

        $empresaUser = Auth::user()->empresaUser();
        $especies   = EspecieFuente::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $muestras   = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $analisis   = Analisis::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $laboratorios   = Laboratorio::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $campos   = Campo::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $clientes    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

        $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

        $presupuestos = Presupuesto::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('numero', 'id');

        $nroOrden = OrdenTrabajo::where('empresa_id', $empresaUser->id)->count();

        if ($nroOrden == null) {
            $nroOrden = 1;
        }

        $nroProv = 'ORT' . $nroOrden;

        return view('backend.orden_trabajos.create', compact( 'clientes', 'especies', 'muestras','analisis','laboratorios', 'nroProv', 'campos', 'trabajadores','presupuestos'));

    }

    public function store(StoreOrdenTrabajosRequest $request)
    {
        try {

            DB::beginTransaction();
            $input       = $request->all();
            $empresaUser = Auth::user()->empresaUser();

            $ordenTrabajo                        = new OrdenTrabajo();
            $ordenTrabajo->numero                = $ordenTrabajo->getNro();
            $ordenTrabajo->user_id               = Auth::user()->id;            
            $ordenTrabajo->fecha                 = $request->input('fecha');
            $ordenTrabajo->cliente_id            = $request->input('cliente_id');
            $ordenTrabajo->empresa_contacto_id   = $request->input('contacto_id');
            $ordenTrabajo->validez               = $request->input('validez');
            $ordenTrabajo->fecha_entrega         = $request->input('fecha_entrega');
            $ordenTrabajo->trabajador_id         = $request->input('trabajador_id');            
            $ordenTrabajo->empresa_id            = $empresaUser->id;
            $ordenTrabajo->save();


            for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {
                $detalle                 = new DetalleOrdenTrabajo();
                $detalle->orden_trabajo_id       = $ordenTrabajo->id;
                $detalle->tipo_muestra_id       = $input['muestra_array'][$i];
                $detalle->especie_fuente_id     = $input['especie_array'][$i];
                $detalle->analisis_id           = $input['analisis_array'][$i];
                $detalle->laboratorio_id        = $input['laboratorio_array'][$i];
                $detalle->campo_id              = $input['campo_array'][$i];
                $detalle->cuartel_id            = $input['cuartel_array'][$i];
                $detalle->plazo_entrega         = $input['plazo_array'][$i];
                $detalle->variedad              = $input['variedad_array'][$i];
                $detalle->descripcion           = $input['descripcion_array'][$i];    


                $detalle->save();

            }

            DB::commit();
            return redirect()->route('admin.ordenTrabajos.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.ordenTrabajos.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function edit(ManageOrdenTrabajosRequest $request, OrdenTrabajo $ordenTrabajo)
    {

        $empresaUser = Auth::user()->empresaUser();
        $muestras   = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $especies   = EspecieFuente::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $analisis   = Analisis::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $laboratorios   = Laboratorio::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');                        
        $clientes    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

        $contactos    = EmpresaContacto::where('cliente_proveedor_id', $ordenTrabajo->cliente_id)->orderBy('id', 'asc')->get()->pluck('nombre_and_apellido', 'id');   
        $campos   = Campo::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $cuarteles    = Cuartel::where('id', $ordenTrabajo->campo_id)->orderBy('id', 'asc')->get()->pluck('nombre', 'id');           

        $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');        
        
        $nroOrden = OrdenTrabajo::where('empresa_id', $empresaUser->id)->count();


        return view('backend.orden_trabajos.edit', compact('clientes','muestras', 'especies', 'analisis', 'laboratorios', 'ordenTrabajo','contactos', 'campos', 'cuarteles', 'trabajadores'));

    }

    public function update(StoreOrdenTrabajosRequest $request, OrdenTrabajo $ordenTrabajo)
    {

        try {
            
            DB::beginTransaction();
            $input       = $request->all();
            $empresaUser = Auth::user()->empresaUser();

            $ordenTrabajo->user_id               = Auth::user()->id;            
            $ordenTrabajo->fecha                 = $request->input('fecha');
            $ordenTrabajo->cliente_id            = $request->input('cliente_id');
            $ordenTrabajo->empresa_contacto_id   = $request->input('empresa_contacto_id');
            $ordenTrabajo->validez               = $request->input('validez');
            $ordenTrabajo->fecha_entrega         = $request->input('fecha_entrega');
            $ordenTrabajo->trabajador_id         = $request->input('trabajador_id');            
            $ordenTrabajo->empresa_id            = $empresaUser->id;

            $ordenTrabajo->save();
            


            DB::table('detalle_orden_trabajo')->where('orden_trabajo_id', $ordenTrabajo->id)->delete();


            for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {

                $detalle                    = new DetalleOrdenTrabajo();

                $detalle->orden_trabajo_id      = $ordenTrabajo->id;
                $detalle->tipo_muestra_id       = $input['muestra_array'][$i];
                $detalle->especie_fuente_id     = $input['especie_array'][$i];
                $detalle->analisis_id           = $input['analisis_array'][$i];
                $detalle->laboratorio_id        = $input['laboratorio_array'][$i];
                $detalle->campo_id              = $input['campo_array'][$i];
                $detalle->cuartel_id            = $input['cuartel_array'][$i];
                $detalle->plazo_entrega         = $input['plazo_array'][$i];
                $detalle->variedad              = $input['variedad_array'][$i];
                $detalle->descripcion           = $input['descripcion_array'][$i];    

                
                $detalle->save();

            }


            DB::commit();
            return redirect()->route('admin.ordenTrabajos.index')->withFlashSuccess('Registro editado con éxito');
        } catch (\Exception $e) {
            dd($e);            
            DB::rollback();
            return redirect()->route('admin.ordenTrabajos.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function show(ManageOrdenTrabajosRequest $request, OrdenTrabajo $ordenTrabajo)
    {
        $empresaUser = Auth::user()->empresaUser();
        $empresa     = Empresa::find($empresaUser->id);

        return view('backend.orden_trabajos.show', compact('ordenTrabajo', 'empresa'));
    }

    function print(ManageOrdenTrabajosRequest $request, OrdenTrabajo $ordenTrabajo) {
        $empresaUser = Auth::user()->empresaUser();
        $usuario = Auth::user()->first_name.' '.Auth::user()->last_name;

        $empresa     = Empresa::find($empresaUser->id);

        $pdf = PDF::loadView('backend.orden_trabajos.pdf', compact(
            'ordenTrabajo',
            'empresa'
        ));

        //->setPaper('leter', 'landscape')
        return $pdf->stream('ordenTrabajo.pdf');

    }

    public function getCuarteles(Request $request)
    {
        try {
            $cuarteles = Cuartel::where('campo_id', $request['campo'])->get();

            return response()->json($cuarteles);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }

}
