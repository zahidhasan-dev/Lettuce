<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CustomerAccountFormRequest extends FormRequest
{

    public $validator = null;
    

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
            'customer_name'=>'required|string|max:50',
            'customer_email'=>'required|email|unique:users,email,'.auth()->user()->id.'id',
            'current_password'=>'nullable|current_password',
            'password'=>'nullable|confirmed|required_with:current_password|min:8',
            'password_confirmation'=>'nullable|required_with:password',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        return $this->validator = $validator;
    }


}
