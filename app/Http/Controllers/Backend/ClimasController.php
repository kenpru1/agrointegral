<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Campo;
use Illuminate\Support\Facades\Auth;
use Session;
class ClimasController extends Controller
{

    public function index()
    {

        $empresaUser = Auth::user()->empresaUser();

        if ($empresaUser != null) {
            //Si el usuario es administrador puede ver todos los bodegas
            if (auth()->user()->hasRole('administrator')) {

                $campos = Campo::orderBy('id', 'desc')->get();

            } else {

                $campos = Campo::where('empresa_id', $empresaUser->id)->get();

            }

            if(count($campos)==0){

                Session::flash('flash_danger', 'No posee cuarteles registrados para monitorear el clima '); 

            }

            return view('backend.climas.index', compact('campos'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }

    }

}
