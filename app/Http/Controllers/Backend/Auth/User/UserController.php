<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Events\Backend\Auth\User\UserDeleted;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Http\Requests\Backend\Auth\User\StoreUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserRequest;
use App\Models\Auth\User;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;
use DB;

/**
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $empresaUser = User::find(Auth::id())->empresas()->first();

        //dd(Auth::user()->roles->first()->id);

        if ($empresaUser != null) {


            if (auth()->user()->hasRole('administrator')) {
                return view('backend.auth.user.index')
                    ->withUsers($this->userRepository->getActivePaginated(100, 'id', 'desc'));

            }else{
                  $users = User::whereHas('empresas', function ($query) use ($empresaUser) {
                    $query->where('empresas.id','=',$empresaUser->id);
                    })->orderBy('id','desc')->get();

              
                return view('backend.auth.user.index', compact('users'));

            }
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }

    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('backend.auth.user.create',compact('empresas'))
            ->withRoles($roleRepository->with('permissions')->get(['id', 'name']))
            ->withPermissions($permissionRepository->get(['id', 'name']));
    }

    /**
     * @param StoreUserRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreUserRequest $request)
    {
        $empresaUser = User::find(Auth::id())->empresas()->first();
        
        $user=$this->userRepository->create($request->only(
            'first_name',
            'last_name',
            'email',
            'password',
            'active',
            'confirmed',
            'confirmation_email',
            'roles',
            'permissions'
        ));
        if (auth()->user()->hasRole('administrator')) {

        //inserción de la empresa por parte de usuario rol Administrator
        DB::table('empresa_user')->insert(['empresa_id' => $request->input('empresa_id'), 'user_id' => $user->id]);
       

       }
        if (auth()->user()->hasRole('executive')) {

        //inserción del usuario recien creada a la empresa donde pertenece el usuario logueado
        DB::table('empresa_user')->insert(['empresa_id' => $empresaUser->id, 'user_id' => $user->id]);
        //inserción del rol user para el usuario recien creado por un usuario de nivel executive
        DB::table('model_has_roles')->insert(['role_id' => 3,'model_type'=>'App\Models\Auth\User', 'model_id' => $user->id]);

       }


        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.created'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     */
    public function show(ManageUserRequest $request, User $user)
    {
        return view('backend.auth.user.show')
            ->withUser($user);
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository, User $user)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->pluck('nombre', 'id');

       
        return view('backend.auth.user.edit',compact('empresas'))
            ->withUser($user)
            ->withRoles($roleRepository->get())
            ->withUserRoles($user->roles->pluck('name')->all())
            ->withPermissions($permissionRepository->get(['id', 'name']))
            ->withUserPermissions($user->permissions->pluck('name')->all());
    }

    /**
     * @param UpdateUserRequest $request
     * @param User              $user
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userRepository->update($user, $request->only(
            'first_name',
            'last_name',
            'email',
            'roles',
            'permissions'
        ));

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.updated'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageUserRequest $request, User $user)
    {
        $this->userRepository->deleteById($user->id);

        event(new UserDeleted($user));

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('alerts.backend.users.deleted'));
    }
}
