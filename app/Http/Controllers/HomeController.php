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
        $courses = Course::ShowCourse(config('course.number_course_in_home_blade'), config('course.sort_from_high_to_low'))->get();

        $coursesOther = Course::ShowCourseRandom(config('course.number_course_in_home_blade_random'))->get();

        $Countlesson = Lesson::count();

        $CountCourse = Course::count();

        $countUserLearn = UserCourse::CountUserLearn();

        $comments = Comment::GetComment(config('course.number_comment_in_home_blade'))->get();

        return view('home')->with(compact('courses', 'coursesOther', 'Countlesson', 'CountCourse', 'countUserLearn', 'comments'));
    }

    public function test()
    {
        return view('test');
    }
}
