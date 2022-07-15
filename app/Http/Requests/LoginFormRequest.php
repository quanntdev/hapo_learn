<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
            'username' => 'required|min:5',
            'password' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => __('message.username_required'),
            'username.min' => __('message.username_min'),
            'password.required' => __('message.password_required'),
            'password.min' => __('message.password_min'),
        ];
    }
}
