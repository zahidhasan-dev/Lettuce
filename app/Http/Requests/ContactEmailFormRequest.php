<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactEmailFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {   
        return [
            'contact_email'=>'required|string|email|max:100|unique:contact_emails,contact_email',
        ];
    }


    public function messages()
    {
        return [
            'contact_email.unique'=>'The email has already been taken.',
        ];
    }
}
