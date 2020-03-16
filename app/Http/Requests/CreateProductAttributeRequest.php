<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'sub_name'     => 'required|unique:product_attributes',
            'sub_price'    => 'required|numeric',
            'size'         => 'required|numeric',
            'thumbnails'   => 'required',
            'thumbnails.*' => 'image',
        ];
    }

    public function messages()
    {
        return [
          'thumbnails.*.image' => 'The thumbnails must be an image.'
        ];
    }
}
