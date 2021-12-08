<?php

namespace EscolaLms\Permissions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class RoleUpdateRequest extends FormRequest
{


    /**
     * @return bool
     */
    public function authorize()
    {
        return Gate::check('administrate roles');
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'permissions' => ['present', 'array'],
            'permissions.*' => ['string']
        ];
    }
}
