<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Campo\ManageCampoRequest;
use App\Http\Requests\Backend\Campo\StoreCampoRequest;
use App\Http\Requests\Backend\Campo\UpdateCampoRequest;
use App\Models\Auth\User;
use App\Models\Campo;
use App\Models\ClienteProveedor;
use App\Models\Comuna;
use App\Models\Empresa;
use App\Models\Provincia;
use App\Models\Trabajador;
use App\Models\EmpresaContacto;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class CamposController extends Controller
{
    public function index()
    {
        $empresaUser = User::find(Auth::id())->empresas()->first();

    
        if ($empresaUser != null) {
            

            //Si el usuario es administrador puede ver todos los lotes
            if (auth()->user()->hasRole('administrator')) {

                $campos = Campo::orderBy('id','desc')->get();
            } else {
                $campos = Campo::where('empresa_id', $empresaUser->id)->orderBy('id','desc')->get();
            }

            return view('backend.campos.index', compact('campos'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function create(ManageCampoRequest $request)
    {
        
        $empresaUser = Auth::user()->empresaUser();
        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $provincias = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $propio=['1'=>'Propio','0'=>'Arrendado'];
        $trabajadores = Trabajador::where('empresa_id',$empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $clientes    = ClienteProveedor::where('empresa_id',$empresaUser->id)->orderBy('nombre_razon', 'asc')->orderBy('id', 'asc')->pluck('nombre_razon', 'id');   

        return view('backend.campos.create', compact('provincias', 'empresas','propio','trabajadores','clientes'));

    }

    public function store(StoreCampoRequest $request)
    {
        try {
            DB::beginTransaction();
            $empresaUser = User::find(Auth::id())->empresas()->first();

            if ($empresaUser != null) {
                $campo               = new Campo();
                $campo->nombre                  = $request->input('nombre');
                $campo->propio                  = $request->input('propio');
                $campo->provincia_id            = $request->input('provincia_id');
                $campo->comuna_id               = $request->input('comuna_id');
                $campo->trabajador_id           = $request->input('trabajador_id');
                $campo->cliente_proveedor_id    = $request->input('cliente_proveedor_id'); 
                $campo->empresa_contacto_id    = $request->input('empresa_contacto_id');
                $campo->tamanno      = $request->input('tamanno');

                //$campo->empresa_id   = $empresaUser->id;
                if (auth()->user()->hasRole('administrator')) {

                    $campo->empresa_id = $request->input('empresa_id');

                } else {

                    $empresaUser             = Auth::user()->empresaUser();
                    $campo->empresa_id = $empresaUser->id;

                }

                $campo->descripcion = $request->input('descripcion');

                $campo->save();
                DB::commit();
                return redirect()->route('admin.campos.index')->withFlashSuccess('Registro creado con éxito');
            } else {
                return redirect()->route('admin.campos.index')->withFlashDanger('Usuario sin empresa registrada, por favor introduzar primero los datos de la empresa a la que representa');
            }

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.campos.index')->withFlashSuccess('Error Inesperado');
        }
    }

    /**
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     */
    public function edit(ManageCampoRequest $request, Campo $campo)
    {

        $empresaUser             = Auth::user()->empresaUser();
        $provincias = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        $comuna = Comuna::where('id', $campo->comuna_id)->pluck('nombre', 'id');

        $contacto    = EmpresaContacto::where('id', $campo->empresa_contacto_id)->orderBy('id', 'asc')->get()->pluck('nombre_and_apellido', 'id');
       

        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $propio=['1'=>'Propio','0'=>'Arrendado'];
        $trabajadores = Trabajador::where('empresa_id',$empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $clientes    = ClienteProveedor::where('empresa_id',$empresaUser->id)->orderBy('nombre_razon', 'asc')->orderBy('id', 'asc')->pluck('nombre_razon', 'id');   

        return view('backend.campos.edit')->with(compact('campo', 'provincias', 'comuna','empresas','propio','trabajadores','clientes','contacto'));
    }

    public function update(UpdateCampoRequest $request, Campo $campo)
    {
        try {
            DB::beginTransaction();
            $campo->nombre                  = $request->input('nombre');
            $campo->propio                  = $request->input('propio');
            $campo->provincia_id            = $request->input('provincia_id');
            $campo->trabajador_id           = $request->input('trabajador_id');
            $campo->cliente_proveedor_id    = $request->input('cliente_proveedor_id');   
            $campo->comuna_id               = $request->input('comuna_id');
            $campo->tamanno                 = $request->input('tamanno');
            $campo->descripcion             = $request->input('descripcion');
            $campo->empresa_contacto_id    = $request->input('empresa_contacto_id');
            if (auth()->user()->hasRole('administrator')) {

                    $campo->empresa_id = $request->input('empresa_id');

                } else {

                    $empresaUser             = Auth::user()->empresaUser();
                    $campo->empresa_id = $empresaUser->id;

                }
            $campo->save();
            DB::commit();
            return redirect()->route('admin.campos.index')->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            return redirect()->route('admin.campos.index')->withFlashDanger('Error Inesperado');
        }

    }

    public function show(ManageCampoRequest $request, Campo $campo)
    {
        $empresaUser             = Auth::user()->empresaUser();

        $provincias = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        $comuna = Comuna::where('id', $campo->comuna_id)->pluck('nombre', 'id');
        $contacto    = EmpresaContacto::where('id', $campo->empresa_contacto_id)->orderBy('id', 'asc')->get()->pluck('nombre_and_apellido', 'id');

        $empresas   = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $propio=['1'=>'Propio','0'=>'Arrendado'];
        $trabajadores = Trabajador::where('empresa_id',$empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $clientes    = ClienteProveedor::where('empresa_id',$empresaUser->id)->orderBy('nombre_razon', 'asc')->orderBy('id', 'asc')->pluck('nombre_razon', 'id');   

        return view('backend.campos.show')->with(compact('campo', 'provincias', 'comuna','empresas','propio','trabajadores','clientes','contacto'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageCampoRequest $request, Campo $campo)
    {
        try {
            DB::beginTransaction();
            $campo->delete();
            DB::commit();
            return redirect()->route('admin.campos.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.campos.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }

    }

    public function getComunas(Request $request)
    {
        try {

            $comunas = Comuna::where('provincia_id', $request['provincia_id'])->get();
            return response()->json($comunas);

        } catch (\Exception $e) {

            return response()->json('Error Inesperado', 404);
        }

    }
}
