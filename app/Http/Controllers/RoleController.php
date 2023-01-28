<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function assignRole(int $userId, int $roleId) : JsonResponse {
        $user = User::findOrFail($userId);
        $role = Role::findOrFail($roleId);
        $user->role()->associate($role);
        $user->save();
        return response()->json(['message' => 'Role assigned successfully.'], 200);
    }

    public function assignPermission(int $roleId, int $permissionId) : JsonResponse {
        $role = Role::findOrFail($roleId);
        $permission = Permission::findOrFail($permissionId);
        $role->permissions()->attach($permission);
        return response()->json(['message' => 'Permission assigned successfully.'], 200);
    }
}
