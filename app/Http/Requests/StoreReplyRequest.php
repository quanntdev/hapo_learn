<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReplyRequest extends FormRequest
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
            'course_id' => 'required|integer',
            'comment' => 'required|string',
            'parent_id' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'course_id' => __('course-detail.course_id'),
            'comment' => __('course-detail.comment'),
            'parent_id' => __('course-detail.parent_id'),
        ];
    }
}