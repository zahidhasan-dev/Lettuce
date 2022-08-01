<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class BannerFormRequest extends FormRequest
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
            'banner_type'=>'required|in:hero,campaign',
            'banner_title'=>'string|max:100|nullable',
            'banner_button_text'=>'string|max:20|nullable',
            'banner_category'=>'numeric|exists:categories,id',
            'banner_discount'=>'numeric|exists:discounts,id',
            'banner_slug'=>'required|unique:banners,banner_slug',
            'banner_image'=>'required|mimes:jpg,jpeg,png|max:512|dimensions:min_width=360,min_height=240,max_width=1920,max_height=1200',
            'banner_status'=>'boolean',
        ];
    }
}
