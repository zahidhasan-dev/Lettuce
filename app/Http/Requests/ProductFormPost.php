<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ProductFormPost extends FormRequest
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
            'product_category'=>'required|numeric',
            'product_name'=>'required',
            'price'=>'required|numeric',
            'stock'=>'required|numeric',
            'product_scale'=>'required|numeric',
            'size_value'=>'required|numeric',
            'product_thumbnail'=>'required|image',
            'product_desc'=>'max:2000',
        ];
    }


    protected function failedValidation(Validator $validator){
        return $this->validator = $validator;
    }
}
