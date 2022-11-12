<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeatureFormRequest extends FormRequest
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
            'feature_title'=>'required|string|max:30',
            'feature_desc'=>'required|string|max:150',
            'feature_image'=>'required|mimes:jpg,jpeg,png|max:256',
        ];
    }
}
