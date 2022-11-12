<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutFormRequest extends FormRequest
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
            'about_sub_title'=>'required|string|max:40',
            'about_title'=>'required|string|max:40',
            'about_desc_1'=>'required_without:about_desc_2|string|max:2000',
            'about_desc_2'=>'required_without:about_desc_1|string|max:2000',
            'about_author_name'=>'max:30',
            'about_author_title'=>'max:30',
            'about_image'=>'required|mimes:jpg,jpeg,png|max:512',
        ];
    }
}
