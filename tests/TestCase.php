<?php

namespace EscolaLms\Permissions\Tests;

use EscolaLms\Core\Models\User;
use EscolaLms\Permissions\AuthServiceProvider;
use EscolaLms\Permissions\Database\Seeders\PermissionTableSeeder;
use EscolaLms\Permissions\EscolaLmsPermissionsServiceProvider;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\PassportServiceProvider;
use Spatie\Permission\PermissionServiceProvider;
use EscolaLms\Templates\Services\Contracts\VariablesServiceContract;
use EscolaLms\Templates\Services\VariablesService;
use EscolaLms\Templates\Tests\Enum\Email\CertificateVar as EmailCertificateVar;
use EscolaLms\Templates\Tests\Enum\Pdf\CertificateVar as PdfCertificateVar;


class TestCase extends \EscolaLms\Core\Tests\TestCase
{
    use DatabaseTransactions;

    public $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(PermissionTableSeeder::class);
    }

    protected function getPackageProviders($app): array
    {
        return [
            ...parent::getPackageProviders($app),
            EscolaLmsPermissionsServiceProvider::class,
            PassportServiceProvider::class,
            PermissionServiceProvider::class,
            AuthServiceProvider::class
        ];
    }



    protected function authenticateAsAdmin()
    {
        $this->user = config('auth.providers.users.model')::factory()->create();
        $this->user->guard_name = 'api';
        $this->user->assignRole('admin');
    }

    protected function findPermissionByName($responseData, $name)
    {
        $needle = array_filter($responseData->data, fn ($role) => $role->name === $name);
        if (count($needle) >= 1) {
            return array_pop($needle);
        }
        return false;
    }
}
