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
            'sub_price'    => 'numeric',
            'size'         => 'required|numeric',
            'color'        => 'required',
            'avatar'       => 'required|mimes:jpeg,png',
            'thumbnails.*' => 'required|mimes:jpeg,png',
        ];
    }
}
