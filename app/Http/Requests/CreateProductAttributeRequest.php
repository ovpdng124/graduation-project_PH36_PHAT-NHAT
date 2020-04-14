<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductAttributeRequest extends FormRequest
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
            'product_id'   => 'required',
            'sub_name'     => 'required|unique:product_attributes',
            'sub_price'    => 'required|numeric',
            'size'         => 'required|numeric',
            'color'        => ['required', Rule::unique('product_attributes')->where('product_id', $this->product_id)->ignore($this->product_attribute)],
            'thumbnails'   => 'required',
            'thumbnails.*' => 'image|dimensions:min_width=300,min_height=300',
        ];
    }

    public function messages()
    {
        return [
            'thumbnails.*.image'      => 'Thumbnails must be an image.',
            'thumbnails.*.dimensions' => 'Thumbnails has invalid image dimensions.',
        ];
    }
}
