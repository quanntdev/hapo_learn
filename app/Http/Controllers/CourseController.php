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

    public function show($slug, Request $request)
    {
        $data = $request->all();

        $course = Course::with('users')->where('slug_course', $slug)->firstOrFail();
        $lessons = $course->lessons()->search($data)->paginate(config('course.lesson_paginate'));
        $tags = $course->tags;
        $teachers = $course->teachers;
        $comments = $course->comments()->orderComments()->get();
        $replys = $course->comments()->orderReplies()->get();
        $otherCourses = $course->inRandomOrder()->take(config('course.other_course_on_detail'))->get();

        return view('course.show', compact('course', 'tags', 'lessons', 'teachers', 'comments', 'replys', 'otherCourses', 'data'));
    }
}
