<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProductAttributeRequest extends FormRequest
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
            'sub_name' => ['required', Rule::unique('product_attributes')->ignore($this->product_attribute)],
            'sub_price' => 'required|numeric',
            'size' => 'required|numeric',
            'color' => 'required|numeric',
        ];
    }
}
