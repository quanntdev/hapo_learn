<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\UserCourse;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Course::main()->get();
        $otherCourse = Course::other()->get();
        $totalLesson = Lesson::where('status', config('course.onstatus'))->count();
        $countCourse = Course::where('status', config('course.onstatus'))->count();
        $learners = UserCourse::learner();
        $comments = Comment::main()->get();

        if(Gate::allows('view', auth()->user())) {
            return view('admin.index')->with(compact('courses', 'otherCourse', 'totalLesson', 'countCourse', 'learners', 'comments'));
        } else {
            return view('home')->with(compact('courses', 'otherCourse', 'totalLesson', 'countCourse', 'learners', 'comments'));
        }
    }
}
