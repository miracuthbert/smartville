<?php

namespace App\Http\Requests\Admin\Docs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreManualRequest extends FormRequest
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
        $id = $this->route('manual') != null ? $this->route('manual') : null;
        if($this->input('stand_alone') == 0) {
            return [
                'app' => 'required|exists:products,id',
                'title' => [
                    'required',
                    Rule::unique('manuals')->ignore($id),
                    'max:255',
                ],
                'url' => [
                    'required',
                    Rule::unique('manuals')->ignore($id),
                    'max:255',
                ],
                'body' => 'required',
                'status' => 'required|boolean',
            ];
        } else {
            return [
                'title' => [
                    'required',
                    Rule::unique('manuals')->ignore($id),
                    'max:255',
                ],
                'url' => [
                    'required',
                    Rule::unique('manuals')->ignore($id),
                    'max:255',
                ],
                'body' => 'required',
                'status' => 'required|boolean',
            ];
        }

    }
}
