<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'details' => 'required|max:255',
            'level' => 'required|boolean',
            'feature.*' => 'filled',
            'feature_value.*' => [
                'filled',
                Rule::in(['Text', 'Number', 'File']),
            ],
            'status' => 'required|boolean',
        ];
    }
}
