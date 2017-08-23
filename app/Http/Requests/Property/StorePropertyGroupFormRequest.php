<?php

namespace App\Http\Requests\Property;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyGroupFormRequest extends FormRequest
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
            'title' => 'required|min:2|max:255',
            'description' => 'required|min:3|max:255',
            'status' => 'required|boolean',
        ];
    }
}
