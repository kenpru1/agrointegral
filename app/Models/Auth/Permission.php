<?php

namespace App\Models\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Traits\Attribute\PermissionAttribute;

/**
 * Class Permission.
 */
class Permission extends \Spatie\Permission\Models\Permission
{
    use PermissionAttribute;

    protected $fillable = [
        'name',
        'guard_name',
        
    ];


}
