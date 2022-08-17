<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => __('register.old_password_required'),
            'password.required' => __('register.password_required'),
            'password.min' => __('register.password_min'),
            'password_confirmation.required' => __('register.password_confirmation_required'),
            'password_confirmation.same' => __('register.password_confirmation_same'),
        ];
    }
}
