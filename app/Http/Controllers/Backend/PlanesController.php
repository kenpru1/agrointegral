<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Plan\ManagePlanPerfilRequest;
use App\Http\Requests\Backend\Plan\ManagePlanRequest;
use App\Http\Requests\Backend\Plan\StorePlanRequest;
use App\Http\Requests\Backend\Plan\UpdatePlanPerfilRequest;
use App\Http\Requests\Backend\Plan\UpdatePlanRequest;
use App\Models\Auth\User;
use App\Models\Empresa;
use App\Models\EmpresaPago;
use App\Models\Planes;
use App\Models\Pago;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
class PlanesController extends Controller
{

    public function index(ManagePlanRequest $request)
    {

        $planes = Planes::orderBy('id', 'desc')->get();

        return view('backend.planes.index', compact('planes'));

    }

    public function create(ManagePlanRequest $request)
    {

        return view('backend.planes.create');
    }

    public function store(StorePlanRequest $request)
    {
        try {

            DB::beginTransaction();
            $planUf = Planes::orderBy('id', 'desc')->first();

            $plan              = new Planes();
            $plan->nombre      = $request->input('nombre');
            $plan->cantidad_uf = $request->input('cantidad_uf');
            $plan->costo       = $request->input('cantidad_uf') * $planUf->valor_uf;
            $plan->valor_uf    = $planUf->valor_uf;
            $plan->save();
            DB::commit();
            return redirect()->route('admin.planes.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('admin.planes.index')->withFlashDanger('Error desconocido por favor intentelo de nuevo si el error persiste contacte a su soporte técnico');
        }

    }

    public function edit(ManagePlanRequest $request, Planes $plan)
    {

        return view('backend.planes.edit', compact('plan'));
    }

    public function update(UpdatePlanRequest $request, Planes $plan)
    {
        try {

            DB::beginTransaction();
            $plan->nombre      = $request->input('nombre');
            $plan->cantidad_uf = $request->input('cantidad_uf');
            $plan->costo       = $plan->cantidad_uf * $plan->valor_uf;
            $plan->save();
            DB::commit();
            return redirect()->route('admin.planes.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('admin.planes.index')->withFlashDanger('Error desconocido por favor intentelo de nuevo si el error persiste contacte a su soporte técnico');
        }

    }

    public function destroy(ManagePlanRequest $request, Planes $plan)
    {
        try {
            DB::beginTransaction();
            $plan->delete();
            DB::commit();
            return redirect()->route('admin.planes.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.planes.index')->withFlashDanger('El plan no puede eliminarse ya que tiene registros asociados');
        }

    }

    public function perfil_planes(ManagePlanPerfilRequest $request)
    {

        $planes = Planes::where('id', 1)->orderBy('id', 'asc')->get();

        $empresaUser = Auth::user()->empresaUser();

        $planes = Planes::where('id', $empresaUser->plan_id)->orderBy('id', 'asc')->first();

        $pagos = EmpresaPago::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();

        return view('backend.planes.perfil_planes', compact('planes', 'empresaUser', 'pagos'));

    }

    public function print(Request $request, EmpresaPago $pago)
    {   
         $prot=Empresa::mainCompany();



        $pdf = PDF::loadView('backend.planes.pdf',compact(
                'pago','prot'
            ) );
            return $pdf->stream('planes.pdf');

      
         
    }

    public function activacionEmpresas(Request $request)
    {

        try {

            $empresa         = Empresa::where('empresas.id', $request['empresa_id'])->first();
            $empresa->activa = 1;
            $empresa->save();
            return response()->json($empresa);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }

    public function desactivacionEmpresas(Request $request)
    {

        try {

            $empresa         = Empresa::where('empresas.id', $request['empresa_id'])->first();
            $empresa->activa = 0;
            $empresa->save();
            return response()->json($empresa);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }

    public function updatePlanes(UpdatePlanPerfilRequest $request)
    {

        if ($request->input('empresa_id') != null) {
            $empresa          = Empresa::find($request->input('empresa_id'));
            $empresa->plan_id = $request->input('plan_id');
            $empresa->save();

            return redirect()->route('admin.perfil_planes')->withFlashSuccess(__('strings.frontend.user.profile_updated'));
        } else {
            return redirect()->route('admin.perfil_planes')->withFlashSuccess('El Usuario no tiene empresa creada');
        }

    }

/********Asignación***************/
    public function asignar(ManagePlanRequest $request)
    {

        $planes   = Planes::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('backend.planes.asignar', compact('planes', 'empresas'));

    }

    public function saveAsig(ManagePlanRequest $request)
    {
        $empresa          = Empresa::where('id', $request->input('empresa_id'))->first();
        $empresa->plan_id = $request->input('planes_id');
        $empresa->save();

        return redirect()->route('admin.planes.asignar')->withFlashSuccess('Plan asignado exitosamente');

    }

    public function getEmpresa(Request $request)
    {
        try {

            $empresa = Empresa::with('plan')->where('empresas.id', $request['empresa_id'])->first();
            return response()->json($empresa);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }

    public function getPlan(Request $request)
    {
        try {

            $plan = Planes::where('id', $request['plan_id'])->first();
            return response()->json($plan);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }
    /********Asignación***************/

    public function pagos()
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        $pagos = EmpresaPago::orderBy('id', 'desc')->get();

        $estados=['Pagada'=>'Pagada','Pendiente'=>'Pendiente'];

        return view('backend.planes.pagos', compact('empresas', 'pagos','estados'));
    }


    public function buscar(Request $request){


     
            $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
            $estados=['Pagada'=>'Pagada','Pendiente'=>'Pendiente'];


             $pagos = EmpresaPago::orderBy('id', 'desc');

            if ($request->input('empresa_id') != null) {
                $pagos = EmpresaPago::where('empresa_id', $request->input('empresa_id'));
            }

            if ($request->input('fecha_inicio') != null) {
                $pagos = $pagos->where('inicio_periodo', '>=', $request->input('fecha_inicio'));
            }

            if ($request->input('fecha_fin') != null) {
                $pagos = $pagos->where('fin_periodo', '<=', $request->input('fecha_fin'));
            }

            if ($request->input('estado') != null) {
                $pagos = $pagos->where('estado', $request->input('estado'));
            }

            $pagos = $pagos->get();

       

        return view('backend.planes.buscar', compact('empresas','pagos' ,'estados','request'));

    }
}
