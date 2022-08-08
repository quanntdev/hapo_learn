<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lesson_id',
        'type',
        'file',
        'status',
    ];

    public function lesson()
    {
        return $this->belongsTo(lesson::class, 'lesson_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_program', 'program_id', 'user_id');
    }

    public function getTypeProgramAttribute()
    {
        $programsValue = $this->type;

        switch ($programsValue) {
            case config('program.value_doc'):
                return __('lesson.type_doc');
                break;
            case config('program.value_pdf'):
                return __('lesson.type_pdf');
                break;
            case config('program.value_video'):
                return __('lesson.type_video');
                break;
        }
    }

    public function getPictureProgramAttribute()
    {
        $programsValue = $this->type;

        switch ($programsValue) {
            case config('program.value_doc'):
                return config('program.pic_doc');
                break;
            case config('program.value_pdf'):
                return config('program.pic_pdf');
                break;
            case config('program.value_video'):
                return config('program.pic_video');
                break;
        }
    }

    public function getIsJoinedProgramsAttribute()
    {
        return $this->users()->whereExists(function ($query) {
            $query->where('user_id', auth()->id());
        })->exists();
    }

    public function getCountJoinedProgramsAttribute()
    {
        return $this->users()->whereExists(function ($query) {
            $query->where('user_id', auth()->id());
        })->count();
    }

    public function scopeGetCountUserPrograms($query, $programs)
    {
        $count = 0;
        foreach ($programs as $program) {
            $program = $program->countJoinedPrograms;
            $count += $program;
        }

        return $count;
    }
}
