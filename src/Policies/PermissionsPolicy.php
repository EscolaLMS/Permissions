<?php

namespace EscolaLms\Permissions\Policies;

use EscolaLms\Core\Models\User;
use EscolaLms\Permissions\Enums\PermissionsPermissionsEnum;
use Illuminate\Auth\Access\HandlesAuthorization;
use EscolaLms\Permissions\Models\UserAdmin;

class PermissionsPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function administrate(UserAdmin $user): bool
    {
        return $user->can(PermissionsPermissionsEnum::PERMISSIONS_ROLE_MANAGE);
    }
}
