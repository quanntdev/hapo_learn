<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
            'name' => 'required|min:5',
            'date_of_birth' => 'required|date',
            'phone' => 'required|min:10',
            'address' => 'required',
            'about_me' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('login.name_required'),
            'name.min' => __('login.name_min'),
            'date_of_birth.required' => __('login.date_of_birth_required'),
            'phone.required' => __('login.phone_required'),
            'phone.min' => __('login.phone_min'),
            'address.required' => __('login.address_required'),
            'about_me.required' => __('login.about_me_required'),
            'avatar.image' => __('login.avatar_image'),
        ];
    }
}
