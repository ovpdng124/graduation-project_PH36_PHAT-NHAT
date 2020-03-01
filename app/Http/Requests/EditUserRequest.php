<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditUserRequest extends FormRequest
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
            'full_name'             => 'required',
            'email'                 => ['required', Rule::unique('users')->ignore($this->id), 'email'],
            'address'               => 'required',
            'phone_number'          => 'required|digits_between:10,11|numeric',
        ];
    }
}
