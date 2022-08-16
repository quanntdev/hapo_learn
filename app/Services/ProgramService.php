<?php

namespace App\Services;

use App\Models\Lesson;
use App\Models\Program;
use App\Models\UserProgram;

/**
 * Class UpdateFinishProgramsService.
 */
class ProgramService
{
    public static function updateProgramsStatus($lesson)
    {
        $countFinishedPrograms = UserProgram::finishedPrograms($lesson->programs)->count();
        $countPrograms = $lesson->programs->where('status', config('course.onstatus'))->count();

        if ($countFinishedPrograms == $countPrograms) {
            $lesson = Lesson::find($lesson->id);
            $lesson->users()->updateExistingPivot(auth()->user()->id, ['status' => config('program.finish_lesson')]);
        } else {
            $lesson = Lesson::find($lesson->id);
            $lesson->users()->updateExistingPivot(auth()->user()->id, ['status' => config('course.onstatus')]);
        }
    }
}
