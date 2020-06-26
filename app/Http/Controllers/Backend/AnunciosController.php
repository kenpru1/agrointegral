<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Publicacion;
use App\Models\Comuna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnunciosController extends Controller
{
    public function index()
    {

        $empresaUser = Auth::user()->empresaUser();
        if ($empresaUser != null) {
            $publicaciones = Publicacion::where('estado_publicacion_id', 1)->orderBy('id', 'desc')->paginate(8);
            $comunas = Comuna::orderBy('nombre', 'asc')->pluck('nombre', 'id');

            return view('backend.anuncios.index', compact('publicaciones','comunas'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }
    }

    public function buscar(Request $request)
    {



        $comunas = Comuna::orderBy('nombre', 'asc')->pluck('nombre', 'id');
       
        $find = Publicacion::query();

        $nombre = $request->input('nombre');
        $precioMinimo = $request->input('precio_minimo');
        $precioMaximo = $request->input('precio_maximo');
        $comunaId = $request->input('comuna_id');

        $find->when($nombre!=null, function ($query) use ($nombre) {
            return $query->where('titulo','like', '%' .$nombre. '%');
        });

        $find->when($precioMinimo > 0, function ($query) use ($precioMinimo) {
            return $query->where('precio', '>=' ,$precioMinimo);
        });

        $find->when($precioMaximo > 0, function ($query) use ($precioMaximo) {
            return $query->where('precio', '<=' ,$precioMaximo);
        });

        $find->when($comunaId > 0, function ($query) use ($comunaId) {
            return $query->where('comuna_id',$comunaId);
        });



        $find->get();

        $publicaciones = $find->paginate(8);


        return view('backend.anuncios.index', compact('publicaciones','comunas','nombre','precioMinimo','precioMaximo','comunaId'));

    }
}
