<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutFormRequest extends FormRequest
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
            'billing_name'=>'required|string',
            'billing_email'=>'email',
            'billing_phone'=>'required|numeric|digits_between:4,16',
            'billing_country'=>'required|exists:countries,id',
            'billing_city'=>'required|exists:cities,id',
            'billing_zipcode'=>'required|numeric',
            'billing_address'=>'required|string',
            'payment_method'=>'required|string|in:card,cod',
        ];
    }
}
