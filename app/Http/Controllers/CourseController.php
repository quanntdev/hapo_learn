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
        $keysearch = $request->search;
        $teachers = User::getTeacher();
        $tags = Tag::getTag();
        $courses = Course::getAllCourse();
        $requests = $request->all();
        if (!empty($request->submit)) {
            if (!empty($request->search)) {
                $courses = $courses->where('course_name', 'LIKE', "%{$request->search}%");
            }

            if (!empty($request->numberStudent)) {
                $courses = $courses->orderBy('users_count', $request->numberStudent);
            }

            if (!empty($request->timeCourse)) {
                $courses = $courses->orderBy('lessons_sum_time_lesson', $request->timeCourse);
            }

            if (!empty($request->lesson)) {
                $courses = $courses->orderBy('lessons_count', $request->lesson);
            }

            if (!empty($request->comment)) {
                $courses = $courses->orderBy('comments_count', $request->comment);
            }

            if (!empty($request->tags)) {
                $idCourse = CourseTag::where('tag_id', $request->tags)->pluck('course_id');
                $courses = $courses->whereIn('id', $idCourse);
            }

            if (!empty($request->teacher)) {
                $idCourse = CourseTeacher::where('user_id', $request->teacher)->pluck('course_id');
                $courses = $courses->whereIn('id', $idCourse);
            }

            if (!empty($request->lastest)) {
                $courses = $courses->orderBy('created_at', $request->lastest);
            }
        }

        $courses = $courses->paginate(config('all-course.number_paginate'))->appends(request()->query());

        Course::addLessonTime($courses);

        $countCourse = $courses->count();

        return view('layouts.all-course', compact('courses', 'teachers', 'tags', 'requests', 'keysearch', 'countCourse'));
    }

    public function search()
    {
        $key = $_GET['key'];
        $courses = Course::outputSearchData($key);
        return $courses;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($id)
    {
        //
    }

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
