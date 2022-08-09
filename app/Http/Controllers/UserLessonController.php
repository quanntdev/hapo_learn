<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserLessonRequest;
use App\Models\Lesson;

class UserLessonController extends Controller
{
    public function store(StoreUserLessonRequest $request)
    {
        $lesson = Lesson::find($request['lesson_id']);
        $lesson->users()->attach(auth()->user()->id, ['status' => config('course.onstatus')]);
        return redirect()->back();
    }
}
