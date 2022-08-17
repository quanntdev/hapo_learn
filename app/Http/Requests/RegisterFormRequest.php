<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'username' => 'required|min:5|unique:users',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => __('register.username_required'),
            'username.min' => __('register.username_min'),
            'username.unique' => __('register.username_unique'),
            'password.required' => __('register.password_required'),
            'password.min' => __('register.password_min'),
            'password_confirmation.required' => __('register.password_confirmation_required'),
            'password_confirmation.same' => __('register.password_confirmation_same'),
            'email.required' => __('register.email_required'),
            'email.email' => __('register.email_email'),
            'email.unique' => __('register.email_unique'),
        ];
    }
}
