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
        return $this->belongsTo(course::class, 'course_id');
    }

    public function user_lesson()
    {
        return $this->hasMany(user_lesson::class, 'lesson_id');
    }

    public function program()
    {
        return $this->hasMany(course::class, 'lesson_id');
    }
}
