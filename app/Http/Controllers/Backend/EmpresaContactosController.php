<?php

namespace App\Http\Controllers\Backend;

ini_set('memory_limit', '-1');

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\EmpresaContacto\ManageContactoRequest;
use App\Http\Requests\Backend\EmpresaContacto\StoreContactoRequest;
use App\Http\Requests\Backend\EmpresaContacto\UpdateContactoRequest;
use App\Imports\ContactosImport;
use App\Models\ClienteProveedor;
use App\Models\EmpresaContacto;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class EmpresaContactosController extends Controller
{
    public function index()
    {
        $empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) {
            if (auth()->user()->hasRole('administrator')) {

                $contactos = EmpresaContacto::where('user_empresa_id', $empresaUser->id)->orderBy('id','desc')->get();
            } else {
                $contactos = EmpresaContacto::where('user_empresa_id', $empresaUser->id)->orderBy('id','desc')->get();
            }
                return view('backend.empresa_contactos.index', compact('contactos'));

        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function create(ManageContactoRequest $request)
    {
        $empresaUser = Auth::user()->empresaUser();

        $clienteProveedores = ClienteProveedor::where('empresa_id', $empresaUser->id)->orderBy('nombre_razon', 'asc')->pluck('nombre_razon', 'id');

        return view('backend.empresa_contactos.create', compact('clienteProveedores'));
    }

    public function store(StoreContactoRequest $request)
    {
        $empresaUser = Auth::user()->empresaUser();
        try
        {
            DB::beginTransaction();

            $path = '';

            if ($request->hasFile('foto')) {
                $validacion = Validator::make($request->all(),
                    [
                        'foto' => 'mimes:jpg,jpeg,png',
                    ]);

                if ($validacion->fails()) {
                    DB::rollback();

                    return redirect()->back()->withInput($request->all())->withErrors($validadion);
                }

                $path = $request->file('foto')->store('app/public/contactos');

            }

            $contacto                   = new EmpresaContacto();
            $contacto->nombres          = $request->input('nombres');
            $contacto->apellidos        = $request->input('apellidos');
            $contacto->email            = $request->input('email');
            $contacto->celular          = $request->input('celular');
            $contacto->user_empresa_id  = $empresaUser->id;            
            $contacto->cliente_proveedor_id = $request->input('cliente_proveedor_id');
            
            //if ($request->input('cliente_proveedor_id') != null) {
            //    $contacto->cliente_proveedor_id = $request->input('cliente_proveedor_id');
            //    $contacto->user_empresa_id=null;
            //} else {
            //    $contacto->cliente_proveedor_id = null;
            //    $contacto->user_empresa_id = $empresaUser->id;

            //}

            $contacto->foto = $path;

            $contacto->save();

            DB::commit();

            return redirect()->route('admin.contactos.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.contactos.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function edit(ManageContactoRequest $request, EmpresaContacto $contacto)
    {
        $empresaUser = Auth::user()->empresaUser();

        $clienteProveedores = ClienteProveedor::where('empresa_id', $empresaUser->id)->orderBy('nombre_razon', 'asc')->pluck('nombre_razon', 'id');

        return view('backend.empresa_contactos.edit', compact('contacto', 'clienteProveedores'));
    }

    public function update(UpdateContactoRequest $request, EmpresaContacto $contacto)
    {
        $empresaUser = Auth::user()->empresaUser();
        try {
            DB::beginTransaction();
            if ($request->hasFile('foto')) {

                $validacion = Validator::make($request->all(), [
                    'foto' => 'mimes:jpg,jpeg,png',
                ]);

                if ($validacion->fails()) {
                    DB::rollback();
                    return redirect()->back()->withErrors($validacion);
                }

                \File::delete($contacto->foto);
                $contacto->foto = $request->file('foto')->store('/app/public/contactos');

            }

            $contacto->nombres              = $request->input('nombres');
            $contacto->apellidos            = $request->input('apellidos');
            $contacto->email                = $request->input('email');
            $contacto->celular              = $request->input('celular');
            $contacto->user_empresa_id      = $empresaUser->id;            
            $contacto->cliente_proveedor_id = $request->input('cliente_proveedor_id');


            //if ($request->input('cliente_proveedor_id') != null) {
            //    $contacto->cliente_proveedor_id = $request->input('cliente_proveedor_id');
            //    $contacto->user_empresa_id=null;
            //} else {
            //    $contacto->cliente_proveedor_id = null;
            //    $contacto->user_empresa_id = $empresaUser->id;

            //}
            $contacto->save();

            DB::commit();

            return redirect()->route('admin.contactos.index')->withFlashSuccess('Registro Editado con éxito');

        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
         
            return redirect()->route('admin.contactos.index')->withFlashDanger('Error Inesperado');
        }
    }

    public function show(ManageContactoRequest $request, EmpresaContacto $contacto)
    {
        $empresaUser        = Auth::user()->empresaUser();
        $clienteProveedores = ClienteProveedor::where('empresa_id', $empresaUser->id)->orderBy('nombre_razon', 'asc')->pluck('nombre_razon', 'id');

        return view('backend.empresa_contactos.show', compact('contacto', 'clienteProveedores'));
    }

    public function destroy(ManageContactoRequest $request, EmpresaContacto $contacto)
    {
        try
        {
            DB::beginTransaction();
            \File::delete($contacto->foto);
            $contacto->delete();
            DB::commit();

            return redirect()->route('admin.contactos.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.contactos.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }
    }

    public function importar(Request $request)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('archivo')) {

                $validacion = Validator::make(
                    [
                        'file'      => $request->archivo,
                        'extension' => strtolower($request->archivo->getClientOriginalExtension()),
                    ],
                    [
                        'file'      => 'required|max:50000',
                        'extension' => 'required|in:xlsx,xls',
                    ]
                );

                if ($validacion->fails()) {

                    return redirect()->back()->withErrors($validacion);
                }

                Excel::import(new ContactosImport, request()->file('archivo'));
                DB::commit();
                return redirect()->route('admin.contactos.index')->withFlashSuccess('Contactos Importados satisfactoriamente');
            } else {
                return redirect()->route('admin.contactos.index')->withFlashDanger('Hubo un error en la importación, por favor intente de nuevo');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.contactos.index')->withFlashSuccess('Error Inesperado');
        }
    }
}
