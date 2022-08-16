<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
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
            'name_lesson' => 'required',
            'slug_lesson' => 'required|unique:lessons,slug_lesson',
            'content' => 'required',
            'requirement' => 'required',
            'time_lesson' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'course_id.required' => __('lesson.course_id_required'),
            'course_id.integer' => __('lesson.course_id_integer'),
            'name_lesson.required' => __('lesson.name_lesson_required'),
            'slug_lesson.required' => __('lesson.slug_lesson_required'),
            'slug_lesson.unique' => __('lesson.slug_lesson_unique'),
            'content.required' => __('lesson.content_required'),
            'requirement.required' => __('lesson.requirements_required'),
            'time_lesson.required' => __('lesson.time_lesson_required'),
            'status.required' => __('lesson.status_required'),
        ];
    }
}
