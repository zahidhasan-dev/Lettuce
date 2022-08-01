<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CustomerDetailsFormRequest extends FormRequest
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
            'customer_phone'=>'required|numeric|digits_between:4,16',
            'customer_country'=>'required|exists:countries,id',
            'customer_city'=>'required|exists:cities,id',
            'customer_address'=>'required|string|max:50',
        ];
    }



    protected function failedValidation(Validator $validator)
    {
        return $this->validator = $validator;
    }

    
}


