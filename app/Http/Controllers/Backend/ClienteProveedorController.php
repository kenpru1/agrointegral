<?php

namespace App\Http\Controllers\Backend;

ini_set('memory_limit', '-1');

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ClienteProveedor\ManageClienteProveedorRequest;
use App\Http\Requests\Backend\ClienteProveedor\StoreClienteProveedorRequest;
use App\Http\Requests\Backend\ClienteProveedor\UpdateClienteProveedorRequest;
use App\Imports\ClientesProveedoresImport;
use App\Models\Auth\User;
use App\Models\ClienteProveedor;
use App\Models\Comuna;
use App\Models\Empresa;
use App\Models\EmpresaContacto;
use App\Models\Grupo;
use App\Models\Paises;
use App\Models\Provincia;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class ClienteProveedorController extends Controller {

	//public function __construct() {
	//	$this->ruta = request()->route()->getName();
	//}

	public function index_cliente(ManageClienteProveedorRequest $request) {

		$empresaUser = User::find(Auth::id())->empresas()->first();
		$picked = 1;

		if ($empresaUser != null) {
			if (auth()->user()->hasRole('administrator')) {
				$cliProves = ClienteProveedor::where('cliente', '=', 1)->orderBy('id', 'desc')->get();
				$contactos = EmpresaContacto::where('user_empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();
			} else {
				$cliProves = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('cliente', '=', 1)->orderBy('id', 'desc')->get();

				$contactos = EmpresaContacto::where('user_empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();
				//$contactos = $empresaUser->empresaContacto;

				//$contactos=$contactos->merge($contactosLibres);
			}

			return view('backend.cliente_proveedor.index', compact('cliProves', 'contactos', 'picked'));

		} else {
			return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
		}
	}

	public function index_proveedor(ManageClienteProveedorRequest $request) {

		$empresaUser = User::find(Auth::id())->empresas()->first();
		$picked = 1;

		if ($empresaUser != null) {
			if (auth()->user()->hasRole('administrator')) {
				$cliProves = ClienteProveedor::where('proveedor', '=', 1)->orderBy('id', 'desc')->get();
				$contactos = EmpresaContacto::orderBy('id', 'desc')->get();
			} else {
				$cliProves = ClienteProveedor::where('empresa_id', $empresaUser->id)->where('proveedor', '=', 1)->orderBy('id', 'desc')->get();

				$contactosLibres = EmpresaContacto::where('user_empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();
				$contactos = $empresaUser->empresaContacto;

				$contactos = $contactos->merge($contactosLibres);
			}

			return view('backend.cliente_proveedor.index', compact('cliProves', 'contactos', 'picked'));

		} else {
			return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
		}
	}

	public function create(ManageClienteProveedorRequest $request) {

		$empresaUser = User::find(Auth::id())->empresas()->first();
		$paises = Paises::orderBy('nombre', 'asc')->pluck('nombre', 'id');
		$grupos = Grupo::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
		$empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
		$provincias = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');

		return view('backend.cliente_proveedor.create', compact('provincias', 'empresas', 'paises', 'grupos'));

	}

	public function store(StoreClienteProveedorRequest $request) {
		try {
			$enlace = request()->route()->getName();

			DB::beginTransaction();
			$empresaUser = User::find(Auth::id())->empresas()->first();

			if ($empresaUser != null) {
				$cliProves = new ClienteProveedor();
				$cliProves->nombre_razon = $request->input('nombre_razon');
				$cliProves->rut = $request->input('rut');
				$cliProves->email = $request->input('email');
				$cliProves->telefono = $request->input('telefono');
				$cliProves->direccion = $request->input('direccion');
				$cliProves->codigo_postal = $request->input('codigo_postal');
				$cliProves->grupo_id = $request->input('grupo_id');
				$cliProves->web = $request->input('web');
				$cliProves->proveedor = $request->input('proveedor');
				$cliProves->cliente = $request->input('cliente');
				$cliProves->provincia_id = $request->input('provincia_id');
				$cliProves->comuna_id = $request->input('comuna_id');
				$cliProves->pais_id = $request->input('pais_id');
				$cliProves->observacion = $request->input('observacion');

				if (auth()->user()->hasRole('administrator')) {

					$cliProves->empresa_id = $request->input('empresa_id');

				} else {

					$cliProves->empresa_id = $empresaUser->id;

				}
				$cliProves->save();
				DB::commit();
				if ($enlace == 'admin.cliente.store') {
					return redirect()->route('admin.clientes.index')->withFlashSuccess('Registro creado con éxito');
				} else {
					return redirect()->route('admin.proveedor.index')->withFlashSuccess('Registro creado con éxito');
				}
			} else {
				if ($enlace == 'admin.cliente.store') {
					return redirect()->route('admin.clientes.index')->withFlashSuccess('Usuario sin empresa registrada, por favor introduzar primero los datos de la empresa a la que representa');
				} else {
					return redirect()->route('admin.proveedor.index')->withFlashSuccess('Usuario sin empresa registrada, por favor introduzar primero los datos de la empresa a la que representa');
				}
			}
		} catch (\Exception $e) {
			dd($e);
			DB::rollback();
			if ($enlace == 'admin.cliente.store') {
				return redirect()->route('admin.clientes.index')->withFlashSuccess('Error Inesperado');
			} else {
				return redirect()->route('admin.proveedor.index')->withFlashSuccess('Error Inesperado');
			}
		}

	}

	public function edit(ManageClienteProveedorRequest $request, ClienteProveedor $clienteProveedor) {

		//$ruta = request()->route()->getName();

		$empresaUser = User::find(Auth::id())->empresas()->first();
		$paises = Paises::orderBy('nombre', 'asc')->pluck('nombre', 'id');
		$grupos = Grupo::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
		$empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
		$provincias = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
		$comunas = Comuna::where('id', $clienteProveedor->comuna_id)->pluck('nombre', 'id');
		//if($ruta == 'admin.cliente.store') {
		return view('backend.cliente_proveedor.edit', compact('provincias', 'empresas', 'paises', 'comunas', 'grupos', 'clienteProveedor'));
		//}else{
		//    return view('backend.cliente_proveedor.edit', compact('provincias', 'empresas', 'paises', 'comunas', 'clienteProveedor'));
		//}
	}

	public function update(UpdateClienteProveedorRequest $request, ClienteProveedor $clienteProveedor) {

		$ruta = request()->route()->getName();
		try {

			DB::beginTransaction();
			$empresaUser = User::find(Auth::id())->empresas()->first();

			if ($empresaUser != null) {
				$clienteProveedor->nombre_razon = $request->input('nombre_razon');
				$clienteProveedor->rut = $request->input('rut');
				$clienteProveedor->email = $request->input('email');
				$clienteProveedor->telefono = $request->input('telefono');
				$clienteProveedor->direccion = $request->input('direccion');
				$clienteProveedor->codigo_postal = $request->input('codigo_postal');
				$clienteProveedor->grupo_id = $request->input('grupo_id');
				$clienteProveedor->web = $request->input('web');
				$clienteProveedor->proveedor = $request->input('proveedor');
				$clienteProveedor->cliente = $request->input('cliente');
				$clienteProveedor->provincia_id = $request->input('provincia_id');
				$clienteProveedor->comuna_id = $request->input('comuna_id');
				$clienteProveedor->pais_id = $request->input('pais_id');
				$clienteProveedor->observacion = $request->input('observacion');

				if (auth()->user()->hasRole('administrator')) {

					$clienteProveedor->empresa_id = $request->input('empresa_id');

				} else {

					$clienteProveedor->empresa_id = $empresaUser->id;

				}
				$clienteProveedor->save();
				DB::commit();
				if ($ruta == 'admin.cliente.update') {
					return redirect()->route('admin.clientes.index')->withFlashSuccess('Registro editado con éxito');
				} else {
					return redirect()->route('admin.proveedor.index')->withFlashSuccess('Registro editado con éxito');
				}
			} else {
				if ($ruta == 'admin.cliente.update') {
					return redirect()->route('admin.clientes.index')->withFlashSuccess('Usuario sin empresa registrada, por favor introduzar primero los datos de la empresa a la que representa');
				} else {
					return redirect()->route('admin.proveedor.index')->withFlashSuccess('Usuario sin empresa registrada, por favor introduzar primero los datos de la empresa a la que representa');
				}
			}
		} catch (\Exception $e) {

			DB::rollback();
			if ($ruta == 'admin.cliente.update') {
				return redirect()->route('admin.clientes.index')->withFlashSuccess('Error Inesperado');
			} else {
				return redirect()->route('admin.proveedor.index')->withFlashSuccess('Error Inesperado');
			}

		}

	}

	public function show(ManageClienteProveedorRequest $request, ClienteProveedor $clienteProveedor) {

		$empresaUser = User::find(Auth::id())->empresas()->first();
		$paises = Paises::orderBy('nombre', 'asc')->pluck('nombre', 'id');
		$grupos = Grupo::where('empresa_id', $empresaUser->id)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
		$empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
		$provincias = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
		$comunas = Comuna::where('id', $clienteProveedor->comuna_id)->pluck('nombre', 'id');

		return view('backend.cliente_proveedor.show', compact('provincias', 'empresas', 'paises', 'comunas', 'grupos', 'clienteProveedor'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Salones  $salones
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(ManageClienteProveedorRequest $request, ClienteProveedor $clienteProveedor) {
		try {
			$ruta = request()->route()->getName();
			DB::beginTransaction();

			$clienteProveedor->delete();
			DB::commit();
			if ($ruta == 'admin.cliente.destroy') {
				return redirect()->route('admin.clientes.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
			} else {
				return redirect()->route('admin.proveedor.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
			}
		} catch (\Exception $e) {

			DB::rollback();
			if ($ruta == 'admin.cliente.destroy') {
				return redirect()->route('admin.clientes.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
			} else {
				return redirect()->route('admin.proveedor.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
			}
		}

	}

	public function importar(Request $request) {

		try {
			DB::beginTransaction();
			if ($request->hasFile('archivo')) {

				$validacion = Validator::make(
					[
						'file' => $request->archivo,
						'extension' => strtolower($request->archivo->getClientOriginalExtension()),
					],
					[
						'file' => 'required|max:50000',
						'extension' => 'required|in:xlsx,xls',
					]
				);

				if ($validacion->fails()) {

					return redirect()->back()->withErrors($validacion);
				}

				Excel::import(new ClientesProveedoresImport, request()->file('archivo'));
				DB::commit();
				return redirect()->route('admin.clientes.index')->withFlashSuccess('Empresas Importadas satisfactoriamente');
			} else {
				return redirect()->route('admin.cliente_proveedor.index')->withFlashDanger('Hubo un error en la importación, por favor intente de nuevo');
			}
		} catch (\Exception $e) {

			dd($e);
			DB::rollback();
			return redirect()->route('admin.cliente_proveedor.index')->withFlashSuccess('Error Inesperado');
		}
	}

	public function buscarEmpresaContacto(Request $request) {
		$empresaUser = User::find(Auth::id())->empresas()->first();
		$picked = $request->input('picked');

		if (auth()->user()->hasRole('administrator')) {
			$cliProves = ClienteProveedor::orderBy('id', 'desc')->get();
			$contactos = EmpresaContacto::orderBy('id', 'desc')->get();
		} else {
			$cliProves = ClienteProveedor::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();

			$contactosLibres = EmpresaContacto::where('user_empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();

			$contactos = $empresaUser->empresaContacto;

			$contactos = $contactos->merge($contactosLibres);
		}

		if ($picked == 0) {
			$find = ClienteProveedor::query();
			$cliente_proveedor = $request->input('cliente_proveedor');

			$find->when($cliente_proveedor != null, function ($query) use ($cliente_proveedor, $empresaUser) {
				return $query->where('nombre_razon', 'like', '%' . $cliente_proveedor . '%')->where(function ($add) use ($empresaUser) {
					$add->where('empresa_id', $empresaUser->id);
				});
			});

			$find->get();

			$cliProves = $find->paginate(8);

			return view('backend.cliente_proveedor.index', compact('cliProves', 'contactos', 'picked'));
		} elseif ($picked == 1) {
			$find = EmpresaContacto::query();
			$nombre_contacto = $request->input('nombre_contacto');
			$apellido_contacto = $request->input('apellido_contacto');

			$find->when($nombre_contacto != null, function ($query) use ($nombre_contacto, $empresaUser) {
				return $query->where('nombres', 'like', '%' . $nombre_contacto . '%')
					->whereHas('clienteProveedor', function ($add) use ($empresaUser) {
						$add->where('empresa_id', $empresaUser->id);
					})->orWhere(function ($add2) use ($nombre_contacto, $empresaUser) {
					$add2->where('user_empresa_id', $empresaUser->id)
						->where('nombres', 'like', '%' . $nombre_contacto . '%');
				});
			});

			$find->when($apellido_contacto != null, function ($query) use ($apellido_contacto, $empresaUser) {
				return $query->where('apellidos', 'like', '%' . $apellido_contacto . '%')
					->whereHas('clienteProveedor', function ($add) use ($empresaUser) {
						$add->where('empresa_id', $empresaUser->id);
					})->orWhere(function ($add2) use ($apellido_contacto, $empresaUser) {
					$add2->where('user_empresa_id', $empresaUser->id)
						->where('apellidos', 'like', '%' . $apellido_contacto . '%');
				});
			});

			$find->get();

			$contactos = $find->paginate(8);

			return view('backend.cliente_proveedor.index', compact('cliProves', 'contactos', 'picked'));
		}
	}

}
