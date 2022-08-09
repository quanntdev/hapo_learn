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

    public function IsJoined()
    {
        return $this->users()->whereExists(function ($query) {
            $query->where('user_id', auth()->id());
        })->exists();
    }

    public function IsFinished()
    {
        return $this->users()->whereExists(function ($query) {
            $query->where('user_id', auth()->id())->where('user_lesson.status', '=', config('program.finish_lesson'));
        })->exists();
    }

    public function getProgressAttribute()
    {
        $programsId = $this->programs->pluck('id')->toArray();
        $count = UserProgram::countFinished($programsId)->count();

        return ($count == 0) ? 0 : round(($count / $this->programs()->count()) * 100);
    }
}
