<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDetailsFormPost extends FormRequest
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
            'user_name'=>'required',
            'phone'=>'nullable|numeric|digits_between:4,16',
            'country'=>'exists:countries,id',
            'city'=>'required_unless:country,null|exists:cities,id',
        ];
    }

}
