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
        $idCourse = Course::GetCourseId($slug);

        $data = $request->all();
        $lessons = Lesson::GetLesson($idCourse)->SearchLesson($data)->paginate(config('course.lesson_paginate'));

        $courses = Course::with('users')->find($idCourse);
        $tags = Tag::GetTagDetail($idCourse)->get();
        $teachers = User::GetTeacher($idCourse)->get();
        $comments = $courses->comments()->where('parent_id', '=', null)->orderBy('id', config('course.high_to_low'))->get();
        $replys = $courses->comments()->where('parent_id', '<>', null)->orderBy('id', config('course.high_to_low'))->get();
        $otherCourses = Course::OtherCourseDetail()->get();

        return view('course.show', compact('courses', 'tags', 'lessons', 'teachers', 'comments', 'replys', 'otherCourses', 'data'));
    }
}
