<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Producto\ManageProductoRequest;
use App\Http\Requests\Backend\Producto\StoreProductoRequest;
use App\Http\Requests\Backend\Producto\UpdateProductoRequest;
use App\Models\ClienteProveedor;
use App\Models\Empresa;
use App\Models\EstadoVenta;
use App\Models\Producto;
use App\Models\TipoProducto;
use App\Models\Unidad;
use DB;
use Illuminate\Support\Facades\Auth;
use Storage;
use Validator;

class ProductosController extends Controller
{

    public function index()
    {

        $empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) {
            //Si el usuario es administrador puede ver todos los lotes
            if (auth()->user()->hasRole('administrator')) {

                $productos = Producto::orderBy('id', 'desc')->get();
            } else {
                $productos = Producto::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();

            }

            return view('backend.productos.index', compact('productos'));

        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function create(ManageProductoRequest $request)
    {
        $empresaUser = Auth::user()->empresaUser();
        if (auth()->user()->hasRole('administrator')) {

            $clienProv = ClienteProveedor::where('proveedor', 1)->pluck('nombre_razon', 'id');
        } else {

            $clienProv = ClienteProveedor::where('proveedor', 1)->where('empresa_id', $empresaUser->id)->pluck('nombre_razon', 'id');
        }

        $estadoVentas = EstadoVenta::orderBy('id', 'asc')->pluck('nombre', 'id');
        $unidades     = Unidad::orderBy('id', 'asc')->pluck('nombre', 'id');
        $empresas     = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        $tipoProductos = TipoProducto::orderBy('id', 'asc')->pluck('nombre', 'id');

        return view('backend.productos.create', compact('unidades', 'empresas', 'estadoVentas', 'clienProv', 'tipoProductos'));
    }

    public function store(StoreProductoRequest $request)
    {
        try {
            DB::beginTransaction();

            $path = '';
            if ($request->hasFile('ficha_tecnica')) {
                $validacion = Validator::make($request->all(), [
                    'ficha_tecnica' => 'mimes:jpg,jpeg,png,xls,xlsx,doc,docx,pdf|max:10000',
                ]);

                if ($validacion->fails()) {
                    DB::rollback();
                    return redirect()->back()->withInput($request->all())->withErrors($validacion);
                }

                $path = $request->file('ficha_tecnica')->store('/app/public/fichas_tecnicas');

            }

            $producto = new Producto();

            $producto->nombre               = $request->input('nombre');
            $producto->unidad_id            = $request->input('unidad_id');
            $producto->nombre               = $request->input('nombre');
            $producto->composicion          = $request->input('composicion');
            $producto->cliente_proveedor_id = $request->input('cliente_proveedor_id');
            $producto->ficha_tecnica        = $path;
            $producto->estado_venta_id      = $request->input('estado_venta_id');
            $producto->precio_venta         = $request->input('precio_venta');
            $producto->precio_compra        = $request->input('precio_compra');
            $producto->tipo_producto_id     = $request->input('tipo_producto_id');

            if (auth()->user()->hasRole('administrator')) {
                $empresaUser = Auth::user()->empresaUser();

                $producto->empresa_id = $request->input('empresa_id');

            } else {

                $empresaUser          = Auth::user()->empresaUser();
                $producto->empresa_id = $empresaUser->id;

            }
            $producto->save();
            DB::commit();
            return redirect()->route('admin.productos.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.productos.index')->withFlashDanger('Error Inesperado');
        }

    }

    public function edit(ManageProductoRequest $request, Producto $producto)
    {
        $empresaUser = Auth::user()->empresaUser();
        if (auth()->user()->hasRole('administrator')) {

            $clienProv = ClienteProveedor::where('proveedor', 1)->pluck('nombre_razon', 'id');
        } else {

            $clienProv = ClienteProveedor::where('proveedor', 1)->where('empresa_id', $empresaUser->id)->pluck('nombre_razon', 'id');
        }
    $estadoVentas = EstadoVenta::orderBy('id', 'asc')->pluck('nombre', 'id');
    $unidades     = Unidad::orderBy('id', 'asc')->pluck('nombre', 'id');
    $empresas     = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

    $tipoProductos = TipoProducto::orderBy('id', 'asc')->pluck('nombre', 'id');

    return view('backend.productos.edit', compact('unidades', 'empresas', 'producto', 'estadoVentas', 'clienProv', 'tipoProductos'));

}

function update(UpdateProductoRequest $request, Producto $producto)
{
    try {
        DB::beginTransaction();

        if ($request->hasFile('ficha_tecnica')) {
            $validacion = Validator::make($request->all(), [
                'ficha_tecnica' => 'mimes:jpg,jpeg,png,xls,xlsx,doc,docx,pdf|max:10000',
            ]);

            if ($validacion->fails()) {
                DB::rollback();
                return redirect()->back()->withErrors($validacion);
            }
            \File::delete($producto->ficha_tecnica);
            $producto->ficha_tecnica = $request->file('ficha_tecnica')->store('/app/public/fichas_tecnicas');

        }

        $producto->nombre               = $request->input('nombre');
        $producto->unidad_id            = $request->input('unidad_id');
        $producto->nombre               = $request->input('nombre');
        $producto->composicion          = $request->input('composicion');
        $producto->cliente_proveedor_id = $request->input('cliente_proveedor_id');
        $producto->estado_venta_id      = $request->input('estado_venta_id');
        $producto->precio_venta         = $request->input('precio_venta');
        $producto->precio_compra        = $request->input('precio_compra');
        $producto->tipo_producto_id     = $request->input('tipo_producto_id');

        if (auth()->user()->hasRole('administrator')) {
            $empresaUser = Auth::user()->empresaUser();

            $producto->empresa_id = $request->input('empresa_id');

        } else {

            $empresaUser          = Auth::user()->empresaUser();
            $producto->empresa_id = $empresaUser->id;

        }
        $producto->save();
        DB::commit();
        return redirect()->route('admin.productos.index')->withFlashSuccess('Registro Editado con éxito');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->route('admin.productos.index')->withFlashSuccess('Error Inesperado');
    }

}

function show(ManageProductoRequest $request, Producto $producto)
{
     $empresaUser = Auth::user()->empresaUser();
      if (auth()->user()->hasRole('administrator')) {

            $clienProv = ClienteProveedor::where('proveedor', 1)->pluck('nombre_razon', 'id');
        } else {

            $clienProv = ClienteProveedor::where('proveedor', 1)->where('empresa_id', $empresaUser->id)->pluck('nombre_razon', 'id');
        }

    $estadoVentas  = EstadoVenta::orderBy('id', 'asc')->pluck('nombre', 'id');
    $unidades      = Unidad::orderBy('id', 'asc')->pluck('nombre', 'id');
    $empresas      = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
    
    $tipoProductos = TipoProducto::orderBy('id', 'asc')->pluck('nombre', 'id');

   

    return view('backend.productos.show', compact('unidades', 'empresas', 'producto', 'estadoVentas', 'clienProv', 'tipoProductos'));

}

/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Salones  $salones
 * @return \Illuminate\Http\Response
 */
function destroy(ManageProductoRequest $request, Producto $producto)
{
    try {
        DB::beginTransaction();
        $producto->delete();
        DB::commit();
        return redirect()->route('admin.productos.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
    } catch (\Exception $e) {
        DB::rollback();
        
        return redirect()->route('admin.productos.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
    }

}

}
