<?php

namespace App\Http\Requests\Admin\Docs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreManualChapterPost extends FormRequest
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
        $id = $this->route('manchapter') != null ? $this->route('manchapter') : null;

//        dd($this->request->all());
//        dd($id);

        return [
            'manual' => 'required|exists:manuals,id',
            'feature' => 'required_with:featurable',
            'title' => [
                'required',
                Rule::unique('manual_chapters')->ignore($id),
                'max:255',
            ],
            'url' => [
                'required',
                Rule::unique('manual_chapters')->ignore($id),
                'max:255',
            ],
            'body' => 'required',
            'status' => 'required|boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'feature.exists' => 'Sorry, the feature you selected doesn\'t exist',
            'feature.required_with' => 'A valid feature is required',
        ];
    }


}
