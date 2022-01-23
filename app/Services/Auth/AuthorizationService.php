<?php

namespace App\Services\Auth;

use App\Helpers\EncryptionHelper;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthorizationService
{
    public static function hasPermissionTo($permission , User $user = null)
    {
        $user = $user ?? auth()->user();
        if(!$user->hasPermissionTo($permission)){
            abort(403);
        }
    }

    public static function syncAdminRoles()
    {
        if(!empty($sudo = developer())){
            $role = Role::firstOrCreate(["name" => "Sudo"]);
            $permissions = Permission::where("guard_name" , "web")->pluck("name")->toArray();
            $role->syncPermissions($permissions);
            $sudo->syncRoles([$role]);
        }
    }

    public static function hasRole(array $roles , User $user = null)
    {
        $user = $user ?? auth()->user();
        if(!$user->hasRole($roles)){
            abort(403);
        }
    }

    public static function checkForRoles(array $roles , User $user = null): bool
    {
        $user = $user ?? auth()->user();
        return $user->hasRole($roles);
    }
}
