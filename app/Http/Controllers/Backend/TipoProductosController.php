<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TipoProducto;
use App\Http\Requests\Backend\TipoProducto\ManageTipoProductoRequest;
use App\Http\Requests\Backend\TipoProducto\StoreTipoProductoRequest;
use App\Http\Requests\Backend\TipoProducto\UpdateTipoProductoRequest;
use DB;
use Illuminate\Http\Request;

class TipoProductosController extends Controller
{
    public function index()
    {

        $tipoProductos = TipoProducto::all();
        return view('backend.tipo_productos.index', compact('tipoProductos'));
    }

    public function create(ManageTipoProductoRequest $request)
    {

        return view('backend.tipo_productos.create');

    }

    public function store(StoreTipoProductoRequest $request)
    {
        try {
            DB::beginTransaction();
            $tipoProducto         = new TipoProducto();
            $tipoProducto->nombre = $request->input('nombre');
            $tipoProducto->save();
            DB::commit();
            return redirect()->route('admin.tipo_productos.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.tipo_productos.index')->withFlashSuccess('Error Inesperado');
        }
    }


    public function edit(ManageTipoProductoRequest $request, TipoProducto $tipoProducto)
    {

        return view('backend.tipo_productos.edit',compact('tipoProducto'));

    }


    public function update(UpdateTipoProductoRequest $request,TipoProducto $tipoProducto)
    {
        try {
            DB::beginTransaction();
            $tipoProducto->nombre = $request->input('nombre');
            $tipoProducto->save();
            DB::commit();
            return redirect()->route('admin.tipo_productos.index')->withFlashSuccess('Registro modificado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.tipo_productos.index')->withFlashDanger('Error. No es posible eliminar, ya que tiene registros asociados');
        }
    }


 public function destroy(ManageTipoProductoRequest $request, TipoProducto $tipoProducto)
    {
        try {
            DB::beginTransaction();
            $tipoProducto->delete();
            DB::commit();
            return redirect()->route('admin.tipo_productos.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.tipo_productos.index')->withFlashSuccess('Error Inesperado');
        }

    }




}
