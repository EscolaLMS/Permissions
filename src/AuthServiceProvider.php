<?php

namespace EscolaLms\Permissions;

use EscolaLms\Permissions\Models\UserAdmin;
use EscolaLms\Permissions\Policies\PermissionsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        UserAdmin::class => PermissionsPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
