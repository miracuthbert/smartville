<?php

namespace App\Http\Requests\Estate\Rental\Property;

use Illuminate\Foundation\Http\FormRequest;

class StorePhotoRequest extends FormRequest
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
        if ($this->method() == "PUT") {
            return [
                'gallery' => 'required|exists:galleries,id',
                'caption' => 'required|min:2|max:160',
                'description' => 'min:50|max:255',
                'audience' => 'required|integer',
                'status' => 'required|boolean',
            ];
        } else {
            return [
                'gallery' => 'required|exists:galleries,id',
                'caption' => 'required|min:2|max:160',
                'description' => 'min:50|max:255',
                'photo' => 'required|image|mimes:jpeg,jpg,png|dimensions:min_width=800,min_height=600',
                'audience' => 'required|integer',
                'status' => 'required|boolean',
            ];
        }
    }
}
