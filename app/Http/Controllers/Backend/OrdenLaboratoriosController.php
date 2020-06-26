<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\OrdenLaboratorios\ManageOrdenLaboratoriosRequest;
use App\Http\Requests\Backend\OrdenLaboratorios\StoreOrdenLaboratoriosRequest;
use App\Http\Requests\Backend\OrdenLaboratorios\UpdateOrdenLaboratoriosRequest;
use App\Models\Analisis;
use App\Models\Campo;
use App\Models\ClienteProveedor;
use App\Models\Cuartel;
use App\Models\DetalleOrdenLaboratorio;
use App\Models\Empresa;
use App\Models\EmpresaContacto;
use App\Models\EspecieFuente;
use App\Models\Laboratorio;
use App\Models\OrdenLaboratorio;
use App\Models\TipoMuestra;
use App\Models\Trabajador;
use App\Models\Provincia;
use App\Models\OrdenTrabajo;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdenLaboratoriosController extends Controller
{

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

    public function index(ManageOrdenLaboratoriosRequest $request)
    {

        $empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) {

            $ordenLaboratorios = OrdenLaboratorio::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();

        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
        return view('backend.orden_laboratorios.index', compact('ordenLaboratorios'));
    }

    public function create(ManageOrdenLaboratoriosRequest $request)
    {

        $empresaUser = Auth::user()->empresaUser();
        $especies   = EspecieFuente::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $muestras   = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $analisis   = Analisis::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $laboratorios   = Laboratorio::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $campos   = Campo::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $clientes    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');
        
        $provincias = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');

        $ordTrabs = OrdenTrabajo::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('numero', 'id');

        $nroOrden = OrdenLaboratorio::where('empresa_id', $empresaUser->id)->count();

        if ($nroOrden == null) {
            $nroOrden = 1;
        }

        $nroProv = 'ORL' . $nroOrden;

        return view('backend.orden_laboratorios.create', compact( 'clientes', 'especies', 'muestras','analisis','laboratorios', 'nroProv', 'campos', 'trabajadores','provincias','ordTrabs'));

    }

    public function cargar(Request $request, OrdenTrabajo $ordenTrabajo){
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
        $provincias = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');        
        
        $nroOrden = OrdenLaboratorio::where('empresa_id', $empresaUser->id)->count();

        if ($nroOrden == null) {
            $nroOrden = 1;
        }

        $nroProv = 'ORL' . $nroOrden;


        return view('backend.orden_laboratorios.cargar', compact('clientes','muestras', 'especies', 'analisis', 'laboratorios', 'ordenTrabajo','contactos', 'campos', 'cuarteles', 'trabajadores','provincias','nroProv'));
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();
            $input       = $request->all();
            $empresaUser = Auth::user()->empresaUser();

            $ordenLaboratorio                        = new OrdenLaboratorio();
            $ordenLaboratorio->numero                = $ordenLaboratorio->getNro();
            $ordenLaboratorio->user_id               = Auth::user()->id;            
            $ordenLaboratorio->fecha                 = $request->input('fecha');
            $ordenLaboratorio->cliente_id            = $request->input('cliente_id');
            $ordenLaboratorio->empresa_contacto_id   = $request->input('contacto_id');
            //$ordenLaboratorio->fecha_entrega         = $request->input('fecha_entrega');
            $ordenLaboratorio->trabajador_id         = $request->input('trabajador_id');
            $ordenLaboratorio->laboratorio_id         = $request->input('laboratorio_id');             
            $ordenLaboratorio->empresa_id            = $empresaUser->id;
            $ordenLaboratorio->save();


            for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {
                $detalle                 = new DetalleOrdenLaboratorio();
                $detalle->orden_laboratorio_id       = $ordenLaboratorio->id;
                $detalle->tipo_muestra_id       = $input['muestra_array'][$i];
                $detalle->especie_fuente_id     = $input['especie_array'][$i];
                $detalle->analisis_id           = $input['analisis_array'][$i];
                //$detalle->laboratorio_id        = $input['laboratorio_array'][$i];
                $detalle->campo_id              = $input['campo_array'][$i];
                $detalle->cuartel_id            = $input['cuartel_array'][$i];
                //$detalle->plazo_entrega         = $input['plazo_array'][$i];
                $detalle->variedad              = $input['variedad_array'][$i];
                $detalle->descripcion           = $input['descripcion_array'][$i];
                //$detalle->provincia_id           = $input['provincia_array'][$i];
                //$detalle->comuna_id           = $input['comuna_array'][$i];    


                $detalle->save();

            }

            DB::commit();
            return redirect()->route('admin.ordenLaboratorios.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->route('admin.ordenLaboratorios.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function edit(ManageOrdenLaboratoriosRequest $request, OrdenLaboratorio $ordenLaboratorio)
    {

        $empresaUser = Auth::user()->empresaUser();
        $muestras   = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $especies   = EspecieFuente::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $analisis   = Analisis::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $laboratorios   = Laboratorio::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');                        
        $clientes    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

        $contactos    = EmpresaContacto::where('cliente_proveedor_id', $ordenLaboratorio->cliente_id)->orderBy('id', 'asc')->get()->pluck('nombre_and_apellido', 'id');   
        $campos   = Campo::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $cuarteles    = Cuartel::where('id', $ordenLaboratorio->campo_id)->orderBy('id', 'asc')->get()->pluck('nombre', 'id');           

        $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $provincias = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');        
        
        $nroOrden = OrdenLaboratorio::where('empresa_id', $empresaUser->id)->count();


        return view('backend.orden_laboratorios.edit', compact('clientes','muestras', 'especies', 'analisis', 'laboratorios', 'ordenLaboratorio','contactos', 'campos', 'cuarteles', 'trabajadores','provincias'));

    }

    public function update(UpdateOrdenLaboratoriosRequest $request, OrdenLaboratorio $ordenLaboratorio)
    {

        try {
            
            DB::beginTransaction();
            $input       = $request->all();
            $empresaUser = Auth::user()->empresaUser();

           
            $ordenLaboratorio->fecha                 = $request->input('fecha');
            $ordenLaboratorio->cliente_id            = $request->input('cliente_id');
            $ordenLaboratorio->empresa_contacto_id   = $request->input('empresa_contacto_id');
            $ordenLaboratorio->trabajador_id         = $request->input('trabajador_id');            
            $ordenLaboratorio->empresa_id            = $empresaUser->id;
            $ordenLaboratorio->save();
            


            DB::table('detalle_orden_laboratorio')->where('orden_laboratorio_id', $ordenLaboratorio->id)->delete();


             for ($i = 0; $i < (intval($input['numero_productos'])); $i++) {
                $detalle                 = new DetalleOrdenLaboratorio();
                $detalle->orden_laboratorio_id       = $ordenLaboratorio->id;
                $detalle->tipo_muestra_id       = $input['muestra_array'][$i];
                $detalle->especie_fuente_id     = $input['especie_array'][$i];
                $detalle->analisis_id           = $input['analisis_array'][$i];
                //$detalle->laboratorio_id        = $input['laboratorio_array'][$i];
                $detalle->campo_id              = $input['campo_array'][$i];
                $detalle->cuartel_id            = $input['cuartel_array'][$i];
                //$detalle->plazo_entrega         = $input['plazo_array'][$i];
                $detalle->variedad              = $input['variedad_array'][$i];
                $detalle->descripcion           = $input['descripcion_array'][$i];
                //$detalle->provincia_id           = $input['provincia_array'][$i];
                //$detalle->comuna_id           = $input['comuna_array'][$i];    


                $detalle->save();

            }


            DB::commit();
            return redirect()->route('admin.ordenLaboratorios.index')->withFlashSuccess('Registro editado con éxito');
        } catch (\Exception $e) {
            dd($e);            
            DB::rollback();
            return redirect()->route('admin.ordenLaboratorios.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function show(Request $request, OrdenLaboratorio $ordenLaboratorio)
    {
        $empresaUser = Auth::user()->empresaUser();
        $muestras   = TipoMuestra::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $especies   = EspecieFuente::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $analisis   = Analisis::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $laboratorios   = Laboratorio::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');                        
        $clientes    = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', 1)->orderBy('id', 'asc')->pluck('nombre_razon', 'id');

        $contactos    = EmpresaContacto::where('cliente_proveedor_id', $ordenLaboratorio->cliente_id)->orderBy('id', 'asc')->get()->pluck('nombre_and_apellido', 'id');   
        $campos   = Campo::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $cuarteles    = Cuartel::where('id', $ordenLaboratorio->campo_id)->orderBy('id', 'asc')->get()->pluck('nombre', 'id');           

        $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->orderBy('id', 'asc')->pluck('nombre', 'id');
        $provincias = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');        
        
        $nroOrden = OrdenLaboratorio::where('empresa_id', $empresaUser->id)->count();


        return view('backend.orden_laboratorios.show', compact('clientes','muestras', 'especies', 'analisis', 'laboratorios', 'ordenLaboratorio','contactos', 'campos', 'cuarteles', 'trabajadores','provincias'));
    }

    function print(ManageOrdenLaboratoriosRequest $request, OrdenLaboratorio $ordenLaboratorio) {
        $empresaUser = Auth::user()->empresaUser();
        $usuario = Auth::user()->first_name.' '.Auth::user()->last_name;

        $empresa     = Empresa::find($empresaUser->id);

        $pdf = PDF::loadView('backend.orden_laboratorios.pdf', compact(
            'ordenLaboratorio',
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
