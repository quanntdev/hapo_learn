<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\StoreCourseUserRequest;
use App\Models\UserCourse;

class UserCourseController extends Controller
{
    public function store(StoreCourseUserRequest $request)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'course_id' => $request['course_id'],
            'status' => 1
        ];
        UserCourse::create($data);
        return redirect()->back();
    }

    public function update(StoreCourseUserRequest $request, $id)
    {
        $courseUser = UserCourse::where('user_id', auth()->user()->id)->where('course_id', $id)->first();
        $courseUser->status = config('course.end_course');
        $courseUser->save();
        return redirect()->back();
    }
}
