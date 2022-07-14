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
            'username.required' => trans('message.UsernameRequired'),
            'username.min' => trans('message.UsernameMin'),
            'password.required' => trans('message.PasswordRequired'),
            'password.min' => trans('message.PasswordMin'),
        ];
    }
}
