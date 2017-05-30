<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->root or $this->user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('role') != null ? $this->route('role') : null;
        return [
            'role' => 'required|string|max:100',
            'alias' => [
                'string',
                'max:30',
                Rule::unique('roles', 'alias')->ignore($id),
            ],
            'description' => 'required|string|max:255',
            'tables' => 'required',
            'status' => 'required|boolean',
        ];
    }
}
