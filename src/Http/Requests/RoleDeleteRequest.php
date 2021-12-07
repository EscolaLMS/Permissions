<?php

namespace EscolaLms\Permissions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleDeleteRequest extends FormRequest
{


    /**
     * @return bool
     */
    public function authorize()
    {
        /** @var User $user */
        $user = $this->user();
        return $user->can('administrate roles', 'api');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
