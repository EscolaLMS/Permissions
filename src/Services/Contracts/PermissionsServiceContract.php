<?php

namespace EscolaLms\Permissions\Services\Contracts;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @package EscolaLms\Permissions\Http\Services\Contracts
 */
interface PermissionsServiceContract
{
    public function listRoles(): Collection;

    public function createRole(string $name): Model;

    public function deleteRole(string $name): bool;

    public function rolePermissions(string $name): Collection;

    public function updateRolePermissions(string $name, array $permissions): Collection;
}
