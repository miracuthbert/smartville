<?php

namespace App\Http\Requests\Estate\Rental\Property;

use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryRequest extends FormRequest
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
            'property' => 'required|exists:estate_properties,id',
            'name' => 'required|min:2|max:255',
            'description' => 'min:50|max:255',
            'cover' => 'image|mimes:jpeg,jpg,png|dimensions:min_width=800,min_height=600',
            'audience' => 'required|integer',
            'status' => 'required|boolean',
        ];
    }
}
