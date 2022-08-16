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
        'requirement',
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

    public function isJoined()
    {
        return $this->users()->whereExists(function ($query) {
            $query->where('user_id', auth()->id());
        })->exists();
    }

    public function isFinished()
    {
        return $this->users()->whereExists(function ($query) {
            $query->where('user_id', auth()->id())->where('user_lesson.status', '=', config('program.finish_lesson'));
        })->exists();
    }

    public function getProgressAttribute()
    {
        $count = UserProgram::finishedPrograms($this->programs)->count();

        return ($count == 0) ? 0 : round(($count / $this->programs()->where('status', config('course.onstatus'))->count()) * 100);
    }
}
