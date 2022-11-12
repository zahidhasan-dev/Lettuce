<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageFormRequest extends FormRequest
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
            'contact_name'=>'required|string|max:50',
            'contact_email'=>'required|string|email|max:100',
            'contact_message'=>'required|string|max:1500'
        ];
    }
}
