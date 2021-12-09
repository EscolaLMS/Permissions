<?php

namespace EscolaLms\Permissions\Services;

use EscolaLms\Permissions\Services\Contracts\PermissionsServiceContract;
use Exception;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use EscolaLms\Permissions\Exceptions\AdminRoleException;

class PermissionsService implements PermissionsServiceContract
{

    public function listRoles(): Collection
    {
        return Role::all();
    }

    public function rolePermissions(string $name): Collection
    {
        $role = Role::where(['name' => $name, 'guard_name' => 'api'])->firstOrFail();
        $rolePermissions = $role->permissions->pluck('name');
        $permission = Permission::where('guard_name', 'api')->get();
        return $permission->map(function ($item) use ($rolePermissions) {
            $item->assigned = $rolePermissions->contains($item->name);
            return $item;
        });
        return $permission;
    }

    public function createRole(string $name): Model
    {
        $role = Role::findOrCreate(Str::slug($name), 'api');
        return $role;
    }

    public function deleteRole(string $name): bool
    {
        if ($name === 'admin') {
            throw new AdminRoleException("Admin role cannot be deleted");
        }
        $role = Role::where(['name' => $name, 'guard_name' => 'api'])->firstOrFail();
        return $role->delete();
    }

    public function updateRolePermissions(string $name, array $permissions): Collection
    {
        if ($name === 'admin') {
            throw new AdminRoleException("Admin role cannot be updated");
        }
        $role = $this->createRole($name);
        $role->syncPermissions($permissions);
        return $this->rolePermissions($name);
    }
}
