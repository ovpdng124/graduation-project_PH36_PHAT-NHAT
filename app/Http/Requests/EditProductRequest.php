<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProductRequest extends FormRequest
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
            'name'        => ['required', Rule::unique('products')->ignore($this->product)],
            'price'       => 'numeric',
            'description' => 'required',
            'avatar'      => 'image|dimensions:min_width=300,min_height=300',
        ];
    }
}
