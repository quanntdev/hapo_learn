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
        $course = Course::find($request['course_id']);
        $course->users()->attach(auth()->user()->id, ['status' => config('course.onstatus')]);
        return redirect()->back()->with('join', __('success.course_enroll_success'));
    }

    public function update(StoreCourseUserRequest $request, $id)
    {
        $course = Course::find($request['course_id']);
        $course->users()->updateExistingPivot(auth()->user()->id, ['status' => config('course.end_course')]);
        return redirect()->back()->with('join', __('success.course_finish_success'));
    }
}
