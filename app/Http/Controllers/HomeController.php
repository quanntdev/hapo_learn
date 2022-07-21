<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\UserCourse;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Course::ShowCourseAtHomeBlade()->get();
        $coursesOther = Course::ShowCourseRandomAtHomeBlade()->get();
        $countlesson = Lesson::count();
        $countCourse = Course::count();
        $countUserLearn = UserCourse::CountUserHaveLearn();
        $comments = Comment::getComment()->get();

        return view('home')->with(compact('courses', 'coursesOther', 'countlesson', 'countCourse', 'countUserLearn', 'comments'));
    }

    public function test()
    {
        return view('test');
    }
}
