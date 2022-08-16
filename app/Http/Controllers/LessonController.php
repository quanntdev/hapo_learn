<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Program;
use App\Models\User;
use App\Services\ProgramService;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use Illuminate\Support\Facades\Gate;

class LessonController extends Controller
{
    protected $programsService;

    public function __construct()
    {
        $this->programsService = new ProgramService();
    }

    public function show($slug)
    {
        $lesson = Lesson::with('users', 'course', 'programs')->where('slug_lesson', $slug)->firstOrFail();
        $otherCourses = Course::inRandomOrder()->take(config('course.other_course_on_detail'))->get();
        if(Gate::allows('view', auth()->user())) {
            $programs = $lesson->programs;
        } else {
            $programs = $lesson->programs->where('status', config('course.onstatus'));
        }
        $tags = $lesson->course->tags;
        $this->programsService->updateProgramsStatus($lesson);
        return view('lesson.show', compact('lesson', 'otherCourses', 'tags', 'programs'));
    }

    public function store(StoreLessonRequest $request)
    {
        if(Gate::allows('view', auth()->user())) {
            Lesson::create($request->all());
            return redirect()->back()->with('success_lesson', __('lesson.create_success'));
        }
    }

    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        if(Gate::allows('view', auth()->user())) {
            $lesson->update($request->all());
            return redirect()->back()->with('success_lesson', __('lesson.update_success'));
        }
    }

    public function destroy(Lesson $lesson)
    {
        if(Gate::allows('view', auth()->user())) {
            $lesson->delete();
            return redirect()->back()->with('success_lesson', __('lesson.delete_success'));
        }
    }
}
