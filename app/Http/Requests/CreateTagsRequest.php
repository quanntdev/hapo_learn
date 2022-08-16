<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTagsRequest extends FormRequest
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
            'tag_name' => 'required|max:20',
            'slug_tag' => 'required|max:20|unique:tags',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tag_name.required' => __('tag.tag_name_required'),
            'tag_name.string' => __('tag.tag_name_string'),
            'tag_name.max' => __('tag.tag_name_max'),
            'slug_tag.required' => __('tag.slug_tag_required'),
            'slug_tag.string' => __('tag.slug_tag_string'),
            'slug_tag.max' => __('tag.slug_tag_max'),
            'slug_tag.unique' => __('tag.slug_tag_unique'),
            'status.required' => __('tag.status_required'),
        ];
    }
}
