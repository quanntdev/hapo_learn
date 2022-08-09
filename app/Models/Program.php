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

    public function getProgramTypeAttribute()
    {
        $programsType = $this->type;

        switch ($programsType) {
            case config('program.value_pdf'):
                return [
                    'picture' => config('program.pic_pdf'),
                    'type' => __('lesson.type_pdf'),
                ];
                break;
            case config('program.value_video'):
                return [
                    'picture' => config('program.pic_video'),
                    'type' => __('lesson.type_video'),
                ];
                break;
            default:
                return [
                    'picture' => config('program.pic_doc'),
                    'type' => __('lesson.type_doc'),
                ];
                break;
        }
    }

    public function IsLearnedPrograms()
    {
        return $this->users()->whereExists(function ($query) {
            $query->where('user_id', auth()->id());
        })->exists();
    }

    public function LearnedPrograms()
    {
        return $this->users()->whereExists(function ($query) {
            $query->where('user_id', auth()->id());
        })->count();
    }

}
