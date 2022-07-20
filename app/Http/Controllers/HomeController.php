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
        $courses = Course::showCourse(3, 'desc')->get();

        $coursesOther = Course::showCourseRandom(3)->get();

        $Countlesson = Lesson::count();

        $CountCourse = Course::count();

        $countUserLearn = UserCourse::countUserLearn();

        $comments = Comment::getComment(10);

        return view('home')->with(compact('courses', 'coursesOther', 'Countlesson', 'CountCourse', 'countUserLearn', 'comments'));
    }

    public function test()
    {
        return view('test');
    }
}
