<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassFormPost extends FormRequest
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
            'old_password'=>'required|current_password',
            'password'=>'required|min:8|confirmed',
            'password_confirmation'=>'required'
        ];
    }


    public function messages()
    {
        return [
            'old_password.required'=>'Old password is required!',
            'old_password.current_password'=>'Incorrect password!',
            'password.required'=>'New password is required!',
            'password.min'=>'Password must be at least 8 characters!',
            'password_confirmation.required'=>'Password Confirmation is required!',
        ];
    }
}
