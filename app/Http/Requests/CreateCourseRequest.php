<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
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
            'course_name' => 'required|max:255',
            'slug_course' => 'required|max:255|unique:courses,slug_course',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
            'status' => 'required',
            'teachers' => 'required',
            'tags' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'course_name.required' => __('course.course_name_required'),
            'slug_course.required' => __('course.slug_course_required'),
            'slug_course.unique' => __('course.slug_course_unique'),
            'description.required' => __('course.description_required'),
            'image.required' => __('course.avatar_required'),
            'image.image' => __('course.avatar_image'),
            'image.mimes' => __('course.avatar_mimes'),
            'image.max' => __('course.avatar_max'),
            'price.required' => __('course.price_required'),
            'price.numeric' => __('course.price_numeric'),
            'status.required' => __('course.status_required'),
            'teachers.required' => __('course.teachers_required'),
            'tags.required' => __('course.tags_required'),
        ];
    }
}
