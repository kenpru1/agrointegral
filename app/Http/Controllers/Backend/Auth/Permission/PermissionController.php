<?php

namespace App\Http\Controllers\Backend\Auth\Permission;

use App\Models\Auth\Permission;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Http\Requests\Backend\Auth\Permission\ManagePermissionRequest;
use App\Http\Requests\Backend\Auth\Permission\StorePermissionRequest;
use App\Http\Requests\Backend\Auth\Permission\UpdatePermissionRequest;

/**
 * Class PermissionController.
 */
class PermissionController extends Controller
{

   /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

   /**
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
    


    /**
     * @param ManagePermissionRequest $request
     *
     * @return mixed
     */
    public function index(ManagePermissionRequest $request)
    {
         return view('backend.auth.permission.index')
            ->withPermissions($this->permissionRepository
            ->with('permissions','roles')
            ->orderBy('id', 'asc')
            ->paginate(25));
        
    }

    /**
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */
    public function create(ManagePermissionRequest $request)
    {
        return view('backend.auth.permission.create')
            ->withPermissions($this->permissionRepository->get());
    }

    /**
     * @param StorePermissionRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(StorePermissionRequest $request)
    {
        $this->permissionRepository->create($request->only('name','guard_name'));

        return redirect()->route('admin.auth.permission.index')->withFlashSuccess(__('alerts.backend.permissions.created'));
    }

    /**
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     */
    public function edit(ManagePermissionRequest $request, Permission $permission)
    {
        
        return view('backend.auth.permission.edit')
            ->withPermission($permission);
            //->withPermissions();
    }

    /**
     * @param UpdatePermissionRequest $request
     * @param Permission              $Permission
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $this->permissionRepository->update($permission, $request->only('name', 'guard_name'));

        return redirect()->route('admin.auth.permission.index')->withFlashSuccess('Permiso Actualizado');
    }


      /**
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManagePermissionRequest $request, Permission $permission)
    {
        
        $this->permissionRepository->deleteById($permission->id);

       // event(new RoleDeleted($role));

        return redirect()->route('admin.auth.permission.index')->withFlashSuccess(__('alerts.backend.permissions.deleted'));
    }

    

   
}
