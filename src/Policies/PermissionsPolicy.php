<?php

namespace EscolaLms\Permissions\Policies;

use EscolaLms\Core\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionsPolicy
{
    use HandlesAuthorization;


    /**
     * @param User $user
     * @return bool
     */
    public function administrate(User $user)
    {
        return $user->can('administrate roles');
    }
}
