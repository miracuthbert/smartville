<?php

namespace App\Http\Requests\Rental\Bill;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillServiceFormRequest extends FormRequest
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
            'bill_name' => 'required|min:2|max:255',
            'bill_summary' => 'required|min:3|max:255',
            'bill_details' => 'max:1500',
            'billing_interval' => 'required|integer|min:1',
            'bill_interval_type' => 'required',
            'billing_amount' => 'required|numeric',
            'billing_properties' => 'required|boolean',
            'billing_plan' => 'required|boolean',
            'billing_reminder' => 'required|integer|min:1|max:31',
            'status' => 'required|boolean',
        ];
    }
}
