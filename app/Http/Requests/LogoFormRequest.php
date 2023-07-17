<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogoFormRequest extends FormRequest
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
            'logo_image' => 'required|image|mimes:png,jpg,jpeg|max:200|dimensions:min_width=16,min_height=16,max_width=1200,max_height=1200',
            'logo_type' => 'required|string|unique:logos,type,'.$this->input('logo_type').',type|in:light,dark,mobile,favicon',
        ];
    }


    public function messages()
    {
        return [
            'logo_image.required' => 'required.',
            'logo_image.mimes' => 'accepted file types: png,jpeg,jpg.',
            'logo_image.max' => 'max file size :max kilobytes.',
        ];
    }
}
