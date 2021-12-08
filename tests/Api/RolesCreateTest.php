<?php

namespace EscolaLms\Permissions\Tests\Api;

use EscolaLms\Permissions\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;

class RolesCreateTest extends TestCase
{
    use DatabaseTransactions;



    public function testAdminCanCreateRole()
    {
        $this->authenticateAsAdmin();
        $name = "lkdfsj lfds lkjfsd lkjsl87923 dfs";
        $response = $this->actingAs($this->user, 'api')->postJson(
            '/api/admin/roles',
            [
                'name' => $name
            ]
        );

        $response->assertStatus(200);

        $this->assertEquals($response->getData()->data->name, Str::slug($name));
    }

    public function testTutorCantCreateRole()
    {
        $user = config('auth.providers.users.model')::factory()->create();
        $user->guard_name = 'api';
        $user->assignRole('tutor');

        $name = "lkdfsj lfds lkjfsd lkjsl87923 dfs";
        $response = $this->actingAs($user, 'api')->postJson(
            '/api/admin/roles',
            [
                'name' => $name
            ]
        );



        $response->assertStatus(403);
    }


    public function testAdminCannotCreateRoleWithoutName()
    {
        $this->authenticateAsAdmin();

        $response = $this->actingAs($this->user, 'api')->postJson(
            '/api/admin/roles',
            []
        );
        $response->assertStatus(422);
    }

    public function testGuestCannotCreateRole()
    {
        $response = $this->postJson(
            '/api/admin/roles',
            [
                'name' => 'name'
            ]
        );
        $response->assertUnauthorized();
    }
}
