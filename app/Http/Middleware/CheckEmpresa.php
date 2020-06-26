<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckEmpresa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::user()) {
            $empresaUser = Auth::user()->empresaUser();

            if (isset($empresaUser->id)) {

                if ($empresaUser->activa == 1) {
                    return $next($request);
                } else {
                    return redirect()->route('admin.perfil_empresa')->withFlashDanger('La empresa se encuentra bloqueda, Favor consulte su soporte técnico');

                }

            } else {

                return redirect()->route('admin.perfil_empresa')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');

            }

        } else {
            return redirect()->route(home_route());
        }
    }
}
