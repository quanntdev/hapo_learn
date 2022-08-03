<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'star' => 'nullable',
            'parent_id' => 'nullable|integer',
        ];
    }

    public function messages()
    {
        return [
            'course_id.required' => __('course-detail.course_id'),
            'comment.required' => __('course-detail.comment'),
            'parent_id.required' => __('course-detail.parent_id'),
        ];
    }
}
