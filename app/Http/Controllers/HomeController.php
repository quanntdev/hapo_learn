<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Comment;
use App\Models\Lesson;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Course::orderBy('id', 'DESC')->take(3)->get();

        $coursesOther = Course::inRandomOrder()->take(3)->get();

        $user = User::all();

        $course = Course::all();

        $lesson = Lesson::all();

        $comments = Comment::with('user', 'course')->orderBy('id', 'desc')->get();

        return view('home')->with(compact('courses', 'coursesOther', 'comments', 'user', 'course', 'lesson'));
    }

    public function test()
    {
        return view('test');
    }
}
