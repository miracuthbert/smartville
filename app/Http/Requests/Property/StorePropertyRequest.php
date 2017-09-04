<?php

namespace App\Http\Requests\Property;

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
            'title' => 'required|min:2|max:255',
            'summary' => 'required',
            'description' => 'nullable|min:3|max:2500',
            'type' => 'required|exists:categories,id',
            'group' => 'nullable|exists:estate_groups,id',
            'size' => 'required|numeric',
            'interval' => 'required|integer',
            'price' => 'required|numeric',
            '_rentable' => 'required|boolean',
            'amenity.*' => 'nullable|exists:amenities,id',
            'feature.*' => 'string',
            'details.*' => 'string',
            'value.*' => 'numeric',
            'status' => 'required|boolean',
        ];
    }
}
