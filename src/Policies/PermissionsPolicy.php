<?php

namespace EscolaLms\Permissions\Policies;

use EscolaLms\Core\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use EscolaLms\Permissions\Models\UserAdmin;

class PermissionsPolicy
{
    use HandlesAuthorization;


    /**
     * @param User $user
     * @return bool
     */
    public function administrate(UserAdmin $user)
    {
        return $user->can('administrate roles');
    }
}
