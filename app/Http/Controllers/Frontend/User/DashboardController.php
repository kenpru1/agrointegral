<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Comuna;
use App\Models\Paises;
use App\Models\EmpresaUser;
use App\Models\Auth\User;
use App\Models\Planes;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    /*public function index()
    {
        return view('frontend.user.dashboard');
    }*/


    public function index()
    {
        $paises   = Paises::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $comunas  = Comuna::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $planes  = Planes::orderBy('id', 'asc')->get();
        $selected = Paises::where('nombre', 'chile')->first();

        $empresaUser=User::find(Auth::id())->empresas()->first();


        return view('frontend.user.account', compact('paises', 'comunas', 'selected','empresaUser','planes'));
    }
}
