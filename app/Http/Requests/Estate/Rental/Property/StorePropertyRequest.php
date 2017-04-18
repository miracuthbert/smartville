<?php

namespace App\Http\Requests\Estate\Rental\Property;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
            '_app' => 'required|integer|exists:company_apps,id',
            'title' => 'required|min:2|max:255',
            'summary' => 'required',
            'description' => 'nullable|min:3|max:2500',
            'type' => 'required|integer|exists:categories,id',
            'group' => 'nullable|integer|exists:estate_groups,id',
            'size' => 'required|numeric',
            'interval' => 'required|integer',
            'price' => 'required|numeric',
            '_rentable' => 'required|boolean',
            'amenity.*' => 'integer',
            'feature.*' => 'string',
            'details.*' => 'string',
            'value.*' => 'numeric',
            'status' => 'required|boolean',
        ];
    }
}
