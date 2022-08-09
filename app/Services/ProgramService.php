<?php

namespace App\Services;

use App\Models\Lesson;
use App\Models\Program;

/**
 * Class UpdateFinishProgramsService.
 */
class ProgramService
{
    public static function updateFinishPrograms($lesson)
    {
        $countFinishedPrograms = Program::CountFinishedPrograms($lesson->programs);
        $countPrograms = $lesson->programs->count();

        if ($countFinishedPrograms == $countPrograms) {
            $lesson = Lesson::find($lesson->id);
            $lesson->users()->updateExistingPivot(auth()->user()->id, ['status' => config('program.finish_lesson')]);
        }
    }
}
