<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\CourseTag;
use App\Models\CourseTeacher;
use App\Models\Tag;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $courses = Course::filter($data)->paginate(config('course.paginate'));

        $teachers = User::teachers()->get();
        $tags = Tag::all();

        return view('course.index', compact('courses', 'teachers', 'tags', 'data'));
    }
}
