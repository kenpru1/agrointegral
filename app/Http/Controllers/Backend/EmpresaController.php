<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Empresa\ManageEmpresaRequest;
use App\Http\Requests\Backend\Empresa\ManageEmpresaPerfilRequest;
use App\Http\Requests\Backend\Empresa\UpdateEmpresaPerfilRequest;
use App\Models\Auth\User;
use App\Models\Comuna;
use App\Models\Correlativo;
use App\Models\Empresa;
use App\Models\EmpresaUser;
use App\Models\Paises;
use DB;
use File;
use Illuminate\Support\Facades\Auth;
use Validator;

class EmpresaController extends Controller
{
    public function index(ManageEmpresaRequest $request)
    {

        $empresas = Empresa::orderBy('id', 'desc')->get();

        //dd($empresas);

        return view('backend.empresa.index', compact('empresas'));

    }

    public function perfil_empresa(ManageEmpresaPerfilRequest $request)
    {

        $paises = Paises::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        $selected = Paises::where('nombre', 'chile')->first();

        $facturacion = ['Si' => 'Si', 'No' => 'No'];
        $empresaUser = Auth::user()->empresaUser();

        return view('backend.empresa.perfil_empresa', compact('paises', 'selected', 'empresaUser', 'facturacion'));

    }

    public function updateEmpresa(UpdateEmpresaPerfilRequest $request)
    {

        try {

            DB::beginTransaction();

            if ($request->input('empresa_id') == 0) {

                $findEmp = Empresa::where('nombre', $request->input('nombre'))->first();

                if ($findEmp == null) {

                    $empresa = new Empresa();
                } else {

                    return redirect()->route('admin.perfil_empresa')->withFlashDanger('El nombre de la empresa ya ha sido utlizado, por favor verifique');

                }

            } else {
                $empresa = Empresa::find($request->input('empresa_id'));
            }

            $path = '';
            if ($request->hasFile('logo')) {
                $validacion = Validator::make($request->all(), [
                    'logo' => 'mimes:jpg,jpeg,png',
                ]);

                if ($validacion->fails()) {
                    DB::rollback();
                    return redirect()->back()->withInput($request->all())->withErrors($validacion);
                }

                if (isset(Auth::user()->empresas()->first()->logo) && Auth::user()->empresas()->first()->logo != null && $request->input('logo') != null) {

                    \File::delete(Auth::user()->empresas()->first()->logo);
                }

                $path          = $request->file('logo')->store('/app/public/logos_empresas');
                $empresa->logo = $path;

            }

            $empresa->nombre        = $request->input('nombre');
            $empresa->rut_dni       = $request->input('rut_dni');
            $empresa->direccion     = $request->input('direccion');
            $empresa->comuna        = $request->input('comuna');
            $empresa->ciudad        = $request->input('ciudad');
            $empresa->pais_id       = $request->input('pais_id');
            $empresa->plan_id       = 1;
            $empresa->codigo_postal = $request->input('codigo_postal');
            $empresa->email         = $request->input('email');
            $empresa->facturacion   = $request->input('facturacion');
            $empresa->giro          = $request->input('giro');

            $empresa->save();

            if ($request->input('empresa_id') == 0) {
                $empresaUser             = new EmpresaUser();
                $empresaUser->empresa_id = $empresa->id;
                $empresaUser->user_id    = Auth::id();
                $empresaUser->save();
            }

            //Creación de correlativos de diferentes documentos
            $correlativo = Correlativo::where('empresa_id', $empresa->id)->first();

            if ($correlativo == null) {
                $cor              = new Correlativo();
                $cor->presupuesto = 0;
                $cor->empresa_id  = $empresa->id;
                $cor->save();
            }

            DB::commit();

            return redirect()->route('admin.perfil_empresa')->withFlashSuccess(__('strings.frontend.user.profile_updated'));
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('admin.perfil_empresa')->withFlashSuccess('Error Inesperado');
        }

    }

}
