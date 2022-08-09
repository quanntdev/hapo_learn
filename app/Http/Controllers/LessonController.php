<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Program;
use App\Models\User;
use App\Services\UpdateFinishProgramsService;

class LessonController extends Controller
{
    protected $programsService;

    public function __construct()
    {
        $this->programsService = new UpdateFinishProgramsService();

    }

    public function show($slug)
    {
        $lesson = Lesson::with('users', 'course', 'programs')->where('slug_lesson', $slug)->firstOrFail();
        $otherCourses = Course::inRandomOrder()->take(config('course.other_course_on_detail'))->get();
        $tags = $lesson->course->tags;
        $this->programsService->updateFinishPrograms($lesson);
        return view('lesson.show', compact('lesson', 'otherCourses', 'tags'));
    }
}
