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
        $courses = Course::showCourseHome(config('course.home_course_number'))->get();

        $coursesOther = Course::showCourseRandomHome(config('course.home_course_number_random'))->get();

        $Countlesson = Lesson::count();

        $CountCourse = Course::count();

        $countUserLearn = UserCourse::countUserLearn();

        $comments = Comment::getComment(config('course.home_comment_number'))->get();

        return view('home')->with(compact('courses', 'coursesOther', 'Countlesson', 'CountCourse', 'countUserLearn', 'comments'));
    }

    public function test()
    {
        return view('test');
    }
}
