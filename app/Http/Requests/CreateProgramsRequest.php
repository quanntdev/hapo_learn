<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProgramsRequest extends FormRequest
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
            'lesson_id' => 'required|integer',
            'program_name' => 'required',
            'file' => 'required',
            'type' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'lesson_id.required' => __('program.lesson_id_required'),
            'lesson_id.integer' => __('program.lesson_id_integer'),
            'program_name.required' => __('program.program_name_required'),
            'file.required' => __('program.file_required'),
            'type.required' => __('program.type_required'),
            'status.required' => __('program.status_required'),
        ];
    }
}
