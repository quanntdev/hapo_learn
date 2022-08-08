<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Program;
use App\Models\User;

class LessonController extends Controller
{
    public function show($slug)
    {
        $lesson = Lesson::with('users', 'course', 'programs')->where('slug_lesson', $slug)->firstOrFail();
        $otherCourses = Course::inRandomOrder()->take(config('course.other_course_on_detail'))->get();
        $tags = $lesson->course->tags;
        $countFinishedPrograms = Program::CountFinishedPrograms($lesson->programs);
        Lesson::UpdateFinishLesson($countFinishedPrograms, $lesson->programs->count(), $lesson->id);
        return view('lesson.show', compact('lesson', 'otherCourses', 'tags'));
    }
}
