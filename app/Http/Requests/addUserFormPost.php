<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addUserFormPost extends FormRequest
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
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|confirmed|min:8',
            'user_type'=>'required|boolean',
            'user_role'=>'nullable|exists:roles,id|integer|not_in:1',
            'user_permission'=>'nullable|exists:permissions,id',
        ];
    }

}
