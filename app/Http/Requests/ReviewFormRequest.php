<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewFormRequest extends FormRequest
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
            'product_id'=>'required|numeric|exists:order_items,product_id',
            'user_name'=>'required|max:40',
            'user_email'=>'required|email',
            'review_rating'=>'required|numeric|digits_between:1,5',
            'review_feedback'=>'required|string|max:500',
        ];
    }
}
