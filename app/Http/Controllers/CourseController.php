<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Program;
use App\Models\User;
use App\Models\UserCourse;
use App\Models\UserLesson;
use App\Models\UserProgram;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Support\Facades\Gate;

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

        $user = auth()->user();
        if(Gate::allows('view', $user)) {
            return view('admin.course.index', compact('courses', 'teachers', 'tags'));
        } else {
            return view('course.index', compact('courses', 'teachers', 'tags', 'data'));
        }
    }

    public function show($slug, Request $request)
    {
        $data = $request->all();

        $course = Course::with('users')->where('slug_course', $slug)->firstOrFail();
        $lessons = $course->lessons()->search($data)->paginate(config('course.lesson_paginate'));
        $tags = $course->tags;
        $teachers = $course->teachers;
        $comments = $course->comments()->comments()->get();
        $replys = $course->comments()->replies()->get();
        $otherCourses = $course->inRandomOrder()->take(config('course.other_course_on_detail'))->get();

        return view('course.show', compact('course', 'tags', 'lessons', 'teachers', 'comments', 'replys', 'otherCourses', 'data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.course.create');
        if(Gate::allows('view', auth()->user())) {
            return view ('admin.course.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
