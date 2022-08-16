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
use App\Http\Requests\CreateCourseRequest;
use App\Services\UpdateImageService;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $updateImage;

    public function __construct()
    {
        $this->updateImage = new UpdateImageService();
    }


    public function index(Request $request)
    {
        $data = $request->all();

        $teachers = User::teachers()->get();
        $tags = Tag::where('status', config('course.onstatus'))->get();

        $user = auth()->user();
        if (Gate::allows('view', $user)) {
            $courses = Course::filter($data)->get();
            return view('admin.course.index', compact('courses', 'teachers', 'tags'));
        } elseif (Gate::allows('teacher', $user)) {
            return view('teacher.index');
        } else {
            $courses = Course::filter($data)->where('status', config('course.onstatus'))->paginate(config('course.paginate'));
            return view('course.index', compact('courses', 'teachers', 'tags', 'data'));
        }
    }

    public function show($slug, Request $request)
    {
        $data = $request->all();

        $course = Course::with('users')->where('slug_course', $slug)->firstOrFail();
        if (Gate::allows('view', auth()->user())) {
            $lessons = $course->lessons()->search($data)->paginate(config('course.lesson_paginate'));
        } elseif (Gate::allows('teacher', auth()->user())) {
            return view('teacher.index');
        } else {
            $lessons = $course->lessons()->search($data)->where('status', config('course.onstatus'))->paginate(config('course.lesson_paginate'));
        }
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
        $teachers = User::teachers()->get();
        $tags = Tag::where('status', config('course.status'))->get();

        if(Gate::allows('view', auth()->user())) {
            return view ('admin.course.create' , compact('teachers', 'tags'));
        } elseif (Gate::allows('teacher', auth()->user())) {
            return view('teacher.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCourseRequest $request)
    {
        if(Gate::allows('view', auth()->user())) {
            $data = [
                'course_name' => $request->course_name,
                'description' => $request->description,
                'slug_course' => $request->slug_course,
                'image' => $this->updateImage->handleUploadImage($request->image, $request->teacher_id),
                'price' => $request->price,
                'status' => $request->status,
            ];
            $course = Course::create($data);

            foreach($request->tags as $tag) {
                Course::find($course->id)->tags()->attach($tag, ['status' => config('course.status') , 'created_at' => now(), 'updated_at' => now()]);
            }

            foreach($request->teachers as $teacher) {
                Course::find($course->id)->teachers()->attach($teacher, ['status' => config('course.status') , 'created_at' => now(), 'updated_at' => now()]);
            }
            return redirect()->back()->with('success', __('course.create_success'));
        } elseif (Gate::allows('teacher', auth()->user())) {
            return view('teacher.index');
        }
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
        if(Gate::allows('view', auth()->user())) {
            $course = Course::with('teachers', 'tags')->find($id);
            $teachers = User::teachers()->get();
            $tags = Tag::where('status', config('course.status'))->get();
            return view('admin.course.edit', compact('course', 'teachers', 'tags'));
        } elseif (Gate::allows('teacher', auth()->user())) {
            return view('teacher.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, $id)
    {
        if(Gate::allows('view', auth()->user())) {
            $data = $request->all();
            $course = Course::find($id);
            $course->update($data);
            $course->tags()->detach();
            $course->teachers()->detach();
            foreach($request->tags as $tag) {
                Course::find($course->id)->tags()->attach($tag, ['status' => config('course.status') , 'created_at' => now(), 'updated_at' => now()]);
            }
            foreach($request->teachers as $teacher) {
                Course::find($course->id)->teachers()->attach($teacher, ['status' => config('course.status') , 'created_at' => now(), 'updated_at' => now()]);
            }

            if (isset ($request->image)) {
                $course->update(['image' => $this->updateImage->handleUploadImage($request->image, $request->teacher_id)]);
            }

            return redirect()->back()->with('success', __('course.update_success'));
        } elseif (Gate::allows('teacher', auth()->user())) {
            return view('teacher.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::allows('view', auth()->user())) {
            $course = Course::find($id);
            $course->delete();
            return redirect()->back()->with('success', __('course.delete_success'));
        }
    }
}
