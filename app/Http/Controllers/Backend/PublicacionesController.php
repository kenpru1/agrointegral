<?php

namespace App\Http\Controllers\Backend;

ini_set('memory_limit', '-1');
ini_set('post_max_size', '-1');
ini_set('upload_max_filesize', '-1');
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Publicacion\StorePublicacionRequest;
use App\Http\Requests\Backend\Publicacion\UpdatePublicacionRequest;
use App\Models\Comuna;
use App\Models\EstadoPublicacion;
use App\Models\Producto;
use App\Models\Provincia;
use App\Models\Publicacion;
use App\Models\PublicacionImagen;
use App\Models\TipoActividad;
use App\Models\TipoEnvio;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Image;
use Storage;

class PublicacionesController extends Controller
{
    public function index()
    {

        $empresaUser = Auth::user()->empresaUser();
        if ($empresaUser != null) {
            $publicaciones = Publicacion::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();

            $this->limpiar();

            return view('backend.publicaciones.index', compact('publicaciones'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function create(Request $request)
    {

        $this->limpiar();

        $clasificacion = array(0 => 'Producto', 1 => 'Servicio');
        $productos     = Producto::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $servicios     = TipoActividad::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $provincias    = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $tipoEnvios    = TipoEnvio::orderBy('descripcion', 'asc')->pluck('descripcion', 'id');
        $create        = 1;
        $publicacion   = null;
        return view('backend.publicaciones.create', compact('clasificacion', 'productos', 'servicios', 'provincias', 'tipoEnvios', 'create', 'publicacion'));

    }

    public function store(StorePublicacionRequest $request)
    {

        try {
            DB::beginTransaction();
            $empresaUser                = Auth::user()->empresaUser();
            $publicacion                = new Publicacion();
            $publicacion->titulo        = $request->input('titulo');
            $publicacion->contacto      = $request->input('contacto');
            $publicacion->telefono      = $request->input('telefono');
            $publicacion->email         = $request->input('email');
            $publicacion->precio        = $request->input('precio');
            $publicacion->descripcion   = $request->input('descripcion_tab');
            $publicacion->clasificacion = $request->input('clasificacion');

            //Producto
            if ($request->input('clasificacion') == 0) {
                $publicacion->producto_id       = $request->input('producto_id');
                $publicacion->tipo_actividad_id = null;
            }

            //servicio
            if ($request->input('clasificacion') == 1) {
                $publicacion->producto_id       = null;
                $publicacion->tipo_actividad_id = $request->input('tipo_actividad_id');
            }

            $publicacion->otro = $request->input('otro');

            $publicacion->anno_fabricacion      = $request->input('anno_fabricacion');
            $publicacion->modelo                = $request->input('modelo');
            $publicacion->comuna_id             = $request->input('comuna_id');
            $publicacion->provincia_id          = $request->input('provincia_id');
            $publicacion->cantidad              = $request->input('cantidad');
            $publicacion->tipo_envio_id         = $request->input('tipo_envio_id');
            $publicacion->estado_publicacion_id = $request->input('estado_publicacion_id');

            $publicacion->empresa_id = $empresaUser->id;

            $publicacion->save();

            PublicacionImagen::where('identificador', $request->input('identificador'))->update(array('publicacion_id' => $publicacion->id));

            DB::commit();
            return redirect()->route('admin.publicaciones.index')->withFlashSuccess('Registro creado con éxito');
        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->route('admin.bodegas.index')->withFlashSuccess('Error Inesperado');
        }
    }

    public function edit(Request $request, Publicacion $publicacion)
    {

        $this->limpiar();
        $clasificacion  = array(0 => 'Producto', 1 => 'Servicio');
        $productos      = Producto::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $servicios      = TipoActividad::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $provincias     = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $tipoEnvios     = TipoEnvio::orderBy('descripcion', 'asc')->pluck('descripcion', 'id');
        $comunas        = Comuna::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $edoPublicacion = EstadoPublicacion::orderBy('descripcion', 'asc')->pluck('descripcion', 'id');
        $create         = 0;
        return view('backend.publicaciones.edit', compact('clasificacion', 'productos', 'servicios', 'provincias', 'tipoEnvios', 'publicacion', 'comunas', 'edoPublicacion', 'create'));

    }

    public function update(UpdatePublicacionRequest $request, Publicacion $publicacion)
    {
        try {
            DB::beginTransaction();
            $empresaUser                = Auth::user()->empresaUser();
            $publicacion->titulo        = $request->input('titulo');
            $publicacion->contacto      = $request->input('contacto');
            $publicacion->telefono      = $request->input('telefono');
            $publicacion->email         = $request->input('email');
            $publicacion->precio        = $request->input('precio');
            $publicacion->descripcion   = $request->input('descripcion_tab');
            $publicacion->clasificacion = $request->input('clasificacion');

            if ($request->input('clasificacion') == 0) {
                $publicacion->producto_id       = $request->input('producto_id');
                $publicacion->tipo_actividad_id = null;
            }

            if ($request->input('clasificacion') == 1) {
                $publicacion->producto_id       = null;
                $publicacion->tipo_actividad_id = $request->input('tipo_actividad_id');
            }

            $publicacion->otro = $request->input('otro');

            $publicacion->anno_fabricacion      = $request->input('anno_fabricacion');
            $publicacion->modelo                = $request->input('modelo');
            $publicacion->comuna_id             = $request->input('comuna_id');
            $publicacion->provincia_id          = $request->input('provincia_id');
            $publicacion->cantidad              = $request->input('cantidad');
            $publicacion->orden_minima          = $request->input('orden_minima');
            $publicacion->tipo_envio_id         = $request->input('tipo_envio_id');
            $publicacion->estado_publicacion_id = $request->input('estado_publicacion_id');

            $publicacion->empresa_id = $empresaUser->id;

            $publicacion->save();
            DB::commit();
            return redirect()->route('admin.publicaciones.index')->withFlashSuccess('Registro editado con éxito');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.publicaciones.index')->withFlashDanger('Error Inesperado');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Publicacion $publicacion)
    {
        try {
            DB::beginTransaction();

            //dd($publicacion->publicacion_imagen);
            $imagenes = $publicacion->publicacion_imagen;

            foreach ($imagenes as $imagen) {
                $destinationPath = public_path() . '/app/public/publicaciones/' . $imagen->file_name;
                if (File::exists($destinationPath)) //Check if file exists
                {
                    File::delete($destinationPath);
                }

                $imagen->delete();

            }

            $publicacion->delete();
            DB::commit();
            return redirect()->route('admin.publicaciones.index')->withFlashSuccess('Registro Eliminado Satisfactoriamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('admin.publicaciones.index')->withFlashSuccess('Error Inesperado');
        }

    }

    private function limpiar()
    {

        $imagenes = PublicacionImagen::where('user_id', auth()->user()->id)->where('publicacion_id', null)->get();

        foreach ($imagenes as $imagen) {
            $destinationPath = public_path() . '/app/public/publicaciones/' . $imagen->file_name;
            if (File::exists($destinationPath)) //Check if file exists
            {
                File::delete($destinationPath);
            }

            //Delete file from storage
            $imagen->delete();
        }

    }

    /**
     * [remove función para eliminar las imagenes subidas por medio del dropzoneJs]
     * @param  Request $request identificador,nombre de la imagen
     * @return [type]           [description]
     */
    public function remove(Request $request)
    {

        try {
            DB::beginTransaction();
            if ($request->ajax()) {

                $fileName      = $request->file_name;
                $identificador = $request->identificador;

                //busqueda por nombre original
                $imagen = PublicacionImagen::where('original_name', $fileName)->where('identificador', $identificador)->first();
                //busqueda por nombre encriptado
                $imagen2 = PublicacionImagen::where('file_name', $fileName)->where('identificador', $identificador)->first();

                if ($imagen != null) {
                    $file_name = $imagen->file_name;
                    $imagen->delete();
                }

                if ($imagen2 != null) {
                    $file_name = $imagen2->file_name;
                    $imagen2->delete();
                }

                $destinationPath = public_path() . '/app/public/publicaciones/' . $file_name;

                if (File::exists($destinationPath)) //Check if file exists
                {
                    File::delete($destinationPath);
                }
                //Delete file from storage

                DB::commit();
                return response('Error', 200); //return success
            }

        } catch (\Exception $e) {
            DB::rollback();

            dd($imagen2);
            return response('Error', 400); //return error

        }
    }

    public function getImages(Request $request)
    {
        $images = PublicacionImagen::where('publicacion_id', $request->input('publicacion_id'))->get();

        $imageAnswer = [];

        foreach ($images as $image) {

            $imageAnswer[] = [
                'file_name' => $image->file_name,
                'server'    => 'imagen',
                'size'      => File::size(public_path('app/public/publicaciones/' . $image->file_name)),

            ];
        }

        return response()->json([
            'images' => $imageAnswer,
        ]);
    }

    /**
     * [upload description]
     * @param  Request $request [identificador de la pantall, nombre de la imagen, concatenados previamente via ajax]
     * @return avoid
     */
    public function upload(Request $request)
    {
        try {
            DB::beginTransaction();

            //
            $file         = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $fileExt      = $file->getClientOriginalExtension();

            $fileName = Str::random(190) . '.' . $fileExt;
            $ruta     = public_path('/app/public/publicaciones/' . $fileName);

            Image::make($file->getRealPath())
                ->resize(600, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($ruta, 72);

            $imagen = new PublicacionImagen();
            if ($request->publicacion_id == null) {
                $imagen->publicacion_id = null;
            } else {
                $imagen->publicacion_id = $request->publicacion_id;

            }

            $imagen->file_name     = $fileName;
            $imagen->original_name = $originalName;
            $imagen->identificador = $request->input('drop_ident');
            $imagen->user_id       = auth()->user()->id;
            $imagen->save();
            DB::commit();
            return response('Imagen cargada con exito', 200); //return success
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return response('Error', 400); //return error

        }
    }

    public function show(Request $request, Publicacion $publicacion)
    {
        $this->limpiar();
        return view('backend.publicaciones.show', compact('publicacion'));
    }

}
