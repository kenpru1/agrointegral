<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use App\Models\Empresa;
use App\Models\EmpresaUser;
use App\Repositories\Frontend\Auth\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProfileController.
 */
class ProfileController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * ProfileController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(UpdateProfileRequest $request)
    {
        $output = $this->userRepository->update(
            $request->user()->id,
            $request->only('first_name', 'last_name', 'email', 'avatar_type', 'avatar_location', 'telefono', 'rut_dni', 'direccion', 'comuna_id', 'pais_id'),
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        // E-mail address was updated, user has to reconfirm
        if (is_array($output) && $output['email_changed']) {

            auth()->logout();

            return redirect()->route('frontend.auth.login')->withFlashInfo(__('strings.frontend.user.email_changed_notice'));
        }

        return redirect()->route('frontend.user.account')->withFlashSuccess(__('strings.frontend.user.profile_updated'));
    }

    public function updateEmpresa(Request $request)
    {

        if ($request->input('empresa_id') == 0) {
            $empresa = new Empresa();
        } else {
            $empresa = Empresa::find($request->input('empresa_id'));
        }

        $empresa->nombre            = $request->input('nombre');
        $empresa->rut_dni           = $request->input('rut_dni');
        $empresa->direccion         = $request->input('direccion');
        $empresa->comuna            = $request->input('comuna');
        $empresa->ciudad            = $request->input('ciudad');
        $empresa->pais_id           = $request->input('pais_id');
        $empresa->plan_id           = 1;
        $empresa->codigo_postal     = $request->input('codigo_postal');
        $empresa->email_facturacion = $request->input('email_facturacion');
        $empresa->save();

        if ($request->input('empresa_id') == 0) {
            $empresaUser             = new EmpresaUser();
            $empresaUser->empresa_id = $empresa->id;
            $empresaUser->user_id    = Auth::id();
            $empresaUser->save();
        }

        return redirect()->route('frontend.user.account')->withFlashSuccess(__('strings.frontend.user.profile_updated'));

    }

    public function updatePlan(Request $request)
    {

        if ($request->input('empresa_id') != null) {
            $empresa          = Empresa::find($request->input('empresa_id'));
            $empresa->plan_id = $request->input('plan_id');
            $empresa->save();

            return redirect()->route('frontend.user.account')->withFlashSuccess(__('strings.frontend.user.profile_updated'));
        } else {
            return redirect()->route('frontend.user.account')->withFlashSuccess('El Usuario no tiene empresa creada');
        }

    }
}
