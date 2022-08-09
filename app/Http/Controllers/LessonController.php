<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Program;
use App\Models\User;
use App\Services\UpdateFinishProgramsService;
use Dotenv\Parser\Value;

class LessonController extends Controller
{
    public static function _call($method , $value)
    {
        if (in_array($method, ['updateFinishPrograms'])) {
            return call_user_func_array([UpdateFinishProgramsService::class, $method], [$value]);
        }
    }

    public function show($slug)
    {
        $lesson = Lesson::with('users', 'course', 'programs')->where('slug_lesson', $slug)->firstOrFail();
        $otherCourses = Course::inRandomOrder()->take(config('course.other_course_on_detail'))->get();
        $tags = $lesson->course->tags;
        self::_call('updateFinishPrograms', $lesson);
        return view('lesson.show', compact('lesson', 'otherCourses', 'tags'));
    }
}
