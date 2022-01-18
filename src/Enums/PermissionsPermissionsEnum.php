<?php

namespace EscolaLms\Permissions\Enums;

use EscolaLms\Core\Enums\BasicEnum;

class PermissionsPermissionsEnum extends BasicEnum
{
    const PERMISSIONS_ROLE_MANAGE = 'permissions_role_manage';
    const PERMISSIONS_ROLE_LIST = 'permissions_role_list';
    const PERMISSIONS_ROLE_READ = 'permissions_role_read';
    const PERMISSIONS_ROLE_CREATE = 'permissions_role_create';
    const PERMISSIONS_ROLE_UPDATE = 'permissions_role_update';
    const PERMISSIONS_ROLE_DELETE = 'permissions_role_delete';
}
