<?php

namespace EscolaLms\Permissions\Services\Contracts;

use Illuminate\Support\Collection;
use Spatie\Permission\Contracts\Role;

/**
 * @package EscolaLms\Permissions\Http\Services\Contracts
 */
interface PermissionsServiceContract
{
    public function listRoles(): Collection;

    public function createRole(string $name): Role;

    public function deleteRole(string $name): bool;

    public function rolePermissions(string $name): Collection;

    public function updateRolePermissions(string $name, array $permissions): Collection;
}
