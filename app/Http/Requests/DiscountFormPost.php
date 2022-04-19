<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountFormPost extends FormRequest
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

        if(request()->discount_type == ''){
            $condition = "required|numeric";
        }

        if(request()->discount_type === 'fixed'){
            $condition = "required|numeric|between:1,1000";
        }
        
        if(request()->discount_type === 'percent'){
            $condition = "required|numeric|between:1,100";
        }


        return [
            'discount_name'=>'required|unique:discounts|max:30',
            'discount_slug'=>'required|max:100',
            'discount_value'=>$condition,
            'discount_type'=>'required|in:fixed,percent',
            'discount_validity'=>'required',
        ];
    }
}
