<?php

namespace EscolaLms\Permissions\Tests\Api;

use EscolaLms\Permissions\Models\Template;
use EscolaLms\Permissions\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesListTest extends TestCase
{
    use DatabaseTransactions;

    public function testAdminCanList()
    {
        $this->authenticateAsAdmin();

        $name = 'lorem-ipsum-test';
        $role = Role::findOrCreate($name, 'api');

        $response = $this->actingAs($this->user, 'api')->getJson('/api/admin/roles');

        $response->assertJsonStructure([
            'success',
            'data',
            'message'
        ]);

        $response->assertOk();

        $neededObject = array_filter(
            $response->getData()->data,
            function ($role) use (&$name) {
                return $role->name == $name;
            }
        );

        $this->assertTrue(isset($neededObject));
    }

    public function testGuestCannotListRole()
    {
        $response = $this->getJson('/api/admin/roles');
        $response->assertUnauthorized();
    }
}
