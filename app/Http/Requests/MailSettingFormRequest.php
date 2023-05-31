<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailSettingFormRequest extends FormRequest
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
            'mail_transport'=>'required|string',
            'mail_host'=>'required|string',
            'mail_port'=>'required|integer',
            'mail_encryption'=>'required|string',
            'mail_username'=>'required|string',
            'mail_password'=>'required|string',
            'mail_from_address'=>'required|email',
            'mail_from_name'=>'required|string',
        ];
    }
}
