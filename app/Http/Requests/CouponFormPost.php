<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponFormPost extends FormRequest
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
        
        if(request()->coupon_type == ''){
            $condition = "required";
        }

        if(request()->coupon_type === 'fixed'){
            $condition = "required|numeric|between:1,1000";
        }

        if(request()->coupon_type === 'percent'){
            $condition = "required|numeric|between:1,100";
        }



        return [
            'coupon_code'=>'required|unique:coupons|max:20',
            'coupon_value'=>$condition,
            'coupon_type'=>'required|in:fixed,percent',
            'coupon_validity'=>'required',
        ];
    }
}
