<?php

namespace App\Repositories\Backend\Auth;

use App\Repositories\BaseRepository;
use App\Models\Auth\Permission;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\DB;
/**
 * Class PermissionRepository.
 */
class PermissionRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
     * @param array $data
     *
     * @return Role
     * @throws GeneralException
     */
    public function create(array $data) : Permission
    {
        // Make sure it doesn't already exist
        if ($this->permissionExists($data['name'])) {
            throw new GeneralException('El permiso ya existe '.$data['name']);
        }

       
        return DB::transaction(function () use ($data) {
            $permission = parent::create(['name' => strtolower($data['name']),'guard_name' => strtolower($data['guard_name'])]);

            if ($permission) {
                //event(new PermissionCreated($permission));

                return $permission;
            }

            throw new GeneralException(trans('exceptions.backend.access.permissions.create_error'));
        });
    }


    /**
     * @param Role  $role
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function update(Permission $permission, array $data)
    {
       
        // If the name is changing make sure it doesn't already exist
        if ($permission->name !== strtolower($data['name'])) {
            if ($this->permissionExists($data['name'])) {
                throw new GeneralException('El permiso ya existe '.$data['name']);
            }
        }

      
        return DB::transaction(function () use ($permission, $data) {
            if ($permission->update(['name' => strtolower($data['name']),
            	                     'guard_name' => strtolower($data['guard_name']),
            ])) {
               
                //event(new RoleUpdated($role));

                return $permission;
            }

            throw new GeneralException(trans('exceptions.backend.access.permissions.update_error'));
        });
    }




    /**
     * @param $name
     *
     * @return bool
     */
    protected function permissionExists($name) : bool
    {
        return $this->model
                ->where('name', strtolower($name))
                ->count() > 0;
    }
}
