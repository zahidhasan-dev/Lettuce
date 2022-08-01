<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateFormRequest extends FormRequest
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
            'product_category'=>'required|numeric',
            'product_name'=>'required',
            'price'=>'required|numeric',
            'stock'=>'required|numeric',
            'product_scale'=>'required|numeric',
            'size_value'=>'required|numeric',
            'product_has_discount'=>'boolean',
            'product_discount'=>'required_if:product_has_discount,1|numeric',
            'product_featured'=>'boolean',
            'product_status'=>'boolean',
            'product_thumbnail'=>'mimes:jpeg,png|max:512|dimensions:min_width=600,min_height=600,max_width=1000,max_height=1000',
            'product_desc'=>'max:2000',
            'product_multiple_photo'=>'array',
            'product_multiple_photo.*'=>'mimes:jpeg,png|max:512|dimensions:min_width=600,min_height=600,max_width=1000,max_height=1000',
        ];
    }


    public function messages()
    {
        return [
            'product_discount.required_if'=>'The product discount field is required when product has discount.',
            'product_multiple_photo.*.mimes'=>'Invalid image type.',
            'product_multiple_photo.*.max'=>'Image must be within 512 kilobytes.',
            'product_multiple_photo.*.dimensions'=>'Invalid image dimensions.',
        ];
    }
}
