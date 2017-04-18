<?php

namespace App\Http\Requests\Admin\Docs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreManualPageRequest extends FormRequest
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
        $id = $this->route('manpage') != null ? $this->route('manpage') : null;

        return [
            'chapter' => 'required|exists:manual_chapters,id',
            'title' => [
                'required',
                Rule::unique('manual_pages')->ignore($id),
                'max:255',
            ],
            'url' => [
                'required',
                Rule::unique('manual_pages')->ignore($id),
                'max:255',
            ],
            'body' => 'required',
            'status' => 'required|boolean',
        ];
    }
}
