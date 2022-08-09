<?php

namespace App\Services;

use App\Models\Lesson;

/**
 * Class UpdateFinishProgramsService.
 */
class UpdateService
{
    public static function updateFinishPrograms($valueProgramsFinish, $valueCountPrograms, $id)
    {
        if ($valueProgramsFinish == $valueCountPrograms) {
            $lesson = Lesson::find($id);
            $lesson->users()->updateExistingPivot(auth()->user()->id, ['status' => config('program.finish_lesson')]);
        }
    }
}
