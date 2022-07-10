<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lesson extends Model
{
    use HasFactory;

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

    protected $primaryKey = 'id';

    protected $table = 'lessons';

    public function course()
    {
        return $this->belongsTo('App\Models\course', 'course_id');
    }

    public function user_lesson()
    {
        return $this->hasMany('App\Models\user_lesson', 'lesson_id');
    }

    public function program()
    {
        return $this->hasMany('App\Models\program', 'lesson_id');
    }
}
