<?php

namespace App\Http\Requests\Admin\App;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAppRequest extends FormRequest
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
            'title' => [
                'required',
                'min:3', 'max:255',
                Rule::unique('products', 'title')->ignore($this->request->get('id')),
            ],
            'slug' => [
                'required',
                'min:3', 'max:255',
                Rule::unique('products', 'slug')->ignore($this->request->get('id')),
            ],
            'summary' => 'required|min:50',
            'description' => 'required',
            'category' => 'required|integer',
            'payment_model' => 'required|integer',
            'app' => 'required|boolean',
            'version_no' => 'numeric',
            'mode' => 'required|boolean',
            'coming_soon' => 'required|boolean',
            'status' => 'required|boolean',
        ];
    }
}
