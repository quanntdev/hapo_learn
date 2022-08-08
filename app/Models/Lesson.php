<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'name_lesson',
        'slug_lesson',
        'video',
        'content',
        'time_lesson',
        'time_up',
        'status',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_lesson', 'lesson_id', 'user_id');
    }

    public function programs()
    {
        return $this->hasMany(Program::class, 'lesson_id');
    }

    public function scopeSearch($query, $data)
    {
        if (!empty($data['search'])) {
            $query->where('name_lesson', 'LIKE', "%{$data['search']}%")
                ->orWhere('content', 'LIKE', "%{$data['search']}%");
        }

        return $query;
    }

    public function getIsJoinedLessonAttribute()
    {
        return $this->users()->whereExists(function ($query) {
            $query->where('user_id', auth()->id());
        })->exists();
    }

    public function getIsFinishLessonAttribute()
    {
        return $this->users()->whereExists(function ($query) {
            $query->where('user_id', auth()->id())->where('user_lesson.status', '=', config('program.finish_lesson'));
        })->exists();
    }

    public function scopeUpdateFinishLesson($query, $valueProgramsFinish, $valueCountPrograms, $idLesson)
    {
        if ($valueProgramsFinish == $valueCountPrograms) {
            $lesson = Lesson::find($idLesson);
            $lesson->users()->updateExistingPivot(auth()->user()->id, ['status' => config('program.finish_lesson')]);
        }
    }

    public function getProgressAttribute()
    {
        $programs = $this->programs()->count();

        $count = 0;
        foreach ($this->programs()->get() as $program) {
            $program = $program->countJoinedPrograms;
            $count += $program;
        }

        if($programs == 0) {
            return 0;
        } else {
            return round(($count / $programs) * 100);
        }
    }
}
