<?php

namespace EscolaLms\Permissions\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class RoleListingRequest extends FormRequest
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
        return [];
    }
}
