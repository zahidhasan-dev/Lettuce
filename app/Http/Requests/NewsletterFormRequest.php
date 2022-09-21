<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class NewsletterFormRequest extends FormRequest
{


    public $validator;



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
            'newsletter_code'=>'required|string',
            'newsletter_subject'=>'required|string|max:50'
        ];
    }


    public function messages()
    {
        return [
            'newsletter_code.required'=>'Newsletter code is required!',
            'newsletter_subject.required'=>'Newsletter subject is required!',
            'newsletter_subject.max'=>'Newsletter subject must be within 50 characters!',
        ];
    }



    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }

}
