<?php

namespace EscolaLms\Permissions\Http\Controllers;

use EscolaLms\Core\Http\Controllers\EscolaLmsBaseController;
use EscolaLms\Permissions\Http\Controllers\Contracts\PermissionsAdminApiContract;
use EscolaLms\Permissions\Http\Requests\RoleCreateRequest;
use EscolaLms\Permissions\Http\Requests\RoleDeleteRequest;
use EscolaLms\Permissions\Http\Requests\RoleListingRequest;
use EscolaLms\Permissions\Http\Requests\RoleReadRequest;
use EscolaLms\Permissions\Http\Requests\RoleUpdateRequest;
use EscolaLms\Permissions\Http\Resources\RoleResource;
use EscolaLms\Permissions\Http\Resources\PermissionResource;

use EscolaLms\Permissions\Services\Contracts\PermissionsServiceContract;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class PermissionsAdminApiController extends EscolaLmsBaseController implements PermissionsAdminApiContract
{
    private PermissionsServiceContract $service;

    public function __construct(PermissionsServiceContract $service)
    {
        $this->service = $service;
    }

    public function index(RoleListingRequest $request): JsonResponse
    {
        try {
            $roles = $this->service->listRoles();
            return $this->sendResponseForResource(RoleResource::collection($roles), "roles list retrieved successfully");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function show(RoleListingRequest $request, string $name): JsonResponse
    {
        try {
            $permissions = $this->service->rolePermissions($name);
            return $this->sendResponseForResource(PermissionResource::collection($permissions), "role permissions list retrieved successfully");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }


    public function create(RoleCreateRequest $request): JsonResponse
    {
        try {
            $role = $this->service->createRole($request->input('name'));
            return $this->sendResponseForResource(RoleResource::make($role), "role created successfully");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function delete(RoleDeleteRequest $request, string $name): JsonResponse
    {
        try {
            $deleted = $this->service->deleteRole($name);
            return $this->sendResponse($deleted, "role deleted successfully");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /*
    public function update(TemplateUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $input = $request->all();

            $updated = $this->templateService->update($id, $input);
            if (!$updated) {
                return $this->sendError(sprintf("template id '%s' doesn't exists", $id), 404);
            }
            return $this->sendResponseForResource(TemplateResource::make($updated), "template updated successfully");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
    */
}
